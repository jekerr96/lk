<?
session_start();
if(!isset($_SESSION["id"]) || $_SESSION["type"] == "client" || $_SESSION["type"] != "administrator"){
die("У вас нет прав доступа");
}
if($_SESSION["type"] != "administrator")
  die("У вас нет доступа");

$id = $_GET["id"];
include 'include/db_connect.php';
$query = "SELECT * FROM clients WHERE id = $id";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($result);

if(isset($_POST["sub"])){
  $name = $_POST["name"];
  $travel = $_POST["travel_agency"];
  $form = $_POST["form_settlements"];

  $query = "UPDATE clients SET name = '$name', travel_agency = $travel, form_settlements = $form WHERE id = $id";
  $result = mysqli_query($link, $query);
  if($result) header("Location: clients.php");
  else $errors = mysqli_error($link);
}

?><!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Изменение клиента</title>
    <script>var page = "client";</script>
    <? include 'include/head.php'; ?>
  </head>
  <body>
    <?
    include 'include/menu.php';
    ?>
    <div class="contact_form">
      <ul>

        <form class="" action="" method="post">
          <li>
          	<h2>Клиент</h2>
            <span class="required_notification">* отмечены обязательные поля</span>
          </li>
        <li>
                    <label>Наименование:</label>
                    <input type="text" name="name" placeholder="Наименование" value="<? echo $row["name"]; ?>" required/>
                </li>
        <li>
                    <label>Это турагентство:</label>
                    <select class="" name="travel_agency">
                      <option <? if($row["travel_agency"] == 0) echo "selected"; ?> value="0">Нет</option>
                      <option <? if($row["travel_agency"] == 1) echo "selected"; ?> value="1">Да</option>
                    </select>
                </li>
        <li>
                    <label>Форма взаиморасчетов:</label>
                    <select class="" name="form_settlements">
                      <option <? if($row["form_settlements"] == 0) echo "selected"; ?> value="0">Деньгами</option>
                      <option <? if($row["form_settlements"] == 1) echo "selected"; ?> value="1">Баллами</option>
                    </select>
                </li>
                <li>
                  <span class="errors_add_employee"><? echo $errors; ?></span>
                  <span class="success_add_employee"><? echo $success ?></span>
                </li>
                <li>
                  <input type="submit" name="sub" value="Изменить" class="btn_submit">
                </li>
      </ul>

    </div>
  </body>
</html>
