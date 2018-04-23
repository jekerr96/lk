<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Деловые поездки</title>
    <? include 'include/head.php'; ?>
  </head>
  <body>
    <? include 'include/menu.php'; ?>
    <div class="content">
      <div class="trips">
        <h2>Клиент</h2>
        <select class="select_trips">
          <option value="-1">Пусто</opton>
          <?
            include 'include/db_connect.php';
            $query = "SELECT id, name FROM clients";
            $result = mysqli_query($link, $query);
            while($row = mysqli_fetch_assoc($result)){
              echo '
                <option value="'.$row["id"].'"">'.$row["name"].'</opton>
              ';
            }
          ?>
        </select>

      <div class="insert_trips">

      </div>
    </div>
  </body>
</html>
