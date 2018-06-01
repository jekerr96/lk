<?
    session_start();
    if($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_SESSION["id"] || $_SESSION["type"] != "client")){
  	die("У вас нет прав доступа");
  }
    $id = $_SESSION["id"];
    $ide = $_POST["ide"];

    include 'db_connect.php';
    $query = "SELECT * FROM employees WHERE id = $ide";
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

<div class="contact_form">
    <ul>
        <li>
             <h2>Изменение сотрудника</h2>
             <span class="required_notification">* отмечены обязательные поля</span>
        </li>
        <li>
            <label>Фамилия:</label>
            <input type="text" id="surname"  placeholder="Фамилия" required value=<? echo '"'.$surname.'"';?>/>
        </li>
        <li>
            <label>Имя:</label>
            <input type="text" id="name" placeholder="Имя" required value=<? echo '"'.$name.'"';?>/>
        </li>
        <li>
            <label>Отчество:</label>
            <input type="text" id="patronymic" placeholder="Отчество" required value=<? echo '"'.$patronymic.'"';?>/>
        </li>
        <li>
            <label>Паспорт:</label>
            <input type="text" id="passport" placeholder="Серия номер" required pattern="\d{4}\s\d{6}" value=<? echo '"'.$passport.'"';?>/>
            <span class="form_hint">Пример: 1234 123456</span>
        </li>
        <li>
            <label>Место рождения:</label>
            <input type="text" id="place_birth" placeholder="Место рождения" required value=<? echo '"'.$place_birth.'"';?>/>
        </li>
        <li>
            <label>Загран фамилия:</label>
            <input type="text" id="zagran_surname" placeholder="Загран фамилия" value=<? echo '"'.$zagran_surname.'"';?>/>
        </li>
        <li>
            <label>Загран имя:</label>
            <input type="text" id="zagran_name" placeholder="Загран имя" value=<? echo '"'.$zagran_name.'"';?>/>
        </li>
        <li>
            <label>Загран фамилия:</label>
            <input type="text" id="zagran_patronymic" placeholder="Загран отчество" value=<? echo '"'.$zagran_patronymic.'"';?>/>
        </li>
        <li>
            <label>Загран паспорт:</label>
            <input type="text" id="zagran_series_number" placeholder="Загран паспорт" value=<? echo '"'.$zagran_series_number.'"';?>/>
        </li>
        <li>
            <label>Срок действия:</label>
            <input type="text" id="zagran_term" placeholder="Срок действия" value=<? echo '"'.$zagran_term.'"';?>/>
        </li>
        <li>
        	<span class="errors_add_employee"></span>
        	<span class="success_add_employee"></span>
        </li>
        <li>
        	<div ide=<? echo '"'.$ide.'"'; ?> class="edit_employee_submit btn_submit" type="submit">Изменить</div>
        </li>
    </ul>

</div>
