<?php
$dsn = 'mysql:host=localhost;dbname=test_db';
$username = 'root';
$password = 'root';

$pdo = new PDO($dsn, $username, $password);
$blocks = $pdo->query("SELECT id, title, description FROM blocks WHERE is_activate = TRUE")->fetchAll(PDO::FETCH_ASSOC);

foreach($blocks as $block) {
    echo '<div class="block" data-id="' . $block['id'] . '">';
    echo '<h4>' . htmlspecialchars($block['title']) . '</h4>';
    echo '<p>' . htmlspecialchars($block['description']) . '</p>';
	echo '<a href="application/index.php?block_id=' . $block['id'] . '" class="order-btn">Оформить</a><br />';
    echo '<div class="remove-btn">Деактивировать</div>';
    echo '</div>';
}
?>