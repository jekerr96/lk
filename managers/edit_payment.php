<? session_start();
if(!isset($_SESSION["id"]) || $_SESSION["type"] == "client" || $_SESSION["type"] != "buhgalter"){
die("У вас нет прав доступа");
}
$id = $_GET["id"];
include 'include/db_connect.php';

$query = "SELECT summ_oplati, summ_k_oplate, id_status FROM trips WHERE id = $id";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($result);

if(isset($_POST["sub"])){
  $payment = $_POST["payment"];
  if($row["summ_k_oplate"] <= $payment && $row["id_status"] == 4)
    $status = 5;
  else $status = $row["status"];

  $query = "UPDATE trips SET summ_oplati = $payment, id_status = $status WHERE id = $id";
  $result = mysqli_query($link, $query);
  if($result)
    $header = true;
    else mysqli_error($link);



  if($header) header("Location: edit_payment.php?id=".$id);
}
?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Оплата</title>
		<script>var page = "trip";</script>
		<? include 'include/head.php'; ?>
	</head>
	<body>
		<? include 'include/menu.php'; ?>
    <div class="contact_form" style="min-height: 0;">
      <ul>

        <form class="" action="" method="post">
          <li>
          	<h2>Оплата</h2>
            <span class="required_notification">* отмечены обязательные поля</span>
          </li>
          <li>
            <label for="">Оплачено:</label>
            <input type="number" step="0.01" name="payment" value="" placeholder="Сумма">
          </li>
                <li>
                  <span class="errors_add_employee"><? echo $errors; ?></span>
                  <span class="success_add_employee"><? echo $success ?></span>
                </li>
                <li>
                  <input type="submit" name="sub" value="Сохранить" class="btn_submit">
                </li>
      </ul>

    </div>
		<div id="block_show_trip">
		<?
			$id = $_GET["id"];
			$list_employee = "";


			$query = "SELECT trips.id as id, description, status.name as status, summ_k_oplate, summ_oplati, term, address, id_manager, managers.fio as manager FROM trips INNER JOIN status ON trips.id_status = status.id INNER JOIN managers ON managers.id = trips.id_manager WHERE trips.id = $id ORDER BY trips.id DESC";
			$result = mysqli_query($link, $query);
			if(mysqli_num_rows($result) != 0){
				?>

			<table class="table_employees table_trips">
			<th>Описание</th>
			<th>Статус</th>
			<th>Состояние оплаты</th>
			<th>Сумма к оплате</th>
			<th>Сумма оплаты</th>
			<th>Срок оплаты</th>
			<th>Адрес доставки документов</th>
			<th>Менеджер</th>
			<th>Действия</th>
			<?
			while($row = mysqli_fetch_assoc($result)){
				$sost = "";
				$class = "";
				$k_oplate = $row["summ_k_oplate"];
				$oplata = $row["summ_oplati"];
				$term = $row["term"];
				if($term == '0000-00-00')
					$term = "-";
				if($k_oplate > $oplata && $k_oplate != 0){
					$sost = "Не оплачено";
					$class = "unpaid";
				}
				if($k_oplate <= $oplata && $k_oplate != 0){
					$sost = "Оплачено";
					$class = "paid";
				}
				if($k_oplate == 0){
					$sost = "Не оплачено";
					$class = "unpaid";
					$k_oplate = "-";
				}
				if($oplata == 0){
					$oplata = "-";
				}
				echo '
				<tr class="show_trip_line">
				<td>'.$row["description"].'</td>
				<td>'.$row["status"].'</td>
				<td class="'.$class.'">'.$sost.'</td>
				<td>'.$k_oplate.'</td>
				<td>'.$oplata.'</td>
				<td>'.$term.'</td>
				<td>'.$row["address"].'</td>
				<td class="manager_trip">'.$row["manager"].'</td>
				<td>
				<img idt="'.$row["id"].'" class="take_img" src="images/plus.png" alt="Взять себе" title="Взять себе"/>
				<a href="edit_trips.php?id='.$row["id"].'"><image class="edit_image" src="images/pencil.png"/></a>
						<image class="delete_image del_trips" idd="'.$row["id"].'" src="images/delete.png"/>
				</tr>
				';
			}
			}
		?>

		</table>
		<br>
		</div>
		<div id="show_trip_servies">
			<?
			$query = "SELECT * FROM services WHERE id_trips = $id";
			$result = mysqli_query($link, $query);
			if(mysqli_num_rows($result) != 0){
				while($row = mysqli_fetch_assoc($result)){
					echo "<div id=".$row['id'].">";
					$type = "";
					switch($row["type"]){
					case 1:
						$type = "Авиабилет";
						break;
					case 2:
						$type = "Железнодорожный билет";
						break;
					case 3:
						$type = "Автобилет";
						break;
					case 4:
						$type = "Гостиница";
						break;
				}
				echo "<h2 class='head_type_service'>$type</h2>";
				if($row["type"] == 1){
				?>

			<table class="table_employees table_trip_avia">
			<th>Вид операции</th>
			<th>Класс бронирования</th>
			<th>Пункт отправления</th>
			<th>Дата отправления</th>
			<th>Пункт назначения</th>
			<th>Комментарий</th>
			<th>Срок бронирования</th>
			<th>Действия</th>
			<?


				$type_operation = "";
				$booking_class = "";
				$list_employee = preg_split("/,/", $row['id_employee']);


				switch($row["type_operation"]){
					case 1:
						$type_operation = "Бронирование";
						break;
					case 2:
						$type_operation = "Покупка";
						break;
				}
				switch($row["booking_class"]){
					case 1:
						$booking_class = "Бизнес-класс";
						break;
					case 2:
						$booking_class = "Эконом-класс";
						break;
				}

				echo '
				<tr>
				<td>'.$type_operation.'</td>
				<td>'.$booking_class.'</td>
				<td>'.$row["point_departure"].'</td>
				<td>'.$row["date_departure"].'</td>
				<td>'.$row["destination"].'</td>
				<td>'.$row["coment"].'</td>
				<td>'.$row["term_booking"].'</td>
				<td><a href="edit_avia.php?id='.$row["id"].'"><image class="edit_image" src="images/pencil.png"/></a>
						<image class="delete_image del_avia" idd="'.$row["id"].'" src="images/delete.png"/>
				</tr>
				';
				echo '</table>';
			}
			////////////////////////////////////////////////////
			if($row["type"] == 2){
				?>

			<table class="table_employees table_trip_jd">
			<th>Вид операции</th>
			<th>Тип размещения</th>
			<th>Пункт отправления</th>
			<th>Дата отправления</th>
			<th>Пункт назначения</th>
			<th>Комментарий</th>
			<th>Действия</th>
			<?


				$type_operation = "";
				$type_allocation = "";
				$list_employee = preg_split("/,/", $row['id_employee']);


				switch($row["type_operation"]){
					case 1:
						$type_operation = "Бронирование";
						break;
					case 2:
						$type_operation = "Покупка";
						break;
				}
				switch($row["type_allocation"]){
					case 1:
						$type_allocation = "Плацкарт";
						break;
					case 2:
						$type_allocation = "Купе";
						break;
					case 3:
						$type_allocation = "Спальный вагон";
						break;
					case 4:
						$type_allocation = "Люкс";
						break;
				}

				echo '
				<tr>
				<td>'.$type_operation.'</td>
				<td>'.$type_allocation.'</td>
				<td>'.$row["point_departure"].'</td>
				<td>'.$row["date_departure"].'</td>
				<td>'.$row["destination"].'</td>
				<td>'.$row["coment"].'</td>
				<td><a href="edit_jd.php?id='.$row["id"].'"><image class="edit_image" src="images/pencil.png"/></a>
						<image class="delete_image del_jd" idd="'.$row["id"].'" src="images/delete.png"/>
				</tr>
				</tr>
				';
				echo '</table>';
			}
			///////////////////////////////////////////////////
			if($row["type"] == 3){
				?>

			<table class="table_employees table_trip_avto">
			<th>Вид операции</th>
			<th>Пункт отправления</th>
			<th>Дата отправления</th>
			<th>Пункт назначения</th>
			<th>Комментарий</th>
			<th>Действия</th>
			<?


				$type_operation = "";
				$type_allocation = "";
				$list_employee = preg_split("/,/", $row['id_employee']);


				switch($row["type_operation"]){
					case 1:
						$type_operation = "Бронирование";
						break;
					case 2:
						$type_operation = "Покупка";
						break;
				}

				echo '
				<tr>
				<td>'.$type_operation.'</td>
				<td>'.$row["point_departure"].'</td>
				<td>'.$row["date_departure"].'</td>
				<td>'.$row["destination"].'</td>
				<td>'.$row["coment"].'</td>
				<td><a href="edit_avto.php?id='.$row["id"].'"><image class="edit_image" src="images/pencil.png"/></a>
						<image class="delete_image del_avto" idd="'.$row["id"].'" src="images/delete.png"/>
				</tr>
				</tr>
				';
				echo '</table>';
			}
			///////////////////////////////////////////////////

			if($row["type"] == 4){
				?>

			<table class="table_employees table_trip_jd">
			<th>Город</th>
			<th>Район</th>
			<th>Дата с</th>
			<th>Дата по</th>
			<th>Категория размещения</th>
			<th>Вариант питания</th>
			<th>Срок бронирования</th>
			<th>Действия</th>
			<?


				$accommodation_category = "";
				$food_option = "";
				$list_employee = preg_split("/,/", $row['id_employee']);

				switch($row["accommodation_category"]){
					case 1:
						$accommodation_category = "Стандарт";
						break;
					case 2:
						$accommodation_category = "Люкс";
						break;
				}

				switch($row["food_option"]){
					case 1:
						$food_option = "Без питания";
						break;
					case 2:
						$food_option = "Завтрак";
						break;
					case 3:
						$food_option = "Полупансион";
						break;
					case 4:
						$food_option = "Полный пансион";
						break;
				}

				echo '
				<tr>
				<td>'.$row["city"].'</td>
				<td>'.$row["district_residence"].'</td>
				<td>'.$row["date_s"].'</td>
				<td>'.$row["date_po"].'</td>
				<td>'.$accommodation_category.'</td>
				<td>'.$food_option.'</td>
				<td>'.$row["term_booking"].'</td>
				<td><a href="edit_hotel.php?id='.$row["id"].'"><image class="edit_image" src="images/pencil.png"/></a>
						<image class="delete_image del_hotel" idd="'.$row["id"].'" src="images/delete.png"/>
				</tr>
				</tr>
				';
				echo '</table>';
			}
			//////////////////////////////////////////////////
				$select = "WHERE ";
				for($i = 0; $i < count($list_employee); $i++){
					$select .= "id = ".$list_employee[$i]." OR ";
				}
				if($select == "WHERE ")
					$select = "";
				else $select = substr($select, 0, -3);

				$query_employee = "SELECT surname, name, patronymic, zagran_surname, zagran_name, zagran_patronymic, series_number, zagran_term FROM employees $select";
				?>
				<br>
				<table class="table_employees table_trip_avia">
				<th>ФИО</th>
				<th>Загран ФИО</th>
				<th>Паспорт</th>
				<th>Срок действия загран паспорта</th>
				<?
				$result_employee = mysqli_query($link, $query_employee);
				while($row_employee = mysqli_fetch_assoc($result_employee)){
					echo '
					<tr>
					<tr idd="'.$row_employee["id"].'">
					<td>'.$row_employee["surname"].' '.$row_employee["name"].' '.$row_employee["patronymic"].'</td>
					<td>'.$row_employee["zagran_surname"].' '.$row_employee["zagran_name"].' '.$row_employee["zagran_patronymic"].'</td>
					<td>'.$row_employee["series_number"].'</td>
					<td>'.$row_employee["zagran_term"].'</td>
					</tr>
					';
				}
				echo '</table></div>';
			}



			}
		?>
		<h2 class="head_type_service">Сообщения</h2>
		<div class="block_trips_msg">
		<?
			$query = "SELECT id_author, its_manager, id_trip, msg, date_msg FROM msg_trips WHERE id_trip = $id";
			$result = mysqli_query($link, $query);
			while($row = mysqli_fetch_assoc($result)){
				$author = $row['id_author'];
				if($row["its_manager"] == 0){
					$query_fio = "SELECT fio FROM users WHERE id = $author";
				}
				else{
					$query_fio = "SELECT fio FROM managers WHERE id = $author";
				}
				$result_fio = mysqli_query($link, $query_fio);
				$row_fio = mysqli_fetch_assoc($result_fio);
				$date = date_create($row["date_msg"]);
				echo '
				<br>
				<div class="block_msg">
					<span class="author">'.$row_fio["fio"].'</span>
					<span class="date_msg">'.date_format($date, "d.m.y G:i:s").'</span>
					<span class="msg">'.$row["msg"].'</span>
				</div>
				';

			}
		?>
		</div>
		</div>

		</div>
	</body>
</html>
