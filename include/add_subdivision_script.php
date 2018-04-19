<?
	session_start();
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