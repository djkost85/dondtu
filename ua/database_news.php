<?php
  header("Content-type: text/html; charset=utf-8");
  require_once "../mysql.php";
  $query = mysql_query("
    SELECT *
    FROM news
    WHERE
      lang = 'ua' AND
      active = 1 AND
      deleted = 0
    ORDER BY date DESC
    LIMIT " . $_GET["lbound_news"] . ", " . $_GET["count_news"] . "
  ");
  for ($i = 0; $row = mysql_fetch_array($query); $i++) {
    $foriginal = "../imageLibrary/news/originals/" . $row["id"] . ".jpeg";
    $fminiature = "../imageLibrary/news/miniatures/" . $row["id"] . ".jpeg";
    if (!file_exists($foriginal))
      $foriginal = "../imageLibrary/news/default.png";
    if (!file_exists($fminiature))
      $fminiature = "../imageLibrary/news/default.png";
?>
<div class = "new">
  <a data-lightbox = "image-set-<?=$i;?>" href = "<?=$foriginal;?>" title = "<?=$row["header"];?>">
    <img src = "<?=$fminiature . '?rand=' . mt_rand();?>" />
  </a>
  <h5>
    <a href = "news.php?id=<?=$row["id"];?>"><?=$row["header"];?></a>
  </h5>
  <div class = "preview">
    <?=$row["preview"];?>
  </div>
</div>
<?php } ?>