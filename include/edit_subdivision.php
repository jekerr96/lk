<?
    session_start();
    $id = $_SESSION["id"];
    $ide = $_POST["ide"];

    include 'db_connect.php';
    $query = "SELECT * FROM subdivision WHERE id = $ide";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);

    $name = $row["name"];

?>

<div class="contact_form">
    <ul>
        <li>
             <h2>Изменение подразделения</h2>
             <span class="required_notification">* отмечены обязательные поля</span>
        </li>
        <li>
            <label>Наименование:</label>
            <input type="text" id="name" placeholder="Имя" required value=<? echo '"'.$name.'"';?>/>
        </li>
        <li>
        	<span class="errors_add_subdivision"></span>
        	<span class="success_add_subdivision"></span>
        </li>
        <li>
        	<div ide=<? echo '"'.$ide.'"'; ?> class="edit_subdivision_submit btn_submit" type="submit">Изменить</div>
        </li>
    </ul>

</div>