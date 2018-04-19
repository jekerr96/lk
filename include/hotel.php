<?
	session_start();
	$id = $_SESSION["id"];
?>
<div class="block_servicesReplace">
<li>
	<h2>Гостинница</h2>
    <img src="../images/delete.png" class="del_services" id_del="Replace"/>
</li>
<li>
            <input type="hidden" id="typeReplace" value="4"/>
</li>
<li>
            <label>Город:</label>
            <input type="text" id="cityReplace" placeholder="Город"/>
</li>
<li>
            <label>Район:</label>
            <input type="text" id="district_residenceReplace" placeholder="Район"/>
</li>
<li>
            <label>Дата с:</label>
            <input type="date" id="date_sReplace" />
        </li>
        <li>
            <label>Дата по:</label>
            <input type="date" id="date_poReplace"/>
        </li>
         <li>
    <label>Категория размещения:</label>
    <select id="accommodation_categoryReplace">
    <option value='1'>Стандарт</option>
    <option value='2'>Люкс</option>
    </select>
</li>
        <li>
    <label>Вариант питания:</label>
    <select id="food_optionReplace">
    <option value='1'>Без питания</option>
    <option value='2'>Завтрак</option>
    <option value='3'>Полупансион</option>
    <option value='4'>Полный пансион</option>
    </select>
</li>
<li>
     <li>
            <label>Срок бронирования:</label>
            <input type="date" id="term_bookingReplace"/>
        </li>
</li>
<li>
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
</li>
</div>
