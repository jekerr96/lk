<?
	session_start();
	if(isset($_SESSION['id']) && $_SESSION["type"] == "manager"){
		//header("Location: /");
	}
?><!DOCTYPE html>
<html lang="ru" >

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Авторизация</title>
      <link rel="stylesheet" href="auth.css">
</head>
<body>
	<?
		$error = "";
		if(isset($_POST['sub'])){
			$login = $_POST["username"];
			$pass = sha1("werwer".sha1("fhFGHfdg46_ry".$_POST["password"]."dadgfh676YTRf_yu")."qweqwdsfdg");
			include 'include/db_connect.php';
			$query = "SELECT * FROM managers WHERE login = '$login'";
			$result = mysqli_query($link, $query);
			if(mysqli_num_rows($result) == 0){
				$error = "Неверный логин или пароль";
			}
			else{
				$row = mysqli_fetch_assoc($result);
				if($row["password"] != $pass){
					$error = "Неверный логин или пароль";
				}
				else{
					$_SESSION["type"] = $row["type"];
					$_SESSION["id"] = $row["id"];
					$_SESSION["id_clients"] = $row["id_clients"];
					$_SESSION["email"] = $row["email"];
					$_SESSION["phone"] = $row["phone"];
					$_SESSION["messeger"] = $row["messeger"];
					$_SESSION["fio"] = $row["fio"];
					$_SESSION["date_access"] = $row["date_access"];
					$_SESSION["date_denied"] = $row["date_denied"];
					$_SESSION["avatar"] = $row["avatar"];
					$_SESSION["block"] = $row["block"];
					echo '<script type="text/javascript">
window.location = "/managers/"
</script>';
				}
			}
		}
	?>
<div class="container">
	<section id="content">
		<form method="POST" action="">
			<h1>Авторизация</h1>
			<span class="error_auth"><? echo $error; ?></span>
			<div>
				<input type="text" placeholder="Логин" required="" name="username" id="username" />
			</div>
			<div>
				<input type="password" placeholder="Пароль" required="" name="password" id="password" />
			</div>
			<div>
				<input type="submit" name="sub" value="Войти" />
				<a href="restore_password.php">Забыли пароль?</a>
			</div>
		</form><!-- form -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>
