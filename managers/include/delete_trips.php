<?
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
