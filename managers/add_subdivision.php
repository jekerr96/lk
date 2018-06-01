<?
session_start();
if(!isset($_SESSION["id"]) || $_SESSION["type"] == "client" || $_SESSION["type"] != "administrator"){
die("У вас нет прав доступа");
}
  $id = (int)$_GET["id"];
  include 'include/db_connect.php';

  if(isset($_POST["sub"])){
    $id = $_POST["id"];
    $name = $_POST["name"];
    if($name == "") $errors = "Не введено наименование";
    $query = "INSERT INTO subdivision(name, id_clients) VALUES ('$name', $id)";
    if($errors == "")
      $result = mysqli_query($link, $query);

//hjk
//dfghj
    if($result)
      $success = "Добавление прошло успешно";
    else
      $errors .= mysqli_error($link);
  }
?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Новое подразделение</title>
    <script>var page = "subdivision";</script>
    <? include 'include/head.php'; ?>
  </head>
  <body>
    <? include 'include/menu.php'; ?>

    <div class="contact_form">
        <ul>
            <form action="" method="POST" enctype="multipart/form-data">
            <li>
                 <h2>Новый пользователь</h2>
                 <span class="required_notification">* отмечены обязательные поля</span>
            </li>
            <li>
                <label>Наименование:</label>
                <input type="text"  name="name" value=<? echo '"'.$name.'"';?>/>
            </li>
            <li>
            	<span class="errors_add_employee"><?  echo $errors; ?></span>
            	<span class="success_add_employee"><?  echo $success; ?></span>
            </li>
            <li>
                <input type="hidden" name="id" value="<?  echo $id; ?>">
            	<input type="submit" name="sub" value="Отправить" class="btn_submit">
              <?
              if(isset($_POST["sub"])){
                echo '<a class="btn_back" href="/managers/subdivisions.php"><div class="btn_block_back">Назад к списку</div></a>';
              }
              ?>
            </li>
          </form>
        </ul>

  </div>
  </body>
</html>
