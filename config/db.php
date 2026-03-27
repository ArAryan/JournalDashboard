<?php
/* START: Database Configuration Section */

/**
 * Use PDO for advanced security (Prepared Statements)
 */
$config = [
    'host' => 'localhost',
    'db'   => 'journal_db',
    'user' => 'root',
    'pass' => '',
    'charset' => 'utf8mb4',
];

$dsn = "mysql:host={$config['host']};dbname={$config['db']};charset={$config['charset']}";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $config['user'], $config['pass'], $options);
    /* [SUCCESS: DB Connection Established] */
} catch (\PDOException $e) {
    /* [FAILURE: DB Connection Failed] */
    error_log($e->getMessage());
    die("A technical error occurred while connecting to the database.");
}

/* END: Database Configuration Section */
?>
