<?
session_start();
$id = $_SESSION["id"];
?>

<div class="block_trips">
	<div class="btn_add_trips btn_add">
		Добавить
	</div>
<?
	include 'db_connect.php';
	$query = "SELECT trips.id as id, description, status.name as status, summ_k_oplate, summ_oplati, term, address FROM trips INNER JOIN status ON trips.id_status = status.id WHERE id_users = $id ORDER BY trips.id DESC";
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
</div>
