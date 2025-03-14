<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

// Подключение класса
use Bitrix\Main\Loader;

Loader::includeModule("main");

$dsn = 'mysql:host=localhost;dbname=test_db';
$username = 'root';
$password = 'root';



$pdo = new PDO($dsn, $username, $password);
$title = $_POST['title'];
$description = $_POST['description'];


// Создаем объект класса CGroup
$group = new CGroup;

// Параметры новой группы
$groupData = [
	"ACTIVE" => "Y", // Активность: Y - активна, N - не активна
	"C_SORT" => 300,
    "NAME" => $title, // Название группы
    "DESCRIPTION" => $description // Описание группы
];
$newGroupId = $group->Add($groupData);


$sql = "INSERT INTO blocks (title, description, is_activate) VALUES (?, ?, TRUE)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$title, $description]);

$blockId = $pdo->lastInsertId();
echo json_encode(['id' => $blockId, 'title' => $title, 'description' => $description]);

?>