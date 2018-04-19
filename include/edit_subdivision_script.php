<?
	session_start();
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