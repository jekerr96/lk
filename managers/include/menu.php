<div class="header">
	<nav class="clearfix">
<ul class="clearfix">
	<li class="menu_index"><a href="/managers/">Главная</a></li>
	<?
	if($_SESSION["type"] == "buhgalter"){
		echo '<li class="menu_payment"><a href="/managers/payment.php">Оплата</a></li>';
	}
	else{
		?>
	<? if($_SESSION["type"] == "administrator")
		echo '<li class="menu_personal"><a href="/managers/personal.php">Персонал</a></li>';
	?>
	<li class="menu_clients"><a href="/managers/clients.php">Клиенты</a></li>
	<li class="menu_subdivision"><a href="/managers/subdivisions.php">Подразделения</a></li>
	<li class="menu_employees"><a href="/managers/employees.php">Сотрудники</a></li>
	<li class="menu_trips"><a href="/managers/trips.php">Деловые поездки</a></li>
	<?
}
?>
	<li class="exit"><a href="/managers/exit.php">Выход</a></li>
</ul>
<a href="#" id="pull">Меню</a>
</nav>
</div>
