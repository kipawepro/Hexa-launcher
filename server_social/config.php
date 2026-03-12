<?php
// config.php located in same folder
header('Content-Type: application/json');

$host = 'sql3.minestrator.com';
$db   = 'minesr_VODW8dwu';
$user = 'minesr_VODW8dwu';
$pass = 'NfocLnAinfeyr9WU';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     http_response_code(500);
     echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
     exit;
}

// Helper: Verify User (Auth - Simplified)
function verifyToken($pdo, $username, $token) {
    // SECURITY: This is a placeholder. You should validate the token against your users table or session.
    // For now, it just checks if the user exists.
    $stmt = $pdo->prepare("SELECT id FROM hexa_users WHERE username = ?");
    $stmt->execute([$username]);
    $u = $stmt->fetch();
    return $u ? $u['id'] : false;
}
?>