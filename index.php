<?
	session_start();
	if(!isset($_SESSION["id"]) || $_SESSION["type"] == "manager")
	{
		header("Location: /auth.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Личный кабинет</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css?15">
	<script type="text/javascript" src="js/jquery-3.3.1.min.js?1"></script>
	<script type="text/javascript" src="js/script.js?7"></script>
</head>
<body>
		<div class="header">
			<nav class="clearfix">
    <ul class="clearfix">
			<li class="index"><a href="/">Главная</a></li>
			<li class="employees"><a href="/employees">Сотрудники</a></li>
			<li class="subdivision"><a href="/subdivision">Подразделения</a></li>
			<li class="trips"><a href="/trips">Деловые поездки</a></li>
			<li class="exit"><a attr="exit" href="/exit.php">Выход</a></li>
			<!--<li><div><img class="avatar" src="images/avatars/<? echo $_SESSION['avatar']; ?>"/><span class="fio"><? echo $_SESSION["fio"]; ?></span></div></li>!-->
    </ul>
    <a href="#" id="pull">Меню</a>
</nav>
</div>

<div class="content">

</div>

</body>
</html>
