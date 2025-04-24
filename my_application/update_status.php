<?php
header('Content-Type: application/json');

$dsn = 'mysql:host=localhost;dbname=test_db';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $data = json_decode(file_get_contents('php://input'), true);
    
    $stmt = $pdo->prepare("UPDATE user_applications SET status = :status, status_note = :note WHERE id = :id");
    $stmt->execute([
        ':status' => $data['status'],
        ':note' => $data['note'],
        ':id' => $data['id']
    ]);
    
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>