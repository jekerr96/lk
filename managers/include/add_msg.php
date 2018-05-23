<?
session_start();
  include 'db_connect.php';

  $msg = $_POST["msg"];
  $author = $_SESSION["id"];
  $trip = $_POST["trip"];

  $query = "INSERT INTO msg_trips(id_author, its_manager, id_trip, msg, date_msg) VALUES($author, 1, $trip, '$msg', NOW())";
  $result = mysqli_query($link, $query);

  $fio = $_SESSION["fio"];
  echo '
  <br>
  <div class="block_msg">
    <span class="author">'.$fio.'</span>
    <span class="date_msg">'.date("d.m.y G:i:s").'</span>
    <span class="msg">'.$msg.'</span>
  </div>
  ';
?>
