<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

// Проверка сессии
if (!check_bitrix_sessid()) {
    echo json_encode([]);
    die();
}

// Проверка авторизации пользователя
if (!$USER->IsAuthorized()) {
    echo json_encode([]);
    die();
}

// Подключаем модуль, если он не подключен
if (!CModule::IncludeModule('main')) {
    echo json_encode([]);
    die();
}

// Получаем параметр поиска и защищаем от инъекций
$query = htmlspecialcharsbx(trim($_POST['query']));

// Если запрос пустой или слишком короткий, возвращаем пустой массив
if (strlen($query) < 2) {
    echo json_encode([]);
    die();
}

// Настраиваем фильтр для поиска пользователей
$arFilter = Array (
    'ACTIVE' => 'Y',
    'NAME' => $query // Частичное совпадение с именем
);

// Запрашиваем пользователей, соответствующих фильтру
$rsUsers = CUser::GetList(
    ($by = "NAME"), 
    ($order = "ASC"), 
    $arFilter, 
    ['FIELDS' => ['ID', 'NAME', 'LAST_NAME', 'EMAIL']]
);

// Формируем массив результатов
$users = [];
while ($arUser = $rsUsers->Fetch()) {
    $users[] = [
        'ID' => $arUser['ID'],
        'NAME' => $arUser['NAME'] . ' ' . $arUser['LAST_NAME'], // Имя и фамилия
        'EMAIL' => $arUser['EMAIL']
    ];
}

// Устанавливаем заголовок и возвращаем результат в формате JSON
header('Content-Type: application/json');
echo json_encode($users);
?>