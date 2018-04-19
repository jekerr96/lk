<? session_start(); ?>
<div id="block_show_trip">
<?
	$id = $_SESSION["id"];
	$ids = $_POST["ids"];
	$list_employee = "";

	include 'db_connect.php';
	$query = "SELECT trips.id as id, description, status.name as status, summ_k_oplate, summ_oplati, term, address FROM trips INNER JOIN status ON trips.id_status = status.id WHERE id_users = $id AND trips.id = $ids ORDER BY trips.id DESC";
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
		<tr class="table_trips_line" ids="'.$row["id"].'">
		<td>'.$row["description"].'</td>
		<td>'.$row["status"].'</td>
		<td class="'.$class.'">'.$sost.'</td>
		<td>'.$k_oplate.'</td>
		<td>'.$oplata.'</td>
		<td>'.$term.'</td>
		<td>'.$row["address"].'</td>
		</tr>
		';
	}
	}
?>

</table>

<div id="show_trip_servies">
	<?
	$query = "SELECT * FROM services WHERE id_trips = $ids";
	$result = mysqli_query($link, $query);
	if(mysqli_num_rows($result) != 0){
		while($row = mysqli_fetch_assoc($result)){
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
				$type = "Гостинница";
				break;
		}
		echo "<h2>$type</h2>";
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
		echo '</table>';
	}
	
	
	
	}
?>
</div>

</div>