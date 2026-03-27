<?php
/* START: Front Controller / public/index.php */

// START: Environment & Configuration
require_once __DIR__ . '/../src/autoload.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../src/Auth/session_config.php'; // Hardened sessions

// Define core path constants
define('BASE_PATH', dirname(__DIR__));
define('TEMPLATE_PATH', BASE_PATH . '/templates');

// START: Routing Logic (Simplified Front Controller Pattern)
$request_uri = $_SERVER['REQUEST_URI'];
$base_uri = '/JournalDB/public/';
$path = str_replace($base_uri, '', parse_url($request_uri, PHP_URL_PATH));

// Instantiate Controllers
$authController = new \App\Controllers\AuthController($pdo);
$msController = new \App\Controllers\ManuscriptController($pdo);

$error = null;
$view = 'dashboard.php';

// Route Handling
switch ($path) {
    case '':
    case 'index':
        // Role-based dashboard switching
        $role = $_SESSION['role'] ?? 'Guest';
        if ($role === 'Editor') {
            $view = 'editor_dashboard.php';
        } elseif ($role === 'Reviewer') {
            $view = 'reviewer_portal.php';
        } else {
            $view = 'dashboard.php';
        }
        break;
    case 'submit':
        $error = $msController->handleSubmission();
        $view = 'author/submit_wizard.php';
        break;
    case 'login':
        $error = $authController->handleLogin();
        $view = 'auth/login.php';
        break;
    case 'register':
        $error = $authController->handleRegister();
        $view = 'auth/register.php';
        break;
    case 'logout':
        $authController->handleLogout();
        break;
    case 'invite-reviewer':
        // API Endpoint
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        $reviewService = new \App\Services\ReviewService($db);
        $token = $reviewService->inviteReviewer($data['manuscript_id'], $data['reviewer_id']);
        echo json_encode(['status' => 'success', 'token' => $token]);
        exit();
    case 'submit-review':
        // Handle Evaluation
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $view = 'index.php'; // Temporary redirect
            $success = "Evaluation Submitted Successfully";
        }
        break;
    default:
        $view = '404.php';
        break;
}

// START: Render Engine
require_once TEMPLATE_PATH . '/layout/header.php';
if ($error) echo "<div class='ui-alert-error'>$error</div>";
require_once TEMPLATE_PATH . '/' . $view;
require_once TEMPLATE_PATH . '/layout/footer.php';
// END: Render Engine

/* END: Front Controller */
?>
