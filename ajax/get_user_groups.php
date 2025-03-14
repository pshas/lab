<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

// Проверка сессии
if (!check_bitrix_sessid()) {
    echo json_encode([]);
    die();
}

if (!$USER->IsAuthorized()) {
    echo json_encode([]);
    die();
}

// Подключение модуля
if (!CModule::IncludeModule('socialservices')) {
    echo json_encode([]);
    die();
}

// Получение групп пользователей
$arGroups = [];
$dbGroups = CGroup::GetList($by = "id", $order = "asc", $filter);
while ($arGroup = $dbGroups->Fetch()) {
	if ($arGroup["C_SORT"] == 300){
    	$arGroups[] = [
        	'ID' => $arGroup['ID'],
        	'NAME' => $arGroup['NAME'],
    	];
	}
}

echo json_encode($arGroups);
?>