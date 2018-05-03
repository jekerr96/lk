<?
  session_start();
  $id = $_POST["id"];
  $mid = $_SESSION["id"];
  include 'db_connect.php';

  $query = "SELECT id_status FROM trips WHERE id = $id";
  $result = mysqli_query($link, $query);
  $row = mysqli_fetch_assoc($result);
  if($row["id_status"] < 3)
    $status = 3;
  else $status = $row["id_status"];

  $query = "UPDATE trips SET id_manager = $mid, id_status = $status WHERE id = $id";
  $result = mysqli_query($link, $query);

  if($result){
    echo 1;
  }
  else{
    echo mysqli_error($link);
  }
?>
