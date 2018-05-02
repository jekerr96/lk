<!DOCTYPE html>
<html>
<head>
	<title>Сотрудники</title>
	<?
		include 'include/head.php';
	?>
</head>
<body>
<?
	include 'include/menu.php';
?>
<div class="content">
	<a href="" class="link_add_employee"></a>
	<div class="employees">
		<h2 class="head_client">Клиент</h2>
		<select class="select_employees">
			<option value="-1">Пусто</opton>
			<?
				include 'include/db_connect.php';
				$query = "SELECT id, name FROM clients";
				$result = mysqli_query($link, $query);
				while($row = mysqli_fetch_assoc($result)){
					echo '
						<option value="'.$row["id"].'"">'.$row["name"].'</opton>
					';
				}
			?>
		</select>

	<div class="insert_employees">

	</div>

	</div>
</div>
</body>
</html>
