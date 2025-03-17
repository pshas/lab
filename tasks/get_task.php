<?php
$dsn = 'mysql:host=localhost;dbname=test_db';
$username = 'root';
$password = 'root';
$pdo = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

if (isset($_POST['id'])) {
	$id = $_POST['id'];
	$stmt = $pdo->prepare("SELECT * FROM user_applications WHERE id = ?");
	$stmt->execute([$id]);
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	echo json_encode($data);
}
?>
