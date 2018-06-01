<?
	session_start();
	if($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_SESSION["id"] || $_SESSION["type"] != "client")){
	die("У вас нет прав доступа");
}
	$id = $_SESSION["id"];
	$errors = "";
	$add = "";

	$ide = $_POST["ide"];
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
	$query = "UPDATE `employees` SET `surname`= '$surname',`name`= '$name',`patronymic`= '$patronymic',`series_number`= '$passport',`place_birth`= '$place_birth',`zagran_surname`= '$zagran_surname',`zagran_name`= '$zagran_name',`zagran_patronymic`= '$zagran_patronymic',`zagran_series_number`= '$zagran_series_number',`zagran_term`= '$zagran_term' WHERE id = $ide";
	$result = mysqli_query($link, $query);
	if($result)
		echo "1";
?>
