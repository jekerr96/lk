<?
	session_start();
	if($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_SESSION["id"] || $_SESSION["type"] != "client")){
	die("У вас нет прав доступа");
}
	$id = $_SESSION["id"];
	$errors = "";
	$add = "";

	$ide = $_POST["ide"];
	$name = $_POST["name"];

	if($name == "") $errors .= "Не указано наименование";

	if($errors != "")
		die($errors);

	include 'db_connect.php';
	$query = "UPDATE subdivision SET name = '$name' WHERE id = $ide";
	$result = mysqli_query($link, $query);
	if($result)
		echo "1";
?>
