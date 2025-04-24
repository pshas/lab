<?
require("../header.php");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?> 
<!-- Кнопка для открытия модального окна -->
<button id="openModal">Добавить пользователя в группу</button>

<!-- Модальное окно -->
<div id="userModal" style="display:none;">
    <div>
        <h2>Добавление пользователя в группу</h2>
        <label for="user_search">Пользователь:</label>
        <input type="text" id="user_search" name="user_search" autocomplete="off" placeholder="Введите имя пользователя...">
        <ul id="user_suggestions" style="display:none;"></ul> <!-- Список автоподсказок -->

        <label for="user_group">Группа:</label>
        <select id="user_group">
            <option value="">Выберите группу</option>
            <!-- Группы будут загружены с сервера -->
        </select>

        <button id="addUserButton">Добавить</button>
        <button id="closeModal">Закрыть</button>
    </div>
</div>

<script>
BX.ready(function() {
	let userId = null;
    // Открытие модального окна
    document.getElementById('openModal').onclick = function() {
        document.getElementById('userModal').style.display = 'block';
        loadUserGroups(); // Загружаем группы при открытии модального окна
    };

    // Закрытие модального окна
    document.getElementById('closeModal').onclick = function() {
        document.getElementById('userModal').style.display = 'none';
    };

    // Поиск пользователей
    document.getElementById('user_search').oninput = function() {
        const query = this.value.trim();
		console.log(query);

        if (query.length < 2) {
            document.getElementById('user_suggestions').style.display = 'none';
            return;
        }

        // AJAX-запрос для получения списка пользователей
        BX.ajax({
			url: '/local/lab/ajax/search_users.php', 
            method: 'POST',
            dataType: 'json',
            data: {
                query: query,
                sessid: BX.bitrix_sessid()
            },
            onsuccess: function(data) {
				console.log('Полученные данные:', data);
                let suggestions = document.getElementById('user_suggestions');
                suggestions.innerHTML = ''; // Очищаем предыдущие подсказки

                if (data.length > 0) {
                    data.forEach(function(user) {
                        let li = document.createElement('li');
                        li.textContent = user.NAME + ' (' + user.EMAIL + ')'; // Отображаем имя и почту пользователя
                        li.dataset.userId = user.ID;

                        // При выборе пользователя
                        li.onclick = function() {
                            document.getElementById('user_search').value = user.NAME; 
							userId = user.ID;
							console.log(userId);
                            suggestions.style.display = 'none'; // Скрываем подсказки
                        };

                        suggestions.appendChild(li);
                    });

                    suggestions.style.display = 'block'; // Отображаем список подсказок
                } else {
                    suggestions.style.display = 'none'; // Скрываем, если данных нет
                }
            },
            onfailure: function(error) {
                console.error('Ошибка при получении данных', error);
            }
        });
    };

    // Функция для загрузки групп пользователей
    function loadUserGroups() {
        BX.ajax({
			url: '/local/lab/ajax/get_user_groups.php',
            method: 'POST',
            dataType: 'json',
            data: {
                sessid: BX.bitrix_sessid() 
            },
            onsuccess: function(data) {
                let userGroupSelect = document.getElementById('user_group');
                userGroupSelect.innerHTML = '<option value="">Выберите группу</option>'; // Сбрасываем предыдущие группы

                data.forEach(function(group) {
                    let option = document.createElement('option');
                    option.value = group.ID;
                    option.textContent = group.NAME;
                    userGroupSelect.appendChild(option);
                });
            },
            onfailure: function(error) {
                console.error('Ошибка при получении групп', error);
            }
        });
    }

    // Обработка нажатия кнопки "Добавить"
    document.getElementById('addUserButton').onclick = function() {
        const userGroupId = document.getElementById('user_group').value;
		console.log(userGroupId);

        if (!userId || !userGroupId) {
            alert('Пожалуйста, выберите пользователя и группу.');
            return;
        }

        // AJAX-запрос для добавления пользователя в группу
        BX.ajax({
			url: '/local/lab/ajax/add_user_to_group.php',
            method: 'POST',
            dataType: 'json',
            data: {
                userId: userId,
                userGroupId: userGroupId,
                sessid: BX.bitrix_sessid() 
            },

            onsuccess: function(response) {
                if (response.success) {
                    alert('Пользователь успешно добавлен в группу!');
                    document.getElementById('userModal').style.display = 'none'; // Закрываем модальное окно
                } else {
                    alert('Ошибка: ' + data.error);
                }
            },
            onfailure: function(error) {
                console.error('Ошибка при добавлении пользователя', error);
				alert('Пользователь уже состоит группе!');

            }
        });
    };
});
</script>


<?
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/intranet/public/docs/shared/index.php");
$APPLICATION->SetTitle("Раздел_тест");
$APPLICATION->AddChainItem($APPLICATION->GetTitle(), "./files");
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:disk.common",
	"",
	Array(
		"SEF_FOLDER" => "./files",
		"SEF_MODE" => "Y",
		"STORAGE_ID" => "10"
	)
);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>