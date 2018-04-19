<?
	$id = $_POST["idd"];

	include 'db_connect.php';
	$query = "DELETE FROM clients WHERE id = $id";
	$result = mysqli_query($link, $query);
	if($result)
		echo 1;
?>