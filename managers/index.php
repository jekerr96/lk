<?
	session_start();
	if(!isset($_SESSION["id"]) || $_SESSION["type"] == "client")
	{
		header("Location: /managers/auth.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Личный кабинет</title>
	<script>var page = "index";</script>
	<?
		include 'include/head.php';
	?>
</head>
<body>
		<?
			include "include/menu.php";
		?>

<div class="content">

</div>

</body>
</html>
