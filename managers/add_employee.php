<?
session_start();
if(!isset($_SESSION["id"]) || $_SESSION["type"] == "client" || $_SESSION["type"] != "administrator"){
die("У вас нет прав доступа");
}
$id = $_GET["id"];
include 'include/db_connect.php';
if(isset($_POST["sub"])){
$errors = "";
$success = "";
$add = "";
$id_users = $_POST["id_users"];
$surname = $_POST["surname"];
$name = $_POST["name"];
$patronymic = $_POST["patronymic"];
$passport = $_POST["passport"];
$place_birth = $_POST["place_birth"];
$zagran_surname = $_POST["zagran_surname"];
$zagran_name = $_POST["zagran_name"];
$zagran_patronymic = $_POST["zagran_patronymic"];
$zagran_series_number = $_POST["zagran_series_number"];
$zagran_term = $_POST["zagran_term"];

if($surname == "") $errors .= "Не указана фамилия<br>";
if($name == "") $errors .= "Не указано имя<br>";
if($patronymic == "") $errors .= "Не указано отчество<br>";
if($passport == "") $errors .= "Не указан паспорт<br>";
if($place_birth == "") $errors .= "Не указано место рождения";


if($zagran_surname != "") $add .=  ", " + $zagran_surname;
else $add .= ", NULL";
if($zagran_name != "") $add .= ", " + $zagran_name;
else $add .= ", NULL";
if($zagran_patronymic != "") $add .= ", " + $zagran_patronymic;
else $add .= ", NULL";
if($zagran_series_number != "") $add .= ", " + $zagran_series_number;
else $add .= ", NULL";
if($zagran_term != "") $add .= ", " + $zagran_term;
else $add .= ", NULL";
if($errors == ""){
$query = "INSERT INTO employees (`id_users`, `surname`, `name`, `patronymic`, `series_number`, `place_birth`, `zagran_surname`, `zagran_name`, `zagran_patronymic`, `zagran_series_number`, `zagran_term`) VALUES($id_users, '$surname', '$name', '$patronymic', '$passport', '$place_birth' $add)";
$result = mysqli_query($link, $query);
if($result)
  $success = "Добавление прошло успешно";
else
  $errors .= "<br>".mysqli_error($link);
}
}
?>

<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Новый сотрудник</title>
    <script>var page = "employee";</script>
    <? include 'include/head.php'; ?>
  </head>
  <body>
    <? include 'include/menu.php'; ?>
    <div class="contact_form">
        <ul>
          <form action="" method="post">

            <li>
                 <h2>Добавление сотрудника</h2>
                 <span class="required_notification">* отмечены обязательные поля</span>
            </li>
            <li>
                <label>Пользователь клиента</label>
                <select class="" name="id_users">
                  <?
                    $query = "SELECT id, fio FROM users WHERE id_clients = $id";
                    $result = mysqli_query($link, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                      $select = "";
                      if($id_users == $row["id_users"])
                        $select = "selected";
                      echo '
                        <option $select value="'.$row["id"].'">'.$row["fio"].'</option>
                      ';
                    }


                  ?>
                </select>
            </li>
            <li>
                <label>Фамилия:</label>
                <input type="text" name="surname"  placeholder="Фамилия" value="<? echo $surname; ?>" required />
            </li>
            <li>
                <label>Имя:</label>
                <input type="text" name="name" placeholder="Имя" value="<? echo $name; ?>" required />
            </li>
            <li>
                <label>Отчество:</label>
                <input type="text" name="patronymic" placeholder="Отчество" value="<? echo $patronymic; ?>" required />
            </li>
            <li>
                <label>Паспорт:</label>
                <input type="text" name="passport" placeholder="Серия номер" value="<? echo $passport; ?>" required pattern="\d{4}\s\d{6}" />
                <span class="form_hint">Пример: 0123 123456</span>
            </li>
            <li>
                <label>Место рождения:</label>
                <input type="text" name="place_birth" placeholder="Место рождения" value="<? echo $place_birth; ?>" required />
            </li>
            <li>
                <label>Загран фамилия:</label>
                <input type="text" name="zagran_surname" placeholder="Загран фамилия" value="<? echo $zagran_surname; ?>"/>
            </li>
            <li>
                <label>Загран имя:</label>
                <input type="text" name="zagran_name" placeholder="Загран имя" value="<? echo $zagran_name; ?>"/>
            </li>
            <li>
                <label>Загран фамилия:</label>
                <input type="text" name="zagran_patronymic" placeholder="Загран отчество" value="<? echo $zagran_patronymic; ?>"/>
            </li>
            <li>
                <label>Загран паспорт:</label>
                <input type="text" id="zagran_series_number" placeholder="Загран паспорт" value="<? echo $zagran_series_number; ?>"/>
            </li>
            <li>
                <label>Срок действия:</label>
                <input type="text" name="zagran_term" placeholder="Срок действия" value="<? echo $zagran_term; ?>"/>
            </li>
            <li>
            	<span class="errors_add_employee"><? echo $errors; ?></span>
            	<span class="success_add_employee"><? echo $success ?></span>
            </li>
            <li>
              <input type="submit" name="sub" value="Добавить" class="btn_submit">
              <?
              if(isset($_POST["sub"])){
                echo '<a class="btn_back" href="/managers/employees.php"><div class="btn_block_back">Назад к списку</div></a>';
              }
              ?>
            </li>

          </form>
        </ul>

    </div>
  </body>
</html>
