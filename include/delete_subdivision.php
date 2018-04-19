<?
	session_start();
	$id = $_SESSION["id"];
	$idd = $_POST["idd"];
	include 'db_connect.php';
	$query = "DELETE FROM subdivision WHERE id = $idd";
	$result = mysqli_query($link, $query);
	if($result == true){
		echo "1";
	}
	else{
		echo $query;
	}
?>