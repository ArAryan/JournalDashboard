<?php
/* START: ManuscriptController Implementation */

namespace App\Controllers;

use PDO;
use App\Services\JournalWorkflow;
use App\Utils\MetadataParser;
use App\Utils\CSRF;

class ManuscriptController {
    private PDO $db;
    private $workflow;
    private $parser;

    public function __construct(PDO $db) {
        $this->db = $db;
        $this->workflow = new \App\Services\JournalWorkflow($db);
        $this->parser = new \App\Utils\MetadataParser();
    }

    /**
     * Handle multi-step submission processing
     */
    public function handleSubmission() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // LAYER 2 SECURITY: CSRF Check
            if (!CSRF::validate($_POST['csrf_token'] ?? '')) {
                return "Security token invalid. Please refresh and try again.";
            }

            $author_id = $_SESSION['user_id'] ?? null;
            if (!$author_id) return "Error: Unauthorized";

            // Layer 3 Security: Input Sanitization
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
            $abstract = filter_input(INPUT_POST, 'abstract', FILTER_SANITIZE_SPECIAL_CHARS);

            try {
                $this->db->beginTransaction();

                $stmt = $this->db->prepare("INSERT INTO manuscripts (author_id, title, abstract, status) VALUES (?, ?, ?, 'Technical_Check')");
                $stmt->execute([$author_id, $title, $abstract]);
                $ms_id = $this->db->lastInsertId();

                // Advanced Logic: Initial Workflow Event
                $this->workflow->transition($ms_id, 'Technical_Check', $author_id, "Initial Submission via Wizard");

                $this->db->commit();
                header("Location: /JournalDB/public/index?success=Submission Received");
                exit();
            } catch (\Exception $e) {
                $this->db->rollBack();
                return "Submission failed: " . $e->getMessage();
            }
        }
        return null;
    }

    /**
     * Fetch manuscripts for the logged-in user Based on Role
     */
    public function getManuscriptsForDashboard() {
        $role = $_SESSION['role'] ?? 'Guest';
        $uid = $_SESSION['user_id'] ?? 0;

        if ($role === 'Author') {
            $stmt = $this->db->prepare("SELECT * FROM manuscripts WHERE author_id = ? ORDER BY created_at DESC");
            $stmt->execute([$uid]);
        } elseif ($role === 'Editor') {
            $stmt = $this->db->prepare("SELECT m.*, u.full_name as author_name FROM manuscripts m JOIN users u ON m.author_id = u.id ORDER BY created_at DESC");
            $stmt->execute();
        } else {
            return [];
        }

        return $stmt->fetchAll();
    }
}

/* END: ManuscriptController Implementation */
?>
