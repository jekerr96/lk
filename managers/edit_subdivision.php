<?
	if(isset($_POST["submit"])){
		$name = $_POST["name"];
		include 'include/db_connect.php';
		$id = $_POST["id"];
		$query = "UPDATE subdivision SET name = '$name' WHERE id = $id";
		$result = mysqli_query($link, $query);
		if($result)
			$success = "Изменение успешно";
		else
			$error = "Произошла ошибка\n".mysqli_error($link);

	}
	else{
				include 'include/db_connect.php';
				$id = (int)$_GET["id"];
				$query = "SELECT name FROM subdivision WHERE id = $id";
				$result = mysqli_query($link, $query);
				$name = $row["name"];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Подразделения</title>
	<script>var page = "ыгившмшышщт";</script>
	<?
		include 'include/head.php';
	?>
</head>
<body>
<?
	include 'include/menu.php';
?>
<div class="content">
	<div class="subdivision">
		<div class="contact_form">
    <ul>
        <li>
             <h2>Изменение подразделения</h2>
             <span class="required_notification">* отмечены обязательные поля</span>
        </li>
        <form action="" method="POST">
        <li>
            <label>Наименование:</label>
            <input type="text" id="name" name="name" placeholder="Наименование" required value=<? echo '"'.$name.'"';?>/>
            <input type="hidden" name="id" value="<? echo $_GET['id']; ?>">
        </li>
        <li>
        	<span class="errors_add_employee"><? echo $error; ?></span>
        	<span class="success_add_employee"><? echo $success; ?></span>
        </li>
        <li>
        	<input type="submit" value="Изменить" name="submit" class="btn_submit">
        </li>
        </form>
    </ul>

</div>


	</div>
</div>
</body>
</html>
