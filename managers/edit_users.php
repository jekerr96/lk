<?
	include 'include/db_connect.php';
	$id = (int)$_GET["id"];

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

		if($date_denied == "") $date_denied = "null";

		if($password != ""){
			$password = "password = '".sha1("werwer".sha1("fhFGHfdg46_ry".$password."dadgfh676YTRf_yu")."qweqwdsfdg")."',";
		}
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
		if(file_exists($_FILES['avatar']['tmp_name']) || is_uploaded_file($_FILES['avatar']['tmp_name'])){
		if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile))
			$errors .= "Ошибка при загрузке аватара<br>";
		}
		else{
			$avatar_name = "no_avatar.png";
		}
		$query = "UPDATE users SET id_subdivision = $subdivision, login = '$login', $password email = '$email', phone = '$phone', messeger = '$messeger',
		fio = '$fio', date_access = '$date_access', date_denied = ".($date_denied == null ? NULL : $date_denied).", avatar = '$avatar_name', block = $block WHERE id = $id";
		$result = mysqli_query($link, $query);
		if($result)
			$success = "Изменение прошло успешно";
		else
			$errors = $query."<br>".mysqli_error($link);
	}
	$query = "SELECT * FROM users WHERE id = $id";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_assoc($result);

	$client = $row["id_clients"];
	$subdivision = $row["id_subdivision"];
	$login = $row["login"];
	$email = $row["email"];
	$phone = $row["phone"];
	$messeger = $row["messeger"];
	$fio = $row["fio"];
	$date_access = $row["date_access"];
	$date_denied = $row["date_denied"];
	$avatar = $row["avatar"];
	$block = $row["block"];
	?>

<!DOCTYPE html>
<html>
<head>
	<title>Пользователи клиента</title>
	<script>var page = "client";</script>
	<? include 'include/head.php'; ?>
</head>
<body>
<? include 'include/menu.php';  ?>
<div class="contact_form">
    <ul>
        <form action="" method="POST" enctype="multipart/form-data">
        <li>
             <h2>Изменение пользователя</h2>
             <span class="required_notification">* отмечены обязательные поля</span>
        </li>
        <li>
            <label>Подразделение:</label>
            <select name="subdivision">
            	<?
            		$query = "SELECT * FROM subdivision WHERE id_clients = $client";
            		$result = mysqli_query($link, $query);
            		while ($row_sub = mysqli_fetch_assoc($result)) {
            			 $selected = "";
									 if($row_sub["id"] == $subdivision)
									 		$selected = "selected";
									  echo '
											<option value="'.$row_sub["id"].'" '.$selected.'>'.$row_sub["name"].'</option>
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
        	<input type="submit" name="sub" value="Изменить" class="btn_submit">
        </li>
        </form>
    </ul>

</div>
</body>
</html>
