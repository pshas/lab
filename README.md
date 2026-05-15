Да, здесь уже видно конкретную разницу.

У пользователя 101 в группе/проекте 8:

role = A
auto_member = N
initiated_by_type = U

У рабочей копии 139:

role = K
auto_member = Y
initiated_by_type = G

Это может быть причиной.

В Bitrix b_sonet_user2group.role обычно:

A — владелец/руководитель группы
E — модератор/помощник
K — участник

У тебя проблемный пользователь является руководителем проекта, а рабочая копия — обычным участником. Поэтому у них разные access_code:

SG8_A — руководитель/владелец группы
SG8_K — участник группы

Но подозрительно вот это:

auto_member = N
initiated_by_type = U

А у рабочей копии:

auto_member = Y
initiated_by_type = G

То есть 139 добавлен автоматически от группы/структуры, а 101 вручную как руководитель.

Я бы проверил ещё таблицу самой группы:

SELECT
    id,
    name,
    owner_id,
    initiator_id,
    visible,
    opened,
    closed,
    project,
    scrum_master_id
FROM public.b_sonet_group
WHERE id = 8;

И отдельно:

SELECT
    id,
    user_id,
    group_id,
    role,
    auto_member,
    initiated_by_type,
    initiated_by_user_id
FROM public.b_sonet_user2group
WHERE group_id = 8
ORDER BY role, user_id;

Главное — проверь, не стоит ли у проекта owner_id = 101. Если да, то проблема может быть именно в правах владельца проекта или в том, что у владельца нет корректного SG8_K, только SG8_A.

Для теста можно временно через интерфейс:

1. назначить другим пользователем владельца проекта;


2. добавить 101 как обычного участника/модератора;


3. проверить, появился ли список приглашения.



SQL руками менять пока не советую. Лучше сначала увидеть b_sonet_group.