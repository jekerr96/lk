<?
session_start();
if($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_SESSION["id"]) || $_SESSION["type"] == "client"){
die("У вас нет прав доступа");
}
  include 'db_connect.php';

  $id = $_POST["id"];

  $query = "DELETE FROM trips WHERE id = $id";
  $result = mysqli_query($link, $query);
  if($result)
    echo 1;
  else {
    echo mysqli_error($link);
  }
?>
