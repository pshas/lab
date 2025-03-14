<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

if (!check_bitrix_sessid()) {
    echo json_encode([]);
    die();
}

if (!$USER->IsAuthorized()) {
    echo json_encode(['success' => false, 'error' => 'User not authorized']);
    die();
}

// Подключение нужных модулей
if (!CModule::IncludeModule('main')) {
    echo json_encode(['success' => false, 'error' => 'Unable to include main module']);
    die();
}

$userId = htmlspecialcharsbx($_POST['userId']);
$groupId = intval($_POST['userGroupId']);

// Получаем ID пользователя по имени
if ($userId > 0 && $groupId > 0) {
	$user = new CUser;
	$groups = CUser::GetUserGroup($userId);
	if (!in_array($groupId,$groups)) {
		$groups[] = $groupId;
		$user->SetUserGroup($userId, $groups);
		echo json_encode(['success' => true]);
	} else {
		echo json_encode(['success' => false]);
	}
} else {
	echo json_encode(['success' => false, 'error' => 'Invalid user or group ID']);
}
?>