<?php
/* START: ReviewService Implementation */

namespace App\Services;

use PDO;

class ReviewService {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * Create a new review invitation
     */
    public function inviteReviewer(int $manuscriptId, int $reviewerId): string {
        $token = bin2hex(random_bytes(32));
        $stmt = $this->db->prepare("INSERT INTO reviews (manuscript_id, reviewer_id, invitation_token, status) VALUES (?, ?, ?, 'Pending')");
        $stmt->execute([$manuscriptId, $reviewerId, $token]);
        return $token;
    }

    /**
     * Verify a reviewer token
     */
    public function verifyToken(string $token): ?array {
        $stmt = $this->db->prepare("SELECT * FROM reviews WHERE invitation_token = ?");
        $stmt->execute([$token]);
        return $stmt->fetch() ?: null;
    }

    /**
     * Update review status
     */
    public function updateStatus(int $reviewId, string $status): bool {
        $stmt = $this->db->prepare("UPDATE reviews SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $reviewId]);
    }

    /**
     * Submit a completed review score and comments
     */
    public function submitReview(int $reviewId, array $data): bool {
        $stmt = $this->db->prepare("
            UPDATE reviews 
            SET score_originality = ?, 
                score_methodology = ?, 
                score_clinical_impact = ?, 
                comments_to_author = ?, 
                comments_to_editor = ?, 
                status = 'Completed' 
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['originality'],
            $data['methodology'],
            $data['impact'],
            $data['comments_author'],
            $data['comments_editor'],
            $reviewId
        ]);
    }
}

/* END: ReviewService Implementation */
?>
