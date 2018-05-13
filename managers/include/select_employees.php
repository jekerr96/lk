<?
session_start();
	$id = $_POST["id"];
?>
<table class="table_employees">
	<th>ФИО</th>
	<th>Паспорт</th>
	<th>Место рождения</th>
	<th>Загран ФИО</th>
	<th>Загран паспорт</th>
	<th>Срок действия</th>
	<th>Визы</th>
	<?
	if($_SESSION["type"] == "administrator"){
		echo '<th>Действия</th>';
	}
	?>

	<?
		include 'db_connect.php';
		$query = "SELECT employees.id as id, surname, name, patronymic, series_number, place_birth, zagran_surname, zagran_name, zagran_patronymic, zagran_series_number,  zagran_term FROM employees INNER JOIN users ON users.id = employees.id_users WHERE id_clients = $id";
		$result = mysqli_query($link, $query);
		while($row = mysqli_fetch_assoc($result)){
			if($_SESSION["type"] == "administrator"){
				$tools = '
				<td><a href="edit_employees.php?id='.$row["id"].'"><image class="edit_image" src="images/pencil.png"/></a>
						<image class="delete_image del_employees" idd="'.$row["id"].'" src="images/delete.png"/>
				';
			}
			echo '
		<tr idd="'.$row["id"].'">
		<td>'.$row["surname"].' '.$row["name"].' '.$row["patronymic"].'</td>
		<td>'.$row["series_number"].'</td>
		<td>'.$row["place_birth"].'</td>
		<td>'.$row["zagran_surname"].' '.$row["zagran_name"].' '.$row["zagran_patronymic"].'</td>
		<td>'.$row["zagran_series_number"].'</td>
		<td>'.$row["zagran_term"].'</td>
		<td>Посмотреть</td>
		'.$tools.'
		</tr>
		';
		}
	?>
</table>
