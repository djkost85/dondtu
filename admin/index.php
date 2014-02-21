<?php
  $showImages = FALSE;
  session_start();
  require_once "template_top.php";
?>

<div id = "content">
  <form method = "post" action = "authVual.php">
  <?php if ($_SESSION["auth"] == "1") { ?>
    <div id = "login_button" onclick = "VK.Auth.login('wall,photos');"></div>
    <script type = "text/javascript">
      VK.UI.button("login_button");
    </script>
    <input type = "hidden" name = "action" value = "exit" />
    <input type = "submit" value = "Выйти из админ-панели" class = "button" />
  <?php } else { ?>
    Необходима авторизация<br />
    <input type = "hidden" name = "action" value = "auth" />
    <input type = "text" placeholder = "Логин" name = "login" value = "" /><br />
    <input type = "password" placeholder = "Пароль" name = "password" value = "" /><br />
    <input type = "submit" value = "Подтвердить" class = "button" />
  <?php } ?>
  </form>
</div>

<?php require_once "template_bottom.php"; ?>