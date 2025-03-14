<?php
$dsn = 'mysql:host=localhost;dbname=test_db';
$username = 'root';
$password = 'root';

$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Получаем данные из POST-запроса
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    $template_id = $data['id'];
    $status = $data['status'];
    $is_editable = $data['is_editable'];

    // Запрос для обновления статуса и активации шаблона
    $stmt = $pdo->prepare("UPDATE user_applications SET status = :status, is_editable = :is_editable WHERE id = :id");
    $result = $stmt->execute([
        ':status' => $status,
        ':is_editable' => $is_editable,
        ':id' => $template_id
    ]);

    if ($result) {
        // Возвращаем успешный ответ
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Не удалось обновить шаблон.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'ID не передан.']);
}
?>