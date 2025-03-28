<?php 
require("../header.php"); 
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

// Получаем ID текущего пользователя Битрикс
global $USER;
$currentUserId = $USER->GetID();
?>

<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery и Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<body>
    <div class="container">
        <h1 class="mt-4 mb-4">Задачи</h1>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Номер</th>
                    <th>Создан</th>
                    <th>Инициатор</th>
                    <th>Цех/Отдел</th>
                    <th>Наименование</th>
                    <th>Номер детали</th>
                    <th>Дата изготовления</th>
                    <th>Номер партии</th>
                    <th>Несоответствие</th>
                    <th>Статус</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $dsn = 'mysql:host=localhost;dbname=test_db';
                $username = 'root';
                $password = 'root';
                $pdo = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

                $stmt = $pdo->prepare("SELECT * FROM user_applications WHERE is_editable = 3");
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['full_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['work_department']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['NAME_IZD']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['ID_I']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['date_man'] ?? '—') . "</td>";
                    echo "<td>" . htmlspecialchars($row['batch_number'] ?? '—') . "</td>";
                    echo "<td>" . htmlspecialchars($row['task']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>