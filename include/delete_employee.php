<?
	session_start();
	$id = $_SESSION["id"];
	$idd = $_POST["idd"];
	include 'db_connect.php';
	$query = "DELETE FROM employees WHERE id = $idd AND id_users = $id";
	$result = mysqli_query($link, $query);
	if($result == true){
		echo "1";
	}
	else{
		echo $query;
	}
?>