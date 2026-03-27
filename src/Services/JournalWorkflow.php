<?php
/* START: Workflow Engine Service Section */

namespace App\Services;

use PDO;

/**
 * JournalWorkflow Service
 * Manages the manuscript state machine and transitions.
 */
class JournalWorkflow {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * Transition manuscript to a new state
     */
    public function transition(int $manuscriptId, string $newState, int $userId, string $comment = ''): bool {
        try {
            $this->db->beginTransaction();

            // Update Status
            $stmt = $this->db->prepare("UPDATE manuscripts SET status = ? WHERE id = ?");
            $stmt->execute([$newState, $manuscriptId]);

            // Log the transition in Audit Trail
            $action = "Status changed to " . str_replace('_', ' ', $newState);
            if ($comment) $action .= " | Comment: " . $comment;

            $stmt_log = $this->db->prepare("INSERT INTO audit_logs (manuscript_id, user_id, action) VALUES (?, ?, ?)");
            $stmt_log->execute([$manuscriptId, $userId, $action]);

            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollBack();
            error_log("Workflow transition failed: " . $e->getMessage());
            return false;
        }
    }
}

/* END: Workflow Engine Service Section */
?>
