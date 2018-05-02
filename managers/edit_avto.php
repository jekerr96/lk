<?
 include 'include/db_connect.php';
 $id = $_GET["id"];
 if(!isset($_POST["sub"])){
   $query = "SELECT * FROM services WHERE id = $id";
   $result = mysqli_query($link, $query);
   $row = mysqli_fetch_assoc($result);
   $type_operation = $row["type_operation"];
   $point_departure = $row["point_departure"];
   $date_departure = $row["date_departure"];
   $destination = $row["destination"];
   $coment = $row["coment"];
   $list_employee = $row["id_employee"];
 }



if(isset($_POST["sub"])){
  $type_operation = $_POST["type_operation"];
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

  $query = "UPDATE services SET type_operation = $type_operation, point_departure = '$point_departure',
  date_departure = '$date_departure', destination = '$destination', coment = '$coment', id_employee = '$list_employee' WHERE id = $id";
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
    <title>Авиабилет</title>
    <script>var page = "trip";</script>
    <? include 'include/head.php'; ?>
  </head>
  <body>
    <? include 'include/menu.php'; ?>
    <div class="contact_form">
        <ul>
          <form action="" method="post" multiple>

            <li>
                 <h2>Изменение автобилета</h2>
                 <span class="required_notification">* отмечены обязательные поля</span>
            </li>
            <li>
                <label>Вид операции:</label>
                <select name="type_operation">
            	<option <? if($type_operation == 1) echo "selected"; ?> value='1'>Бронирование</option>
            	<option <? if($type_operation == 2) echo "selected"; ?> value='2'>Покупка</option>
                </select>
            </li>
            <li>
                        <label>Пункт отправления:</label>
                        <input type="text" name="point_departure" placeholder="Пункт отправления" value="<? echo $point_departure; ?>"/>
                    </li>
            <li>
                        <label>Дата отправления:</label>
                        <input type="date" name="date_departure" placeholder="Дата отправления" value="<? echo $date_departure; ?>"/>
                    </li>
            <li>
                        <label>Пункт назначения:</label>
                        <input type="text" name="destination" placeholder="Пункт назначения" value="<? echo $destination; ?>"/>
                    </li>
                    <li>
                        <label>Комменатрий:</label>
                        <input type="text" name="coment" placeholder="Комментарий" value="<? echo $coment; ?>"/>
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
