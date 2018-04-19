<? 
session_start();
$id = $_SESSION["id"];
$id_clients = $_SESSION["id_clients"];

?>

<div class="block_subdivision">
	<div class="add_subdivision">
		<div>
			<div class="btn_add_subdivision green_add_subdivision">
			<div class="add_subdivision_text">Добавить</div>
			<div class="add_subdivision_plus">+</div>
			</div>
		</div>
	</div>
<?
	include 'db_connect.php';
	$query = "SELECT * FROM subdivision WHERE id_clients = $id_clients";
	$result = mysqli_query($link, $query);
	if(mysqli_num_rows($result) != 0){
		?>
	
	<table class="table_employees">
	<th>Наименование</th>
	<th>Действия</th>
	<?
	while($row = mysqli_fetch_assoc($result)){
		echo '
		<tr idd="'.$row["id"].'">
		<td>'.$row["name"].'</td>
		<td><img src="../images/pencil.png" ide="'.$row["id"].'" class="edit_subdivision"/><img src="../images/delete.png" idd="'.$row["id"].'" class="delete_subdivision"/>
		</tr>
		';
	}
	}
	?>
</table>
</div>