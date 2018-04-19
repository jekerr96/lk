<?
session_start();
$id = $_SESSION["id"];

$description = $_POST["description"];
$form = $_POST["form"];
$term = $_POST["term"];
$address = $_POST["address"];

include 'db_connect.php';
$query = "INSERT INTO trips (description, id_status, priority, id_users, id_form, term, address, version) VALUES ('$description', 1, 1, $id,  '$form', '$term', '$address', 1)";
$result = mysqli_query($link, $query);
if($result){
	echo mysqli_insert_id($link);
}
else echo $query;
?>