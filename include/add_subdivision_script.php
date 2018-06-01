<?
	session_start();
	if($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_SESSION["id"] || $_SESSION["type"] != "client")){
	die("У вас нет прав доступа");
}
	$id = $_SESSION["id"];
	$id_clients = $_SESSION["id_clients"];
	$errors = "";
	$name = $_POST["name"];

	if($name == "") $errors .= "Не указано наименование";


	if($errors != "")
		die($errors);

	include 'db_connect.php';
	$query = "INSERT INTO subdivision (name, id_clients) VALUES('$name', $id_clients)";
	$result = mysqli_query($link, $query);
	if($result)
		echo "1";
?>
