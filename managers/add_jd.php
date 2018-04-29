<?
  session_start();
  include 'include/db_connect.php';
  $id = $_GET["id"];

  if(isset($_POST["sub"])){
		$type_operation = $_POST["type_operation"];
		$type_allocation = $_POST["type_allocation"];
		$point_departure = $_POST["point_departure"];
		$date_departure = $_POST["date_departure"];
		$destination = $_POST["destination"];
		$coment = $_POST["coment"];
		$mas_list_employee = $_POST["list_employee"];

    $list_employee = "";
   foreach ($mas_list_employee as $employee) {
     $list_employee .= $employee.",";
   }
   $list_employee = substr($list_employee, 0, -1);

   $errors = "";
   $success = "";
   $query = "INSERT INTO services (type, id_trips, type_operation, type_allocation, point_departure, date_departure, destination, coment, id_employee) VALUE (2, $id, $type_operation, $type_allocation, '$point_departure', '$date_departure', '$destination', '$coment', '$list_employee')";
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
    <title>Железнодорожный билет</title>
    <? include 'include/head.php'; ?>
  </head>
  <body>
    <? include 'include/menu.php'; ?>
    <div class="contact_form">
        <ul>

    <li>
    	<h2>Железнодорожный билет</h2>
    </li>
    <form class="" action="" method="post">
      <li style="border-bottom: none;">
          <label>Вид операции:</label>
          <select name="type_operation">
      	<option value='2'>Покупка</option>
          </select>
      </li>
      <li>
          <label>Тип размещения:</label>
          <select name="type_allocation">
      	<option value='1'>Плацкарт</option>
      	<option value='2'>Купе</option>
      	<option value='3'>Спальный вагон</option>
      	<option value='4'>Люкс</option>
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
