<?
session_start();
if(!isset($_SESSION["id"]) || $_SESSION["type"] == "client"){
die("У вас нет прав доступа");
}
if($_SESSION["type"] != "administrator")
  die("У вас нет доступа");

include 'include/db_connect.php';
if(isset($_POST["sub"])){
  $name = $_POST["name"];
  $travel = $_POST["travel_agency"];
  $form = $_POST["form_settlements"];

  $query = "INSERT INTO clients(name, form_settlements, travel_agency) VALUES('$name', $form, $travel)";
  $result = mysqli_query($link, $query);
  if($result) header("Location: clients.php");
  else $error = mysqli_error($link);
}

?><!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Новый клиент</title>
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
                    <input type="text" name="name" placeholder="Наименование" required/>
                </li>
        <li>
                    <label>Это турагентство:</label>
                    <select class="" name="travel_agency">
                      <option value="0">Нет</option>
                      <option value="1">Да</option>
                    </select>
                </li>
        <li>
                    <label>Форма взаиморасчетов:</label>
                    <select class="" name="form_settlements">
                      <option value="0">Деньгами</option>
                      <option value="1">Баллами</option>
                    </select>
                </li>
                <li>
                  <span class="errors_add_employee"><? echo $errors; ?></span>
                  <span class="success_add_employee"><? echo $success ?></span>
                </li>
                <li>
                  <input type="submit" name="sub" value="Добавить" class="btn_submit">
                </li>
      </ul>

    </div>
  </body>
</html>
