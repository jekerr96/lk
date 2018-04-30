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
	<link rel="stylesheet" type="text/css" href="style.css?13">
	<script type="text/javascript" src="js/jquery-3.3.1.min.js?1"></script>
	<script type="text/javascript" src="js/script.js?3"></script>
</head>
<body>
		<div class="header">
		<nav class="nav">
	<ul>
	    <li class="index"><a href="/">Главная</a></li>
	    <li class="employees"><a href="/employees">Сотрудники</a></li>
	    <li class="subdivision"><a href="/subdivision">Подразделения</a></li>
	    <li class="trips"><a href="/trips">Деловые поездки</a></li>
	    <li class="contacts"><a href="/contacts">Контакты</a></li>
	    <li class="exit"><a attr="exit" href="/exit.php">Выход</a></li>
	</ul>
</nav>
</div>

<div class="content">

</div>

</body>
</html>
