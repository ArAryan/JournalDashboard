<?php
/* START: AuthManager Service Section */

namespace App\Auth;

use PDO;

/**
 * Advanced Authentication Manager
 * Handles registration, login, and RBAC security.
 */
class AuthManager {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * Register a new user
     */
    public function register(string $name, string $email, string $password, string $role): bool {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO users (full_name, email, password_hash, role) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $email, $hash, $role]);
    }

    /**
     * Authenticate a user
     */
    public function login(string $email, string $password): bool {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];
            return true;
        }
        return false;
    }

    /**
     * Check if user is logged in
     */
    public static function isLoggedIn(): bool {
        return isset($_SESSION['user_id']);
    }

    /**
     * Check role permission
     */
    public static function hasRole(string $role): bool {
        return isset($_SESSION['role']) && $_SESSION['role'] === $role;
    }
}

/* END: AuthManager Service Section */
?>
