<?
	session_start();
	if(!isset($_SESSION["id"]) || $_SESSION["type"] == "client" || $_SESSION["type"] == "buhgalter"){
  die("У вас нет прав доступа");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Подразделения</title>
	<script>var page = "subdivision";</script>
	<?
		include 'include/head.php';
	?>
</head>
<body>
<?
	include 'include/menu.php';
	if($_SESSION["type"] == "administrator"){
		echo '<a href="" class="link_add_subdivision"></a>';
	}
?>


<div class="content">
	<div class="subdivision">
		<h2 class="head_client">Клиент</h2>
		<select class="select_subdivision">
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

	<div class="insert_subdivision">

	</div>

	</div>
</div>
</body>
</html>
