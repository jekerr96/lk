<?
	session_start();
	include 'include/db_connect.php';
	if((isset($_SESSION['id']) && $_SESSION["type"] == "client") || (isset($_COOKIE["user"]))){
		if(!isset($_SESSION["id"])){
			$id_cookie = $_COOKIE["user"];
			$query = "SELECT id_user FROM auth_cookie WHERE id_cookie = '$id_cookie'";
			$result = mysqli_query($link, $query);
			if(mysqli_num_rows($result) != 0){
				$row = mysqli_fetch_assoc($result);
				$id_user = $row["id_user"];

				$query = "SELECT * FROM users WHERE id = $id_user";
				$result = mysqli_query($link, $query);
				$row = mysqli_fetch_assoc($result);
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


			}
		}
		echo '<script type="text/javascript">
window.location = "/"
</script>';
	}
		$error = "";
		if(isset($_POST['sub'])){
			$login = $_POST["username"];
			$pass = sha1("werwer".sha1("fhFGHfdg46_ry".$_POST["password"]."dadgfh676YTRf_yu")."qweqwdsfdg");
			$query = "SELECT * FROM users WHERE login = '$login'";
			$result = mysqli_query($link, $query);
			if(mysqli_num_rows($result) == 0){
				$error = "Неверный логин или пароль";
			}
			else{
				$row = mysqli_fetch_assoc($result);
				if($row["password"] != $pass){

				}
				else if($row["block"] == 0 && $row["date_access"] < date("Y-m-d") && ($row["date_denied"] == "" || $row["date_denied"] > date("Y-m-d"))){
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

					if($_POST["remember"]){
						$id = $row["id"];
						$id = sha1("wervcbdsSfs".sha1($id)."gfhfgsfdpl".time());
						$id_manager = $row["id"];
						setcookie("user", $id, time() + (3600 * 24 * 30));
						$query = "INSERT INTO auth_cookie(id_cookie, id_manager) VALUES('$id', '$id_manager')";
						$result = mysqli_query($link, $query);
						if(!$result)
							die("Произошла ошибка");
					}
					echo '<script type="text/javascript">
	window.location = "/"
	</script>';
				}
				else{
					$error = "Доступ заблокирован";
				}
			}
		}
	?>
	<!DOCTYPE html>
<html lang="ru" >

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Авторизация</title>
      <link rel="stylesheet" href="auth.css">
</head>
<body>
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
			<div class="block_remember">
				<input type="checkbox" name="remember" id="remember" />
				<label for="remember">Запомнить меня</label>
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
