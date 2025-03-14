<?
require("../header.php");
$dsn = 'mysql:host=localhost;dbname=test_db';
$username = 'root';
$password = 'root';

$pdo = new PDO($dsn, $username, $password);
$title = "";
$block_id = isset($_GET['block_id']) ? intval($_GET['block_id']) : 0;
$sql = $pdo->prepare("
SELECT id, title FROM blocks WHERE id = :block_id
");
$sql->execute([':block_id' => $block_id]);
$title = $sql->fetch(PDO::FETCH_ASSOC);

$user_id = $USER->GetId();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_template'])) {
	$country = $_POST['country'];
	$name_izd = $_POST['name_izd'];
	$id_i = $_POST['id_i'];
	$work_department = $_POST['work_department'];
	$full_name = $_POST['full_name'];
	$personal_phone = $_POST['personal_phone'];
	$work_position = $_POST['work_position'];
	$work_phone = $_POST['work_phone'];
	$is_editable = isset($_POST['is_editable']) ? (int)$_POST['is_editable'] : 1;
	$task = $_POST['task'];
	$note = $_POST['note'];
	$status = "Сохранен";
	$stmt = $pdo->prepare("
	INSERT INTO user_applications (block_id, USER_ID, NAME_IZD, ID_I, COUNTRY, work_department, full_name, personal_phone, work_position, work_phone, is_editable, task, note, status)
VALUES (:block_id, :USER_ID, :NAME_IZD, :ID_I, :COUNTRY, :work_department, :full_name, :personal_phone, :work_position, :work_phone, :is_editable, :task, :note, :status)
	");
	$stmt->execute([
	':block_id' => $block_id,
	':USER_ID' => $user_id,
	':NAME_IZD' => $name_izd,
	':ID_I' => $id_i,
	':COUNTRY' => $country,
	':work_department' => $work_department,
	':full_name' => $full_name,
	':personal_phone' => $personal_phone,
	':work_position' => $work_position,
	':work_phone' => $work_phone,
	':is_editable' => $is_editable,
	':task' => $task,
	':note' => $note,
	':status' => $status
	]);
}
?>