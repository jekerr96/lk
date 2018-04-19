<?
	$id = $_POST["id"];

	include 'db_connect.php';
	$query = "DELETE FROM employees WHERE id = $id";
	$result = mysqli_query($link, $query);
	if($result)
		echo 1;
	else
		echo mysqli_error($link);
?>