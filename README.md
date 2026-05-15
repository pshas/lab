$userId = 101;

$GLOBALS['USER_FIELD_MANAGER']->CleanCache();

CAccess::UpdateCodes([
    'USER_ID' => $userId
]);

CSocNetLogDestination::ClearAllUsersSocNetGroupsCache();

BXClearCache(true);