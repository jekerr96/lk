<?
session_start();
if($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_SESSION["id"] || $_SESSION["type"] != "client")){
die("У вас нет прав доступа");
}
?>
<div class="contact_form">
    <ul>
        <li>
             <h2>Добавление сотрудника</h2>
             <span class="required_notification">* отмечены обязательные поля</span>
        </li>
        <li>
            <label>Фамилия:</label>
            <input type="text" id="surname"  placeholder="Фамилия" required />
        </li>
        <li>
            <label>Имя:</label>
            <input type="text" id="name" placeholder="Имя" required />
        </li>
        <li>
            <label>Отчество:</label>
            <input type="text" id="patronymic" placeholder="Отчество" required />
        </li>
        <li>
            <label>Паспорт:</label>
            <input type="text" id="passport" placeholder="Серия номер" required pattern="\d{4}\s\d{6}" />
            <span class="form_hint">Пример: 0123 123456</span>
        </li>
        <li>
            <label>Место рождения:</label>
            <input type="text" id="place_birth" placeholder="Место рождения" required />
        </li>
        <li>
            <label>Загран фамилия:</label>
            <input type="text" id="zagran_surname" placeholder="Загран фамилия"/>
        </li>
        <li>
            <label>Загран имя:</label>
            <input type="text" id="zagran_name" placeholder="Загран имя" />
        </li>
        <li>
            <label>Загран фамилия:</label>
            <input type="text" id="zagran_patronymic" placeholder="Загран отчество" />
        </li>
        <li>
            <label>Загран паспорт:</label>
            <input type="text" id="zagran_series_number" placeholder="Загран паспорт" />
        </li>
        <li>
            <label>Срок действия:</label>
            <input type="text" id="zagran_term" placeholder="Срок действия" />
        </li>
        <li>
        	<span class="errors_add_employee"></span>
        	<span class="success_add_employee"></span>
        </li>
        <li>
        	<div class="add_employee_submit btn_submit" type="submit">Добавить</div>
          <div class="btn_new_add">Добавить еще</div>
          <a class="btn_back" href="/employees"><div class="btn_block_back">Назад к списку</div></a>

        </li>
    </ul>

</div>
