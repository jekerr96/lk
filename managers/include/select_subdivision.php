<?
session_start();
if($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_SESSION["id"]) || $_SESSION["type"] == "client"){
die("У вас нет прав доступа");
}
	$id = $_POST["id"];
?>
<table class="table_employees">
	<th>Наименование</th>
	<?
		include 'db_connect.php';
		$query = "SELECT id,name FROM subdivision WHERE id_clients = $id";
		$result = mysqli_query($link, $query);
		while($row = mysqli_fetch_assoc($result)){
			if($_SESSION["type"] == "administrator"){
				$tools = '
				<td><a href="edit_subdivision.php?id='.$row["id"].'"><image class="edit_image" src="images/pencil.png"/></a>
				<image class="delete_image del_subdivision" idd="'.$row["id"].'" src="images/delete.png"/>
				</td>
				';
			}
			echo '
				<tr>
				<td>'.$row["name"].'</td>
				'.$tools.'
				</tr>
			';
		}
	?>
</table>
