<?
  session_start();
  include 'include/db_connect.php';
?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Оплата</title>
    <script>var page = "payment";</script>
    <? include 'include/head.php'; ?>
  </head>
  <body>
    <?
    include 'include/menu.php';
    ?>
    <div class="content">
      <div class="payment">
    <table class="table_employees table_buhgalter_trips">
    <th>Описание</th>
    <th>Статус</th>
    <th>Состояние оплаты</th>
    <th>Сумма к оплате</th>
    <th>Сумма оплаты</th>
    <th>Срок оплаты</th>
    <th>Адрес доставки документов</th>
    <th>Менеджер</th>
    <?
    $query = "SELECT trips.id as id, description, status.name as status, summ_k_oplate, summ_oplati, term, address, id_manager, managers.fio as manager FROM trips INNER JOIN status ON trips.id_status = status.id INNER JOIN managers ON managers.id = trips.id_manager ORDER BY trips.date_add DESC";
    $result = mysqli_query($link, $query);
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
      <tr class="show_trip_line buhgalter_trip" ids="'.$row["id"].'">
      <td>'.$row["description"].'</td>
      <td>'.$row["status"].'</td>
      <td class="'.$class.'">'.$sost.'</td>
      <td>'.$k_oplate.'</td>
      <td>'.$oplata.'</td>
      <td>'.$term.'</td>
      <td>'.$row["address"].'</td>
      <td class="manager_trip">'.$row["manager"].'</td>
      </tr>
      ';
    }

  ?>

  </table>
</div>
</div>
  </body>
</html>
