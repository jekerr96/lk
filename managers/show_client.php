<?
	session_start();
	if(!isset($_SESSION["id"]) || $_SESSION["type"] == "client")
	{
		header("Location: /managers/auth.php");
	}

	include 'include/db_connect.php';

	$id = (int)$_GET["id"];
	$query = "SELECT name FROM clients WHERE id = $id";
	$result = mysqli_query($link, $query);;
	$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
	<title><? echo $row["name"]; ?></title>
	<script>var page = "client";</script>
	<?
	include 'include/head.php';
	?>
</head>
<body>
	<?
		include 'include/menu.php';
	?>
	<div class="content">
		<a class="btn_add" style="display: inline-block; width: auto;" href="add_user.php?id=<? echo $id ?>">Добавить пользователя</a>
		<div class="show_client">
	<?

	$query = "SELECT * FROM clients WHERE id=$id ORDER BY id ASC";
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
		<td><a href="managers/edit_client.php?id='.$row["id"].'"><img src="images/pencil.png" class="edit_client edit_image"/></a><img src="../images/delete.png" idd="'.$row["id"].'" class="delete_client delete_image"/>
		</tr>
		';
		echo "</table>";
		$query = "SELECT * FROM subdivision WHERE id_clients = ".$row['id']."";
		$result_sub = mysqli_query($link, $query);
		while($row_sub = mysqli_fetch_assoc($result_sub)){
			echo '
				<h2 class="head_type_service">'.$row_sub["name"].'</h2>
			';

			?>
				<table class="table_employees">
					<th>ФИО</th>
					<th>Телефон</th>
					<th>E-mail</th>
					<th>Мессенджер</th>
					<?
						$query = "SELECT id, fio, phone, email, messeger FROM users WHERE id_subdivision = ".$row_sub['id']."";
						$result_users = mysqli_query($link, $query);
						while($row_users = mysqli_fetch_assoc($result_users)){
							echo '
								<tr>
								<td>'.$row_users["fio"].'</td>
								<td>'.$row_users["phone"].'</td>
								<td>'.$row_users["email"].'</td>
								<td>'.$row_users["messeger"].'</td>
								<td><a href="edit_users.php?id='.$row_users["id"].'"><image class="edit_image" src="images/pencil.png"/></a>
				<image class="delete_image del_users" idd="'.$row_users["id"].'" src="images/delete.png"/>
								</tr>
							';
						}
					?>
				</table>
			<?

		}
	}

	?>
		<?

	}
	?>
</div>
</div>
</body>
</html>
