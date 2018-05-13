<?
session_start();

if($_SESSION["type"] != "administrator")
  $block = true;

?><!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Новый клиент</title>
    <script>var page = "client";</script>
    <? include 'include/head.php'; ?>
  </head>
  <body>
    <? include 'include/menu.php';
    if($block)
    die("<div class='block_msg'>Этот документ принадлежит не вам, у вас нету прав на его редактирование.</div>");
     ?>
  </body>
</html>
