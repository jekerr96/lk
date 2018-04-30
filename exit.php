<?
session_start();
					unset($_SESSION["type"]);
					unset($_SESSION["id"]);
					unset($_SESSION["id_clients"]);
					unset($_SESSION["email"]);
					unset($_SESSION["phone"]);
					unset($_SESSION["messeger"]);
					unset($_SESSION["fio"]);
					unset($_SESSION["date_access"]);
					unset($_SESSION["date_denied"]);
					unset($_SESSION["avatar"]);
					unset($_SESSION["block"]);
					setcookie("user", "", time() - 100);
					echo '<script type="text/javascript">
					window.location = "/auth.php"
					</script>';
