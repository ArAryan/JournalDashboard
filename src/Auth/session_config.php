<?php
/* START: Session Hardening Section */

/**
 * Configure secure session parameters
 */
function initiate_secure_session() {
    // Set cookie parameters for security
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params([
        'lifetime' => 0, // Session cookie
        'path'     => '/',
        'domain'   => $_SERVER['HTTP_HOST'],
        'secure'   => isset($_SERVER['HTTPS']), // Secure if HTTPS
        'httponly' => true, // Prevent JS access
        'samesite' => 'Strict' // CSRF protection
    ]);

    // Use strict mode to prevent session fixation
    ini_set('session.use_strict_mode', 1);
    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Regenerate session ID periodically to prevent hijacking
    if (!isset($_SESSION['last_regeneration'])) {
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
    } else if (time() - $_SESSION['last_regeneration'] > 1800) { // 30 mins
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
    }
}

initiate_secure_session();

/* END: Session Hardening Section */
?>
