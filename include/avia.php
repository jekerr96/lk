<?
	session_start();
	$id = $_SESSION["id"];
?>
<div class="block_servicesReplace">

<li>
	<h2>Авиабилет</h2>
    <img src="../images/delete.png" class="del_services" id_del="Replace"/>
</li>
<li>
            <input type="hidden" id="typeReplace" value="1"/>
</li>
<li>
    <label>Вид операции:</label>
    <select id="type_operationReplace">
	<option value='1'>Бронирование</option>
	<option value='2'>Покупка</option>
    </select>
</li>
<li>
    <label>Класс бронирования:</label>
    <select id="booking_classReplace">
	<option value='1'>Бизнес-класс</option>
	<option value='2'>Эконом-класс</option>
    </select>
</li>
<li>
            <label>Пункт отправления:</label>
            <input type="text" id="point_departureReplace" placeholder="Пункт отправления"/>
        </li>
<li>
            <label>Дата отправления:</label>
            <input type="date" id="date_departureReplace" placeholder="Дата отправления"/>
        </li>
<li>
            <label>Пункт назначения:</label>
            <input type="text" id="destinationReplace" placeholder="Пункт назначения"/>
        </li>
        <li>
            <label>Комменатрий:</label>
            <input type="text" id="comentReplace" placeholder="Комментарий"/>
        </li>
<li>
            <label>Срок бронирования:</label>
            <input type="date" id="term_bookingReplace" placeholder="Срок бронирования"/>
        </li>
				<li>
					<label for="">Сотрудники</label>
					<div class="block_select_employee">
						<?
						include 'db_connect.php';
							$query = "SELECT id, surname, name, patronymic, series_number FROM employees WHERE id_users = $id ORDER BY surname, name, patronymic";
							$result = mysqli_query($link, $query);
							while($row = mysqli_fetch_assoc($result)){
								echo '
								<label class="label_employee" style="float: none; width: auto;" for="emplCheckbox'.$row["id"].'">'.$row["surname"]." ".$row["name"]." ".$row["patronymic"]." ".$row["series_number"].'</label>
								<input id="emplCheckbox'.$row["id"].'" type="checkbox" class="list_employeeReplace" name="list_employeeReplace[]" value="'.$row["id"].'"/>
								';
							}
						?>
					</div>
				</li>
<!--<li>
	<label>Сотрудники:</label>
	<select id="list_employeeReplace" multiple="multiple" size="1" style="height: 100px">
		<?
		include 'db_connect.php';
			$query = "SELECT id, surname, name, patronymic, series_number FROM employees WHERE id_users = $id";
			$result = mysqli_query($link, $query);
			while($row = mysqli_fetch_assoc($result)){
				echo '
				<option value="'.$row["id"].'">'.$row["surname"]." ".$row["name"]." ".$row["patronymic"]." ".$row["series_number"].'</option>
				';
			}
		?>
	</select>
	<span class="form_hint">Зажмите Ctrl для выбора нескольких</span>
</li>!-->
<li>
            <label>Специальный багаж:</label>
            <input type="text" id="special_luggageReplace" placeholder="специальный багаж"/>
        </li>
</div>
