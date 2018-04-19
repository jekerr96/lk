<?
	session_start();
	$id = $_SESSION["id"];
	$errors = "";
	$add = "";
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

	if($errors != "")
		die($errors); 

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
	include 'db_connect.php';
	$query = "INSERT INTO employees (`id_users`, `surname`, `name`, `patronymic`, `series_number`, `place_birth`, `zagran_surname`, `zagran_name`, `zagran_patronymic`, `zagran_series_number`, `zagran_term`) VALUES($id, '$surname', '$name', '$patronymic', '$passport', '$place_birth' $add)";
	$result = mysqli_query($link, $query);
	if($result)
		echo "1";
?>