<?php
  if (!($lang = $_COOKIE["lang"]) || ($lang != "ru" && $lang != "ua" && $lang != "en"))
    $lang = "ua";
  require_once "template_top.php";
  require_once "../mysql.php";
  $query = mysql_query("
    SELECT header, text
    FROM news
    WHERE
      id = " . $_GET["id"] . " AND
      active = 1 AND
      deleted = 0
  ");
?>

<div class = "block main">
  <div class = "container page-text">
    <div class = "text">
      <?php if ($row = mysql_fetch_array($query)) { ?>
        <h5><?=$row["header"];?></h5><hr style = "margin-bottom: 20px;" />
      <?php echo $row["text"]; } else { ?>
        <div style = "color: red;">Такой новости не существует</div>
      <?php } ?>
    </div>
    <div style = "float: right;">
      <script type = "text/javascript" src = "//vk.com/js/api/openapi.js?105"></script>
      <script type = "text/javascript">
        VK.init({ apiId: 4003546, onlyWidgets: true });
      </script>
      <div id = "vk_like"></div>
      <script type = "text/javascript">
        VK.Widgets.Like("vk_like", { type: "mini" });
      </script>
    </div>
  </div>
  <div class = "container" style = "padding-left: 10px;">
    <?php require_once "template_events.php"; ?>
  </div>
</div>

<?php
  require_once "template_footer.php";
  require_once "template_bottom.php";
?>