<?
  $id = (int)$_GET["id"];
  include 'include/db_connect.php';

  if(isset($_POST["sub"])){
    $id = $_POST["id"];
		$subdivision = $_POST["subdivision"];
		$login = $_POST["login"];
		$password = $_POST["password"];
		$email = $_POST["email"];
		$phone = $_POST["phone"];
		$messeger = $_POST["messeger"];
		$fio = $_POST["fio"];
		$date_access = $_POST["date_access"];
		$date_denied = $_POST["date_denied"];
		$avatar = $_FILES["avatar"]["name"];
		$block = $_POST["block"];


    $query_count = "SELECT id FROM users WHERE login = '$login'";
    $result_count = mysqli_query($link, $query_count);
    if(mysqli_num_rows($result_count) > 0)
      $errors .= "Такой логин уже существует<br>";

    if($login == "") $errors .= "Не введен логин<br>";
    if($email == "") $errors .= "Не введен E-mail<br>";
    if($phone == "") $errors .= "Не введен телефон<br>";
    if($messeger == "") $errors .= "Не введен мессенджер<br>";
    if($fio == "") $errors .= "Не введено ФИО<br>";
    if($date_access == "") $errors .= "Не введена дата начала доступа<br>";
    if($date_denied == "") $date_denied = "NULL";
		if($password != ""){
			$password = sha1("werwer".sha1("fhFGHfdg46_ry".$password."dadgfh676YTRf_yu")."qweqwdsfdg");
		}
      else
      $errors .= "Не введён пароль<br>";
		$upload_dir = "../images/avatars/";
		$avatar_name = "";
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
	for($i = 0; $i < 10; $i++)
	{
		$index = rand(0, count($arr) - 1);
		$avatar_name .= $arr[$index];
}
		$avatar_name .= $_FILES["avatar"]["name"];
		$uploadfile = $upload_dir . $avatar_name;
    if($errors == ""){
		if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile))
			$errors .= "Ошибка при загрузке аватара";

		$query = "INSERT INTO users(id_clients, id_subdivision, login, password, email, phone, messeger, fio, date_access, date_denied, avatar, block) VALUES($id, $subdivision, '$login', '$password', '$email', '$phone', '$messeger', '$fio', '$date_access', '$date_denied', '$avatar_name', $block)";
		$result = mysqli_query($link, $query);
		if($result)
			$success = "Изменение прошло успешно";
		else
			$errors = $query."<br>".mysqli_error($link);
    }
  }
?>

<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Новый пользователь</title>
    <? include 'include/head.php'; ?>
  </head>
  <body>
    <? include 'include/menu.php'; ?>
    <div class="contact_form">
        <ul>
            <form action="" method="POST" enctype="multipart/form-data">
            <li>
                 <h2>Новый пользователь</h2>
                 <span class="required_notification">* отмечены обязательные поля</span>
            </li>
            <li>
                <label>Подразделение:</label>
                <select name="subdivision">
                	<?
                		$query = "SELECT * FROM subdivision WHERE id_clients = $id";
                    echo $query;
                		$result = mysqli_query($link, $query);
                		while ($row_sub = mysqli_fetch_assoc($result)) {
    									  echo '
    											<option value="'.$row_sub["id"].'">'.$row_sub["name"].'</option>
    										';
                		}

                	?>
                </select>
            </li>
            <li>
                <label>Логин:</label>
                <input type="text" placeholder="Логин" name="login" required value=<? echo '"'.$login.'"';?>/>
            </li>
            <li>
                <label>Пароль:</label>
                <input type="password" placeholder="Пароль" name="password"/>
            </li>
            <li>
                <label>E-mail:</label>
                <input type="email" placeholder="E-mail" name="email" value=<? echo '"'.$email.'"';?>/>
            </li>
            <li>
                <label>Телефон:</label>
                <input type="text"  placeholder="Телефон" name="phone" required value=<? echo '"'.$phone.'"';?>/>
            </li>
            <li>
                <label>Мессенджер:</label>
                <input type="text" placeholder="Мессенджер" name="messeger" value=<? echo '"'.$messeger.'"';?>/>
            </li>
            <li>
                <label>ФИО:</label>
                <input type="text"  placeholder="ФИО" name="fio" value=<? echo '"'.$fio.'"';?>/>
            </li>
            <li>
                <label>Дата доступа с:</label>
                <input type="date"  name="date_access" value=<? echo '"'.$date_access.'"';?>/>
            </li>
            <li>
                <label>Дата доступа по:</label>
                <input type="date" name="date_denied" value=<? echo '"'.$date_denied.'"';?>/>
            </li>
            <li>
                <label>Аватар:</label>
                <input type="file" accept="image/*" name="avatar" value=<? echo '"'.$avatar.'"';?>/>
    						<img class="img_avatar" src="<? echo $avatar; ?>"/>
            </li>
    				<li>
                <label>Блокировка:</label>
                <select name="block">
    							<option selected value="0">Нет</option>
    							<option value="1">Да</option>
    						</select>

            </li>
            <li>
            	<span class="errors_add_employee"><?  echo $errors; ?></span>
            	<span class="success_add_employee"><?  echo $success; ?></span>
            </li>
            <li>
                <input type="hidden" name="id" value="<?  echo $id; ?>">
            	<input type="submit" name="sub" value="Отправить" class="btn_submit">
            </li>
            </form>
        </ul>

    </div>
  </body>
</html>
