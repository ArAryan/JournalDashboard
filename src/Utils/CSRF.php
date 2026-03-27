<?php
/* START: CSRF Protection Utility Section */

namespace App\Utils;

/**
 * CSRF Protection Layer
 * Generates and validates security tokens for state-changing requests.
 */
class CSRF {
    
    /**
     * Generate a new token and store it in session
     */
    public static function generateToken(): string {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Validate the provided token against the session
     */
    public static function validate(string $token): bool {
        return !empty($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
}

/* END: CSRF Protection Utility Section */
?>
