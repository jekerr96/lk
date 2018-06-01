<?
session_start();
if($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_SESSION["id"] || $_SESSION["type"] != "client")){
die("У вас нет прав доступа");
}
?>
<div>Главная</div>
