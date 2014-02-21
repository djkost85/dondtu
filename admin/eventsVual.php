<?php
  session_start();
  if ($_SESSION["auth"] != "1")
    exit(0);
  $_SESSION["lang"] = $_POST["lang"];
  header("Content-Type: text/html; charset=utf-8");
  require_once "../mysql.php";
  require_once "../" . $_SESSION["lang"] . "/date.php";
  $query = mysql_query("
    SELECT *
    FROM events
    WHERE
      deleted = 0 AND
      lang = '" . $_SESSION["lang"] . "'
    ORDER BY date DESC
    LIMIT " . $_POST["lbound"] . ", " . $_POST["count"] . "
  ");
  for ($i = 0; $row = mysql_fetch_array($query); $i++) {
?>
<div class = "block">
  <div id = "event<?=$row["id"];?>" eid = "<?=$row["id"];?>" onclick = "select(<?=$row["id"];?>)" class = "event" oncontextmenu = "return false;" style = "cursor: pointer; display: inline;">
    <div class = "time">
      <?php
        $date = explode("-", $row["date"]);
        echo $date[2] . " " . $months[$date[1] - 1] . "<br />" . $date[0];
      ?>
    </div>
    <div class = "about">
      <div class = "header"><?=$row["header"];?></div><br />
      <div class = "preview"><?=$row["preview"];?></div>
      <div class = "more">читать далее...</div>
    </div>
    <div class = "date" style = "display: none;"><?=$row["date"];?></div>
    <div class = "text" style = "display: none;"><?=$row["text"];?></div>
    <div class = "vkPostId" style = "display: none;"><?=$row["vkPostId"];?></div>
  </div>
  <input type = "checkbox" class = "active" title = "Активность" <?=$row["active"] ? "checked" : "";?> onChange = "checked ? activate(<?=$row["id"];?>) : deactivate(<?=$row["id"];?>)"; />
</div>
<?php if ($i < mysql_num_rows($query) - 1) { ?>
<hr />
<?php } } ?>