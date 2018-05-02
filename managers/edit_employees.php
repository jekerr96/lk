<?
    session_start();
    $id = $_GET["id"];
    include 'include/db_connect.php';

    if(isset($_POST["sub"])){
        $id = $_POST["id"];

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
    $query = "UPDATE `employees` SET `surname`= '$surname',`name`= '$name',`patronymic`= '$patronymic',`series_number`= '$passport',`place_birth`= '$place_birth',`zagran_surname`= '$zagran_surname',`zagran_name`= '$zagran_name',`zagran_patronymic`= '$zagran_patronymic',`zagran_series_number`= '$zagran_series_number',`zagran_term`= '$zagran_term' WHERE id = $id";
    $result = mysqli_query($link, $query);
    if($result)
        $success = "Изменение прошло успешно";
    else
        $errors .= mysqli_error($link);
}
    }

    $query = "SELECT * FROM employees WHERE id = $id";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);

    $surname = $row["surname"];
    $name = $row["name"];
    $patronymic = $row["patronymic"];
    $passport = $row["series_number"];
    $place_birth = $row["place_birth"];
    $zagran_surname = $row["zagran_surname"];
    $zagran_name = $row["zagran_name"];
    $zagran_patronymic = $row["zagran_patronymic"];
    $zagran_series_number = $row["zagran_series_number"];
    $zagran_term = $row["zagran_term"];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Сотрудники</title>
    <script>var page = "employee";</script>
    <? include 'include/head.php'; ?>
</head>
<body>
    <? include 'include/menu.php'; ?>
<div class="contact_form">
    <ul>
        <form action="" method="POST">
        <li>
             <h2>Изменение сотрудника</h2>
             <span class="required_notification">* отмечены обязательные поля</span>
        </li>
        <li>
            <label>Фамилия:</label>
            <input type="text" id="surname" name="surname"  placeholder="Фамилия" required value=<? echo '"'.$surname.'"';?>/>
        </li>
        <li>
            <label>Имя:</label>
            <input type="text" id="name" placeholder="Имя" name="name" required value=<? echo '"'.$name.'"';?>/>
        </li>
        <li>
            <label>Отчество:</label>
            <input type="text" id="patronymic" placeholder="Отчество" name="patronymic" required value=<? echo '"'.$patronymic.'"';?>/>
        </li>
        <li>
            <label>Паспорт:</label>
            <input type="text" id="passport" placeholder="Серия номер" name="passport" required pattern="\d{4}\s\d{6}" value=<? echo '"'.$passport.'"';?>/>
            <span class="form_hint">Пример: 1234 123456</span>
        </li>
        <li>
            <label>Место рождения:</label>
            <input type="text" id="place_birth" placeholder="Место рождения" name="place_birth" required value=<? echo '"'.$place_birth.'"';?>/>
        </li>
        <li>
            <label>Загран фамилия:</label>
            <input type="text" id="zagran_surname" placeholder="Загран фамилия" name="zagran_surname" value=<? echo '"'.$zagran_surname.'"';?>/>
        </li>
        <li>
            <label>Загран имя:</label>
            <input type="text" id="zagran_name" placeholder="Загран имя" name="zagran_name" value=<? echo '"'.$zagran_name.'"';?>/>
        </li>
        <li>
            <label>Загран фамилия:</label>
            <input type="text" id="zagran_patronymic" placeholder="Загран отчество" name="zagran_patronymic" value=<? echo '"'.$zagran_patronymic.'"';?>/>
        </li>
        <li>
            <label>Загран паспорт:</label>
            <input type="text" id="zagran_series_number" placeholder="Загран паспорт" name="zagran_series_number" value=<? echo '"'.$zagran_series_number.'"';?>/>
        </li>
        <li>
            <label>Срок действия:</label>
            <input type="text" id="zagran_term" placeholder="Срок действия" name="zagran_term" value=<? echo '"'.$zagran_term.'"';?>/>
        </li>
        <li>
        	<span class="errors_add_employee"><?  echo $errors; ?></span>
        	<span class="success_add_employee"><?  echo $success; ?></span>
        </li>
        <li>
            <input type="hidden" name="id" value="<?  echo $id; ?>">
        	<input type="submit" name="sub" value="Изменить" class="btn_submit">
        </li>
        </form>
    </ul>

</div>
</body>
</html>
