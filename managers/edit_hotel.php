<?
session_start();
if(!isset($_SESSION["id"]) || $_SESSION["type"] == "client" || $_SESSION["type"] == "buhgalter"){
die("У вас нет прав доступа");
}
 include 'include/db_connect.php';
 $id = $_GET["id"];

 $query = "SELECT id_manager FROM trips INNER JOIN services ON trips.id = services.id_trips WHERE services.id = $id";
 $result = mysqli_query($link, $query);
 $row = mysqli_fetch_assoc($result);
 $myid = $_SESSION["id"];
 if($row["id_manager"] != $myid)
   $block = true;

 if(!isset($_POST["sub"]) && !$block){
   $query = "SELECT * FROM services WHERE id = $id";
   $result = mysqli_query($link, $query);
   $row = mysqli_fetch_assoc($result);
   $city = $row["city"];
   $district_residence = $row["district_residence"];
   $date_s = $row["date_s"];
   $date_po = $row["date_po"];
   $accommodation_category = $row["accommodation_category"];
   $food_option = $row["food_option"];
   $term_booking = $row["term_booking"];
   $list_employee = $row["id_employee"];
 }



if(isset($_POST["sub"])){
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

  $query = "UPDATE services SET city = '$city', district_residence = '$district_residence', date_s = '$date_s',
  date_po = '$date_po', accommodation_category = $accommodation_category, food_option = $food_option, term_booking = '$term_booking',
  id_employee = '$list_employee' WHERE id = $id";
  $result = mysqli_query($link, $query);
  if($result){
    $success = "Изменение прошло успешно";
  }
  else{
    $errors = "Произошла ошибка<br>".mysqli_error($link);
  }
}
?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Гостиница</title>
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
          <form action="" method="post" multiple>

            <li>
                 <h2>Изменение гостиницы</h2>
                 <span class="required_notification">* отмечены обязательные поля</span>
            </li>
            <li>
                        <label>Город:</label>
                        <input type="text" name="city" placeholder="Город" value="<? echo $city; ?>"/>
            </li>
            <li>
                        <label>Район:</label>
                        <input type="text" name="district_residence" placeholder="Район" value="<? echo $district_residence; ?>"/>
            </li>
            <li>
                        <label>Дата с:</label>
                        <input type="date" name="date_s"  value="<? echo $date_s; ?>"/>
                    </li>
                    <li>
                        <label>Дата по:</label>
                        <input type="date" name="date_po" value="<? echo $date_po; ?>"/>
                    </li>
                     <li>
                <label>Категория размещения:</label>
                <select name="accommodation_category">
                <option <? if($accommodation_category == 1) echo "selected";  ?> value='1'>Стандарт</option>
                <option <? if($accommodation_category == 2) echo "selected";  ?> value='2'>Люкс</option>
                </select>
            </li>
                    <li>
                <label>Вариант питания:</label>
                <select name="food_option">
                <option <? if($food_option == 1) echo "selected";  ?> value='1'>Без питания</option>
                <option <? if($food_option == 2) echo "selected";  ?> value='2'>Завтрак</option>
                <option <? if($food_option == 3) echo "selected";  ?> value='3'>Полупансион</option>
                <option <? if($food_option == 4) echo "selected";  ?> value='4'>Полный пансион</option>
                </select>
            </li>
            <li>
                 <li>
                        <label>Срок бронирования:</label>
                        <input type="date" name="term_booking" value="<? echo $term_booking; ?>"/>
                    </li>
            </li>
            <li>
            	<label>Сотрудники:</label>
            	<select name="list_employee[]" multiple="multiple" style="height: 100px">
            		<?
                $query = "SELECT trips.id_users as id FROM services INNER JOIN trips ON services.id_trips = trips.id WHERE services.id = $id";
                $result = mysqli_query($link, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                  $ide = $row["id"];
            			$queryE = "SELECT id, surname, name, patronymic, series_number FROM employees WHERE id_users = $ide";
                  $resultE = mysqli_query($link, $queryE);
            			while($rowE = mysqli_fetch_assoc($resultE)){

                    $masEmployee = split(",", $list_employee);
                    $selected = "";
                    for($i = 0; $i < count($masEmployee); $i++)
                      if($rowE["id"] == $masEmployee[$i]){
                        $selected = "selected";
                        break;
                      }
            				echo '
            				<option '.$selected.' value="'.$rowE["id"].'">'.$rowE["surname"]." ".$rowE["name"]." ".$rowE["patronymic"]." ".$rowE["series_number"].'</option>
            				';
            			}
                }
            		?>
            	</select>
            	<span class="form_hint">Зажмите Ctrl для выбора нескольких</span>
            </li>
            <li>
                        <label>Специальный багаж:</label>
                        <input type="text" name="special_luggage" placeholder="специальный багаж" value="<? echo $special_luggage ?>"/>
                    </li>
                    <li>
                    	<span class="errors_add_employee"><?  echo $errors; ?></span>
                    	<span class="success_add_employee"><?  echo $success; ?></span>
                    </li>
                    <li>
                      <input type="submit" name="sub" value="Изменить" class="btn_submit">
                    </li>

                  </form>
        </ul>

    </div>
  </body>
</html>
