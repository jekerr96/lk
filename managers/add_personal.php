<?
  session_start();
  if(!isset($_SESSION["id"]) || $_SESSION["type"] == "client"){
  die("У вас нет прав доступа");
  }
  if($_SESSION["type"] != "administrator")
    die("У вас нет доступа");

  include 'include/db_connect.php';
  if(isset($_POST["sub"])){
    $fio = $_POST["fio"];
    $login = $_POST["login"];
    $pass = sha1("werwer".sha1("fhFGHfdg46_ry".$_POST["password"]."dadgfh676YTRf_yu")."qweqwdsfdg");
    $email = $_POST["email"];
    $role = $_POST["role"];
    $block = $_POST["block"];

    if($block) $block = 1;
    else $block = 0;
    $query = "INSERT INTO managers(fio, login, password, email, type, block) VALUES('$fio', '$login', '$pass', '$email', '$role', $block)";
    $result = mysqli_query($link, $query);
    if($result)
      header("Location: personal.php");
    else $errors = mysqli_error($link);
  }
?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Добавление сотрудника</title>
    <script>var page = "personal";</script>
    <? include 'include/head.php'; ?>
  </head>
  <body>
<? include 'include/menu.php'; ?>
<div class="contact_form">
  <ul>

    <form class="" action="" method="post">
      <li>
      	<h2>Сотрудник</h2>
        <span class="required_notification">* отмечены обязательные поля</span>
      </li>
    <li>
                <label>ФИО:</label>
                <input type="text" name="fio" placeholder="ФИО" required/>
            </li>
    <li>
                <label>Логин:</label>
                <input type="text" name="login" placeholder="Логин" required/>
            </li>
    <li>
                <label>Пароль:</label>
                <input type="password" name="password" placeholder="Пароль" required/>
            </li>
            <li>
                <label>E-mail:</label>
                <input type="email" name="email" placeholder="E-mail"/>
            </li>
            <li>
                <label>Роль:</label>
                <select name="role">
            	<option value='manager'>Менеджер</option>
            	<option value='buhgalter'>Бухгалтер</option>
              <option value='administrator'>Администратор</option>
                </select>
            </li>
    <li>
                <label>Заблокировать:</label>
                <input type="checkbox" name="block" />
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
