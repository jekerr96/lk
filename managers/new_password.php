<?
	session_start();
	if(isset($_SESSION['id'])){
		//header("Location: /");
	}
	include 'include/db_connect.php';
		$error = "";
		if(isset($_GET["token"]) && !isset($_POST["sub"])){
			$token = $_GET['token'];
			$query = "SELECT * FROM restore_password WHERE token = '$token'";
			$result = mysqli_query($link, $query);
			if(mysqli_num_rows($result) == 0){
				$error = "Данная ссылка больше не действительна1";
			}
			else{
				$row = mysqli_fetch_assoc($result);
				$date = date_create();
				$timestamp = date_timestamp_get($date);
				$used = $row["used"];
				if($timestamp - strtotime($row['currentTime']) > 3600 || $used == 1){
					$error = "Данная ссылка больше не действительна";
				}
			}
		}

		if($error != "")
			die($error);

		
		if(isset($_POST['sub'])){
			
			$token = $_POST["token"];
			$query = "SELECT email FROM restore_password WHERE token = '$token' ORDER BY id ASC";
			$result = mysqli_query($link, $query);
			$row = mysqli_fetch_assoc($result);
			$email = $row["email"];

			$pass = sha1("werwer".sha1("fhFGHfdg46_ry".$_POST["password"]."dadgfh676YTRf_yu")."qweqwdsfdg");
			$query = "UPDATE managers SET password = '$pass' WHERE email = '$email'";
			$result = mysqli_query($link, $query);

			$query = "UPDATE restore_password SET used = 1 WHERE token = '$token'";
			$result = mysqli_query($link, $query);

			$query = "SELECT * FROM managers WHERE email = '$email'";
			$result = mysqli_query($link, $query);
			$row = mysqli_fetch_assoc($result);
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
?><!DOCTYPE html>
<html lang="ru" >

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Новый пароль</title>
      <link rel="stylesheet" href="auth.css">
</head>
<body>
	<script type="text/javascript">
window.onload = function () {
    document.getElementById("password1").onchange = validatePassword;
    document.getElementById("password2").onchange = validatePassword;
}
function validatePassword(){
var pass2=document.getElementById("password2").value;
var pass1=document.getElementById("password1").value;
if(pass1!=pass2)
    document.getElementById("password2").setCustomValidity("Пароли не совпадают");
else
    document.getElementById("password2").setCustomValidity('');
//empty string means no validation error
}
</script>

<div class="container">
	<section id="content">
		<form method="POST" action="">
			<h1>Новый пароль</h1>
			<span class="error_auth"><? echo $error; ?></span>
			<div>
				<input type="password" placeholder="Пароль" required="" name="password" id="password1" />
			</div>
			<input type="hidden" name="token" value=<? echo "'".$_GET['token']."'"; ?>>
			<div>
				<input type="password" placeholder="Подтверждение пароля" required="" name="password2" id="password2" />
			</div>
			<div>
				<input type="submit" name="sub" value="Сменить" style="float: none;" />
			</div>
		</form><!-- form -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>
