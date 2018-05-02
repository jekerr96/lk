<?
	session_start();
	if(!isset($_SESSION["id"]) || $_SESSION["type"] == "client")
	{
		header("Location: /managers/auth.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Список клиентов</title>
	<?
		include 'include/head.php';
	?>
</head>
<body>
	<?
		include 'include/menu.php';
	?>
	<div class="block_clients">
	<a href="add_clients.php" class="btn_add">Добавить</a>
	<?
	include 'include/db_connect.php';
	$query = "SELECT * FROM clients ORDER BY id ASC";
	$result = mysqli_query($link, $query);
	if(mysqli_num_rows($result) != 0){
		?>

	<table class="table_clients table_employees">
	<th>Наименование</th>
	<th>Это турагенство</th>
	<th>Форма взаиморасчетов</th>
	<?
	while($row = mysqli_fetch_assoc($result)){
		$travel_agency = "";
		$form_settlements = "";
		if($row["travel_agency"] == 0)
			$travel_agency = "<image src='images/cross.png' class='its_travel_agency'/>";
		else
			$travel_agency = "<image src='images/red_agenstvo.png' class='its_travel_agency'/>";

		if($row["form_settlements"] == 0)
			$form_settlements = "Деньгами";
		else
			$form_settlements = "Баллами";

		echo '
		<tr>
		<td>'.$row["name"].'</td>
		<td>'.$travel_agency.'</td>
		<td>'.$form_settlements.'</td>
		<td><a href="show_client.php?id='.$row["id"].'"><img class="show_image" src="images/show.png"/></a><a href="managers/edit_client.php?id='.$row["id"].'"><img src="images/pencil.png" class="edit_client edit_image"/></a><img src="../images/delete.png" idd="'.$row["id"].'" class="delete_client delete_image"/>
		</tr>
		';
	}
	}
	?>
</table>
</div>
</body>
</html>
