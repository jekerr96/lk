<?
session_start();
if($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_SESSION["id"] || $_SESSION["type"] != "client")){
die("У вас нет прав доступа");
}
$id = $_SESSION["id"];
$id_clients = $_SESSION["id_clients"];

?>

<div class="block_subdivision">
	<div class="btn_add_subdivision btn_add">
		Добавить
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
