<?
  session_start();
  if(!isset($_SESSION["id"]) || $_SESSION["type"] == "client"){
  die("У вас нет прав доступа");
  }
  if($_SESSION["type"] != "administrator")
    die("У вас нет доступа");
  include 'include/db_connect.php';
?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Персонал</title>
    <script>var page = "personal";</script>
    <?
  		include 'include/head.php';
  	?>
  </head>
  <body>

    <?
    	include 'include/menu.php';
    ?>
    <a class="btn_add" style="display: inline-block; width: auto;" href="add_personal.php">Добавить</a>
    <div class="content">
      <div class="personal">
        <table class="table_personal table_employees">
          <th>ФИО</th>
          <th>Логин</th>
          <th>E-mail</th>
          <th>Роль</th>
          <th>Заблокирован</th>
        <?
        $query = "SELECT * FROM managers WHERE fio != '-'";
        $result = mysqli_query($link, $query);
        while($row = mysqli_fetch_assoc($result)){
          $role = "";
          switch($row["type"]){
            case "administrator":
              $role = "Администратор";
              break;
            case "manager":
              $role = "Менеджер";
              break;
            case "buhgalter":
              $role = "Бухгалтер";
              break;
          }
          if($row["block"] == 1) $block = "Да";
          else $block = "Нет";
          echo '
          <tr>
          <td>'.$row["fio"].'</td>
          <td>'.$row["login"].'</td>
          <td>'.$row["email"].'</td>
          <td>'.$role.'</td>
          <td>'.$block.'</td>
          <td>
  				<a href="edit_personal.php?id='.$row["id"].'"><image class="edit_image" src="images/pencil.png"/></a>
  						<image class="delete_image del_personal" idd="'.$row["id"].'" src="images/delete.png"/>
          </td>
          </tr>
          ';
        }
        ?>
      </div>
    </div>
  </body>
</html>
