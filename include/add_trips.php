<div class="contact_form">
    <ul>
        <li>
             <h2>Добавление деловой поездки</h2>
             <span class="required_notification">* отмечены обязательные поля</span>
        </li>
        <li>
            <label>Описание:</label>
            <input type="text" id="description"  placeholder="Описание" />
        </li>
        <li>
            <label>Форма оплаты:</label>
            <select id="form">
                <?
                    include 'db_connect.php';
                    $query = "SELECT * FROM forms WHERE permission = 1";
                    $result = mysqli_query($link, $query);
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<option value='".$row['id']."'>".$row['name']."</option>";
                    }
                ?>
            </select>
        </li>
        <li>
            <label>Срок оплаты:</label>
            <input type="date" id="term" placeholder="Срок оплаты"/>
        </li>
        <li>
            <label>Адрес доставки документов:</label>
            <input type="text" id="address" placeholder="Адрес доставки документов"/>
        </li>
        <li>
             <h2>Добавление услуги</h2>
        </li>
        <li class="insertBefore">
            <li>
                <h2>Новая услуга</h2>
            </li>

            <label>Тип услуги:</label>
            <select id="type_service">
                <option value="1">Авиабилет</option>
                <option value="2">Железнодорожный билет</option>
                <option value="3">Автобилет</option>
                <option value="4">Гостиница</option>
            </select>
        </li>
        <li>
            <div class="add_services btn_submit" type="submit">Заполнить</div>
        </li>
        <li>
        	<span class="errors_add_trip"></span>
        	<span class="success_add_trip"></span>
        </li>
        <li>
        	<div class="add_trip_submit btn_submit" type="submit">Добавить</div>
          <div class="btn_new_add">Добавить еще</div>
          <a class="btn_back" href="/trips"><div class="btn_block_back">Назад к списку</div></a>
        </li>
    </ul>

</div>
