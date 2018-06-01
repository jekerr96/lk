<?
	session_start();
	if($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_SESSION["id"] || $_SESSION["type"] != "client")){
	die("У вас нет прав доступа");
}
	$id = $_SESSION["id"];
?>
<div class="block_servicesReplace">
<li>
	<h2>Автобилет</h2>
	<img src="../images/delete.png" class="del_services" id_del="Replace"/>
</li>
<li>
            <input type="hidden" id="typeReplace" value="3"/>
</li>
<li>
    <label>Вид операции:</label>
    <select id="type_operationReplace">
	<option value='1'>Бронирование</option>
	<option value='2'>Покупка</option>
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

								<br>
								';
							}
						?>
					</div>
				</li>
</div>
