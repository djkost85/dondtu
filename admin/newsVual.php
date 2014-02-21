<?php
  session_start();
  if ($_SESSION["auth"] != "1")
    exit(0);
  $_SESSION["lang"] = $_POST["lang"];
  header("Content-Type: text/html; charset=utf-8");
  require_once "../mysql.php";
  $query = mysql_query("
    SELECT *
    FROM news
    WHERE
      deleted = 0 AND
      lang = '" . $_SESSION["lang"] . "'
    ORDER BY date DESC
    LIMIT " . $_POST["lbound"] . ", " . $_POST["count"] . "
  ");
  while ($row = mysql_fetch_array($query)) {
    $fminiature = "../imageLibrary/news/miniatures/" . $row["id"] . ".jpeg";
    if (!file_exists($fminiature))
      $fminiature = "../imageLibrary/news/default.png";
?>
<div id = "new<?=$row["id"];?>" nid = "<?=$row["id"];?>" onclick = "select(<?=$row["id"];?>)" class = "new" oncontextmenu = "return false;" style = "cursor: pointer;">
  <div style = "display: block; overflow: hidden;">
    <img src = "<?=$fminiature . "?rand=" . mt_rand();?>" title = "Изображение" style = "float: left;" />
    <input type = "checkbox" class = "active" title = "Активность" <?=$row["active"] ? "checked" : "";?> onChange = "checked ? activate(<?=$row["id"];?>) : deactivate(<?=$row["id"];?>)"; />
  </div>
  <h5 title = "Заголовок"><?=$row["header"];?></h5>
  <div class = "preview" title = "Краткий обзор"><?=$row["preview"];?></div>
  <div class = "text" style = "display: none;"><?=$row["text"];?></div>
  <div class = "date" style = "display: none;"><?=$row["date"];?></div>
  <div class = "vkPostId" style = "display: none;"><?=$row["vkPostId"];?></div>
</div>
<?php } ?>