<?php
  header("Content-type: text/html; charset=utf-8");
  require_once "../mysql.php";
  require_once "date.php";
  $query = mysql_query("
    SELECT *
    FROM events
    WHERE
      lang = 'ru' AND
      active = 1 AND
      deleted = 0
    ORDER BY date ASC
    LIMIT " . $_GET["lbound_events"] . ", " . $_GET["count_events"] . "
  ");
  for ($i = 0; $row = mysql_fetch_array($query); $i++) {
?>
<div class = "event">
  <div class = "time">
    <?php
      $date = explode("-", $row["date"]);
      echo $date[2] . " " . $months[$date[1] - 1] . "<br />" . $date[0];
    ?>
  </div>
  <div class = "about">
    <a href = "<?='event.php?id=' . $row["id"];?>" class = "header"><?=$row["header"];?></a><br />
    <div class = "preview">
      <?=$row["preview"];?>
      <a href = "event.php?id=<?=$row["id"];?>" class = "more">читать далее...</a>
    </div>
  </div>
</div>
<?php if ($i < mysql_num_rows($query) - 1) { ?>
<hr />
<?php } } ?>