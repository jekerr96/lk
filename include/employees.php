<?
session_start();
if($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_SESSION["id"] || $_SESSION["type"] != "client")){
die("У вас нет прав доступа");
}
$id = $_SESSION["id"];
?>
<div class="block_employees">
	<div class="btn_add_employee btn_add">
		Добавить
	</div>
	<?
	include 'db_connect.php';
	$query = "SELECT * FROM employees WHERE id_users = $id";
	$result = mysqli_query($link, $query);
	if(mysqli_num_rows($result) != 0){
	?>
<table class="table_employees">
	<th>ФИО</th>
	<th>Паспорт</th>
	<th>Место рождения</th>
	<th>Загран ФИО</th>
	<th>Загран паспорт</th>
	<th>Срок действия</th>
	<th>Визы</th>
	<th>Действия</th>
	<?
	while($row = mysqli_fetch_assoc($result)){
		echo '
		<tr idd="'.$row["id"].'">
		<td>'.$row["surname"].' '.$row["name"].' '.$row["patronymic"].'</td>
		<td>'.$row["series_number"].'</td>
		<td>'.$row["place_birth"].'</td>
		<td>'.$row["zagran_surname"].' '.$row["zagran_name"].' '.$row["zagran_patronymic"].'</td>
		<td>'.$row["zagran_series_number"].'</td>
		<td>'.$row["zagran_term"].'</td>
		<td>Посмотреть</td>
		<td><img src="../images/pencil.png" ide="'.$row["id"].'" class="edit_employee"/><img src="../images/delete.png" idd="'.$row["id"].'" class="delete_employee"/>
		</tr>
		';
	}
}

	?>
</table>
</div>
