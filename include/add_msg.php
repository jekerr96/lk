<?
session_start();
if($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_SESSION["id"] || $_SESSION["type"] != "client")){
die("У вас нет прав доступа");
}
  include 'db_connect.php';

  $msg = $_POST["msg"];
  $author = $_POST["author"];
  $trip = $_POST["trip"];

  $query = "INSERT INTO msg_trips(id_author, its_manager, id_trip, msg, date_msg) VALUES($author, 0, $trip, '$msg', NOW())";
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
