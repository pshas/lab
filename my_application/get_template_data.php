<?php
// Подключение к базе данных
$dsn = 'mysql:host=localhost;dbname=test_db';
$username = 'root';
$password = 'root';

$pdo = new PDO($dsn, $username, $password);

if (isset($_GET['id'])) {
    $template_id = $_GET['id'];

    // Запрос для получения данных о шаблоне
    $stmt = $pdo->prepare("SELECT * FROM user_applications WHERE id = :id");
    $stmt->execute([':id' => $template_id]);

    $template = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($template) {
        // Возвращаем данные в формате JSON
        echo json_encode([
            'success' => true,
            'research_object' => $template['NAME_IZD'],
            'initiator' => $template['full_name'],
            'task' => $template['task'],
            'goal' => $template['note'],
            'status' => $template['status'],
            'report' => $template['report']
        ]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Шаблон не найден.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'ID не передан.']);
}
?>