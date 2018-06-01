<?
session_start();
if(!isset($_SESSION["id"]) || $_SESSION["type"] == "client" || $_SESSION["type"] == "buhgalter"){
die("У вас нет прав доступа");
}
 include 'include/db_connect.php';
 $id = $_GET["id"];
 if(!isset($_POST["sub"])){
   $query = "SELECT * FROM trips WHERE id = $id";
   $result = mysqli_query($link, $query);
   $row = mysqli_fetch_assoc($result);
   $description = $row["description"];
   $form = $row["id_form"];
   $term = $row["term"];
   $summa_oplati = $row["summ_k_oplati"];
   $address = $row["address"];
 }



if(isset($_POST["sub"])){
  $description = $_POST["description"];
  $form = $_POST["form"];
  $term = $_POST["term"];
  $summa_oplati = $_POST["summ_k_oplati"];
  $address = $_POST["address"];

  $query = "UPDATE trips SET description = '$description', id_form = $form, term = '$term', address = '$address', summ_k_oplate = $summa_oplati WHERE id = $id";
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
    <title>Деловая поездка</title>
    <script>var page = "trip";</script>
    <? include 'include/head.php'; ?>
  </head>
  <body>
    <? include 'include/menu.php'; ?>
    <div class="contact_form">
        <ul>
          <form action="" method="post" multiple>

            <li>
                 <h2>Изменение деловой поездки</h2>
                 <span class="required_notification">* отмечены обязательные поля</span>
            </li>
            <li>
                <label>Описание:</label>
                <input type="text" name="description"  placeholder="Описание" value="<? echo $description; ?>"/>
            </li>
            <li>
                <label>Форма оплаты:</label>
                <select name="form">
                    <?
                        include 'db_connect.php';
                        $query = "SELECT * FROM forms WHERE permission = 1";
                        $result = mysqli_query($link, $query);
                        while($row = mysqli_fetch_assoc($result)){
                          $selected = "";
                          if($row["id"] == $form)
                            $selected = "selected";
                            echo "<option $selected value='".$row['id']."'>".$row['name']."</option>";
                        }
                    ?>
                </select>
            </li>
            <li>
                <label>Срок оплаты:</label>
                <input type="date" name="term" placeholder="Срок оплаты" value="<? echo $term; ?>"/>
            </li>
            <li>
                <label>Сумма к оплате:</label>
                <input type="number" step="0.01" name="summ_k_oplati" placeholder="Сумма к оплате" value="<? echo $summa_oplati; ?>"/>
            </li>
            <li>
                <label>Адрес доставки документов:</label>
                <input type="text" name="address" placeholder="Адрес доставки документов" value="<? echo $address; ?>"/>
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
