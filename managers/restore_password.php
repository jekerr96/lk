<?
	session_start();
	if(!isset($_SESSION["id"]) || $_SESSION["type"] == "client"){
  die("У вас нет прав доступа");
  }
	if(isset($_SESSION['id'])){
		//header("Location: /");
	}
?><!DOCTYPE html>
<html lang="ru" >

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Восстановление пароля</title>
      <link rel="stylesheet" href="auth.css">
</head>
<body>

	<?
		if(isset($_POST["sub"])){
			$arr = array(
				 'a','b','c','d','e','f',
                 'g','h','i','j','k','l',
                 'm','n','o','p','r','s',
                 't','u','v','x','y','z',
                 'A','B','C','D','E','F',
                 'G','H','I','J','K','L',
                 'M','N','O','P','R','S',
                 'T','U','V','X','Y','Z',
                 '1','2','3','4','5','6',
                 '7','8','9','0');
    $token = "";
    for($i = 0; $i < 32; $i++)
    {
      $index = rand(0, count($arr) - 1);
      $token .= $arr[$index];
	}

			include 'include/db_connect.php';
			$email = $_POST['email'];
			$query = "SELECT email FROM managers WHERE email = '$email'";
			$result = mysqli_query($link, $query);
			if(mysqli_num_rows($result) != 0){
				 //$to = $email; //Кому
				 $to = "jekerr96@gmail.com"; //Кому
  				 $from = "Авианебо личный кабинет <lk@lk.ru>"; //От кого
  				 $subject = "Восстановление пароля"; //Тема
  				 $message = "Вы запросили восстановление пароля.\nПерейдите по ссылке <a href='http://lk/managers/new_password.php?token=".$token."'>восстановить пароль</a>"; //Текст письма
  				 $boundary = "---"; //Разделитель
  				 /* Заголовки */
  				 $headers = "From: $from\nReply-To: $from\n";
  				 $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"";
  				 $body = "--$boundary\n";
  				 /* Присоединяем текстовое сообщение */
  				 $body .= "Content-type: text/html; charset='utf-8'\n";
  				 $body .= "Content-Transfer-Encoding: quoted-printablenn";
 				  $body .= $message."\n";
  				 $body .= "--$boundary\n";
  				 mail($to, $subject, $body, $headers); //Отправляем письмо

  				 $query = "INSERT INTO restore_password(token, email) VALUES('$token', '$email')";
  				 $result = mysqli_query($link, $query);
  				 $success = "Письмо отправлено на вашу почту";
			}
			else{
				$error = "Такой E-mail не зарегистрирован";
			}
		}
	?>
<div class="container">
	<section id="content">
		<form method="POST" action="">
			<h1 class="restore_password_h1">Восстановление пароля</h1>
			<span class="error_auth"><? echo $error; ?></span>
			<span class="success_auth"><? echo $success; ?></span>
			<div>
				<input type="email" placeholder="E-mail" name="email" required="" id="email" />
			</div>
			<div>
				<input type="submit" id="sub" name="sub" value="Отправить" style="float: none;" />
			</div>
		</form><!-- form -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>
