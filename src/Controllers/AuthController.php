<?php
/* START: AuthController Implementation */

namespace App\Controllers;

use App\Auth\AuthManager;
use App\Utils\CSRF;
use PDO;

class AuthController {
    private AuthManager $auth;

    public function __construct(PDO $db) {
        $this->auth = new AuthManager($db);
    }

    /**
     * Handle Login POST
     */
    public function handleLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!CSRF::validate($_POST['csrf_token'] ?? '')) {
                return "Security Error: Invalid CSRF Token.";
            }

            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            if ($this->auth->login($email, $password)) {
                header("Location: /JournalDB/public/index");
                exit();
            } else {
                return "Invalid credentials provided.";
            }
        }
        return null;
    }

    /**
     * Handle Registration POST
     */
    public function handleRegister() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!CSRF::validate($_POST['csrf_token'] ?? '')) {
                return "Security Error: Invalid CSRF Token.";
            }

            $name = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'Author';

            if ($this->auth->register($name, $email, $password, $role)) {
                // Auto-login after registration
                $this->auth->login($email, $password);
                header("Location: /JournalDB/public/index");
                exit();
            } else {
                return "Registration failed. Email may already be in use.";
            }
        }
        return null;
    }

    /**
     * Handle Logout
     */
    public function handleLogout() {
        session_destroy();
        header("Location: /JournalDB/public/login");
        exit();
    }
}

/* END: AuthController Implementation */
?>
