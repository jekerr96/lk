<?
if($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_SESSION["id"]) || $_SESSION["type"] == "client"){
die("У вас нет прав доступа");
}
?>
<div class="open_chat">

</div>
<div class="block_chat">
<div class="head_chat">
</div>
<div class="body_chat">

</div>
<div class="tools_chat">
  <div class="block_msg" contenteditable="true">

  </div>
</div>
</div>
