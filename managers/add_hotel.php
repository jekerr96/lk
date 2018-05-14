<?
  session_start();
  include 'include/db_connect.php';
  $id = $_GET["id"];

  $query = "SELECT id_manager FROM trips WHERE id = $id";
  $result = mysqli_query($link, $query);
  $row = mysqli_fetch_assoc($result);
  $myid = $_SESSION["id"];

  if($row["id_manager"] != $myid)
    $block = true;

  if(isset($_POST["sub"]) && !$block){
    $city = $_POST["city"];
		$district_residence = $_POST["district_residence"];
		$date_s = $_POST["date_s"];
		$date_po = $_POST["date_po"];
		$accommodation_category = $_POST["accommodation_category"];
		$food_option = $_POST["food_option"];
		$term_booking = $_POST["term_booking"];
		$mas_list_employee = $_POST["list_employee"];

    $list_employee = "";
   foreach ($mas_list_employee as $employee) {
     $list_employee .= $employee.",";
   }
   $list_employee = substr($list_employee, 0, -1);

   $errors = "";
   $success = "";
   $query = "INSERT INTO services (type, id_trips, city, district_residence, date_s, date_po, accommodation_category, food_option, term_booking, id_employee) VALUES (4, $id, '$city', '$district_residence', '$date_s', '$date_po', '$accommodation_category', $food_option, '$term_booking', '$list_employee')";
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
    <title>Гостинница</title>
    <script>var page = "trip";</script>
    <? include 'include/head.php'; ?>
  </head>
  <body>
    <? include 'include/menu.php';
    if($block)
    die("<div class='block_msg'>Этот документ принадлежит не вам, у вас нету прав на его редактирование.</div>");
    ?>
    <div class="contact_form">
        <ul>

    <li>
    	<h2>Гостинница</h2>
    </li>
    <form class="" action="" method="post">
      <li style="border-bottom: none;">
                  <label>Город:</label>
                  <input type="text" name="city" placeholder="Город"/>
      </li>
      <li>
                  <label>Район:</label>
                  <input type="text" name="district_residence" placeholder="Район"/>
      </li>
      <li>
                  <label>Дата с:</label>
                  <input type="date" name="date_s" />
              </li>
              <li>
                  <label>Дата по:</label>
                  <input type="date" name="date_po"/>
              </li>
               <li>
          <label>Категория размещения:</label>
          <select name="accommodation_category">
          <option value='1'>Стандарт</option>
          <option value='2'>Люкс</option>
          </select>
      </li>
              <li>
          <label>Вариант питания:</label>
          <select name="food_option">
          <option value='1'>Без питания</option>
          <option value='2'>Завтрак</option>
          <option value='3'>Полупансион</option>
          <option value='4'>Полный пансион</option>
          </select>
      </li>
      <li>
           <li>
                  <label>Срок бронирования:</label>
                  <input type="date" name="term_booking"/>
              </li>
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
              <?
              if(isset($_POST["sub"])){
                echo '<a class="btn_back" href="/managers/show_trip.php?id='.$id.'"><div class="btn_block_back">Назад к списку</div></a>';
              }
              ?>
            </li>
          </form>
          </ul>
    </div>
  </body>
</html>
