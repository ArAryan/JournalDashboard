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
            $cover_letter = filter_input(INPUT_POST, 'cover_letter', FILTER_SANITIZE_SPECIAL_CHARS);

            // FILE HANDLING (Step 2)
            $file = $_FILES['manuscript_file'] ?? null;
            if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
                return "Error: Main manuscript file is required.";
            }

            $upload_dir = BASE_PATH . '/uploads/';
            $file_ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $new_filename = 'MS_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $file_ext;
            $destination = $upload_dir . $new_filename;

            if (!move_uploaded_file($file['tmp_name'], $destination)) {
                return "Error: Failed to save uploaded file.";
            }

            try {
                $this->db->beginTransaction();

                // 1. Create Manuscript Record
                $stmt = $this->db->prepare("INSERT INTO manuscripts (author_id, title, abstract, status) VALUES (?, ?, ?, 'Technical_Check')");
                $stmt->execute([$author_id, $title, $abstract]);
                $ms_id = $this->db->lastInsertId();

                // 2. Create Submission Version Record
                $stmt_v = $this->db->prepare("INSERT INTO submission_versions (manuscript_id, version_number, file_path, cover_letter) VALUES (?, 1, ?, ?)");
                $stmt_v->execute([$ms_id, $new_filename, $cover_letter]);

                // 3. Advanced Logic: Initial Workflow Event
                $this->workflow->transition($ms_id, 'Technical_Check', $author_id, "Initial Submission via Wizard");

                $this->db->commit();
                header("Location: /JournalDB/public/index?success=Submission Received");
                exit();
            } catch (\Exception $e) {
                $this->db->rollBack();
                if (file_exists($destination)) unlink($destination);
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
        } elseif ($role === 'Reviewer') {
            $stmt = $this->db->prepare("SELECT m.* FROM manuscripts m JOIN reviews r ON m.id = r.manuscript_id WHERE r.reviewer_id = ? ORDER BY m.created_at DESC");
            $stmt->execute([$uid]);
        } else {
            return [];
        }

        return $stmt->fetchAll();
    }
}

/* END: ManuscriptController Implementation */
?>
