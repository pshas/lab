Тогда да, это не конкретный проект, а проблема именно с пользователем 101.

Раз у него при создании новой группы тоже пустой список, проверяй не b_sonet_user2group, а его базовые связи.

Сравни 101 и рабочую копию 139 так:

SELECT
    ua.user_id,
    ua.provider_id,
    ua.access_code
FROM public.b_user_access ua
WHERE ua.user_id IN (101, 139)
ORDER BY ua.provider_id, ua.access_code, ua.user_id;

И отдельно покажи только отличия:

WITH u101 AS (
    SELECT provider_id, access_code
    FROM public.b_user_access
    WHERE user_id = 101
),
u139 AS (
    SELECT provider_id, access_code
    FROM public.b_user_access
    WHERE user_id = 139
)
SELECT
    COALESCE(u101.provider_id, u139.provider_id) AS provider_id,
    COALESCE(u101.access_code, u139.access_code) AS access_code,
    CASE
        WHEN u101.access_code IS NULL THEN 'есть только у 139'
        WHEN u139.access_code IS NULL THEN 'есть только у 101'
    END AS diff
FROM u101
FULL OUTER JOIN u139
    ON u101.provider_id = u139.provider_id
   AND u101.access_code = u139.access_code
WHERE u101.access_code IS NULL
   OR u139.access_code IS NULL
ORDER BY provider_id, access_code;

Главное, что надо проверить у 101:

SELECT
    id,
    login,
    active,
    external_auth_id,
    xml_id,
    uf_department
FROM public.b_user
WHERE id IN (101, 139);

Если у 101 заполнено external_auth_id типа socservices, email, extranet, imconnector или что-то нестандартное — Bitrix может считать его не обычным intranet-пользователем.

Ещё проверь группы пользователя:

SELECT
    ug.user_id,
    ug.group_id,
    g.name,
    g.string_id,
    ug.date_active_from,
    ug.date_active_to
FROM public.b_user_group ug
LEFT JOIN public.b_group g ON g.id = ug.group_id
WHERE ug.user_id IN (101, 139)
ORDER BY ug.user_id, ug.group_id;

Судя по твоим скринам, у 101 есть лишний код AE1 и D1/SND1, а у 139 их нет. Но важнее не лишние коды, а чтобы у 101 были обычные:

G2 / G3 / G4 / G17 / G57
D78
DR1 / DR77 / DR78
IU101
U101

Если они есть, а список всё равно пустой — я бы смотрел уже не SQL, а профиль пользователя:

1. ACTIVE = Y


2. EXTERNAL_AUTH_ID пустой или нормальный для интранет-пользователя


3. пользователь состоит в группе Сотрудники


4. пользователь не экстранет


5. в карточке указан отдел UF_DEPARTMENT



Самый показательный запрос сейчас — b_user и b_user_group для 101 и 139.