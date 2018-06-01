<?
session_start();
if(!isset($_SESSION["id"]) || $_SESSION["type"] == "client" || $_SESSION["type"] == "buhgalter"){
die("У вас нет прав доступа");
}
  $id = (int)$_GET["id"];
  include 'include/db_connect.php';

  if(isset($_POST["sub"])){
    $description = $_POST["description"];
    $form = $_POST["form"];
    $term = $_POST["term"];
    $address = $_POST["address"];
    $users = $_POST["users"];

    $query = "INSERT INTO trips (description, id_status, priority, id_users, id_form, term, address, version) VALUES ('$description', 1, 1, $users,  '$form', '$term', '$address', 1)";
    $result = mysqli_query($link, $query);
    if($result){
      $success = "Добавление прошло успешно";
    }
    else{
      $errors = mysqli_error($link);
    }
  }
?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Деловая поездка</title>
    <script>var page = "trip";</script>
    <? include 'include/head.php'; ?>
  </head>
  <body>
    <? include 'include/menu.php'; ?>
    <div class="contact_form">
        <ul>
          <form class="" action="" method="post">
            <li>
                 <h2>Добавление деловой поездки</h2>
                 <span class="required_notification">* отмечены обязательные поля</span>
            </li>
            <li>
                <label>Описание:</label>
                <input type="text" name="description"  placeholder="Описание" />
            </li>
            <li>
                <label>Форма оплаты:</label>
                <select name="form">
                    <?
                        include 'db_connect.php';
                        $query = "SELECT * FROM forms WHERE permission = 1";
                        $result = mysqli_query($link, $query);
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option value='".$row['id']."'>".$row['name']."</option>";
                        }
                    ?>
                </select>
            </li>
            <li>
                <label>Срок оплаты:</label>
                <input type="date" name="term" placeholder="Срок оплаты"/>
            </li>
            <li>
                <label>Адрес доставки документов:</label>
                <input type="text" name="address" placeholder="Адрес доставки документов"/>
            </li>
            <li>
              <label>Пользователь:</label>
              <select class="" name="users">
                <?
                  $query = "SELECT users.id as id, fio FROM users INNER JOIN clients ON clients.id = users.id_clients WHERE clients.id = $id";
                  $result = mysqli_query($link, $query);
                  while($row = mysqli_fetch_assoc($result)){
                    echo '
                      <option value="'.$row["id"].'">'.$row["fio"].'</option>
                    ';
                  }
                ?>
              </select>
            </li>
            <li>
              <span class="errors_add_employee"><? echo $errors; ?></span>
              <span class="success_add_employee"><? echo $success ?></span>
            </li>
            <li>
            	<input type="submit" name="sub" value="Добавить" class="btn_submit">
              <?
              if(isset($_POST["sub"])){
                echo '<a class="btn_back" href="/managers/trips.php><div class="btn_block_back">Назад к списку</div></a>';
              }
              ?>
            </li>

          </form>
        </ul>

    </div>
  </body>
</html>
