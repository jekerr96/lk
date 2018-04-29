<?
  session_start();
  include 'include/db_connect.php';
  $id = $_GET["id"];

  if(isset($_POST["sub"])){
    $type_operation = $_POST["type_operation"];
    $booking_class = $_POST["booking_class"];
    $point_departure = $_POST["point_departure"];
    $date_departure = $_POST["date_departure"];
    $destination = $_POST["destination"];
    $coment = $_POST["coment"];
    $term_booking = $_POST["term_booking"];
    $mas_list_employee = $_POST["list_employee"];
    $special_luggage = $_POST["special_luggage"];

    $list_employee = "";
   foreach ($mas_list_employee as $employee) {
     $list_employee .= $employee.",";
   }
   $list_employee = substr($list_employee, 0, -1);

   $errors = "";
   $success = "";
   $query = "INSERT INTO services (type, id_trips, type_operation, booking_class, point_departure, date_departure, destination, coment, term_booking, id_employee, special_luggage) VALUES (1, $id, $type_operation, $booking_class, '$point_departure', '$date_departure', '$destination', '$coment', '$term_booking', '$list_employee', '$special_luggage')";
   $result = mysqli_query($link, $query);
   if($result){
     $success = "Добавление прошло успешно";
   }
   else{
     $errors = mysqli_error($link);
   }
  }
?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Авиабилет</title>
    <? include 'include/head.php'; ?>
  </head>
  <body>
    <? include 'include/menu.php'; ?>
    <div class="contact_form">
        <ul>

    <li>
    	<h2>Авиабилет</h2>
    </li>
    <form class="" action="" method="post">
    <li style="border-bottom: none;">
        <label>Вид операции:</label>
        <select name="type_operation">
    	<option value='1'>Бронирование</option>
    	<option value='2'>Покупка</option>
        </select>
    </li>
    <li>
        <label>Класс бронирования:</label>
        <select name="booking_class">
    	<option value='1'>Бизнес-класс</option>
    	<option value='2'>Эконом-класс</option>
        </select>
    </li>
    <li>
                <label>Пункт отправления:</label>
                <input type="text" name="point_departure" placeholder="Пункт отправления"/>
            </li>
    <li>
                <label>Дата отправления:</label>
                <input type="date" name="date_departure" placeholder="Дата отправления"/>
            </li>
    <li>
                <label>Пункт назначения:</label>
                <input type="text" name="destination" placeholder="Пункт назначения"/>
            </li>
            <li>
                <label>Комменатрий:</label>
                <input type="text" name="coment" placeholder="Комментарий"/>
            </li>
    <li>
                <label>Срок бронирования:</label>
                <input type="date" name="term_booking" placeholder="Срок бронирования"/>
            </li>
    <li>
    	<label>Сотрудники:</label>
    	<select name="list_employee[]" multiple="multiple" size="1" style="height: 100px">
    		<?
    			$query = "SELECT employees.id as id, surname, name, patronymic, series_number FROM employees INNER JOIN users ON users.id = employees.id_users INNER JOIN trips ON trips.id_users = users.id WHERE trips.id = $id";
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
    <li>
                <label>Специальный багаж:</label>
                <input type="text" name="special_luggage" placeholder="специальный багаж"/>
            </li>
            <li>
              <span class="errors_add_employee"><? echo $errors; ?></span>
              <span class="success_add_employee"><? echo $success ?></span>
            </li>
            <li>
              <input type="submit" name="sub" value="Добавить" class="btn_submit">
            </li>
          </form>
          </ul>
    </div>
  </body>
</html>