<?php
  session_start();
  if ($_SESSION["auth"] != "1")
    header("location:.");
  $showImages = TRUE;
  require_once "template_top.php";
  require_once "imageManipulator.php";
?>

<link type = "text/css" rel = "stylesheet" href = "../lightbox/css/lightbox.css" />
<script type = "text/javascript" src = "../lightbox/js/lightbox-2.6.min.js"></script>
<script type = "text/javascript">
  $(function() {
    $("#slides").sortable();
    $("#slides").disableSelection();

    $img.resizeComplete = function() {
      $img.processSlide();
    }

    $img.slideProcessed = function(rand) {
      $("#slides").append(' \
        <li fname = "' + rand + '.jpeg"> \
          <a href = "../imageLibrary/slides/originals/' + rand + '.jpeg" data-lightbox = "image-set" title = "' + rand + '.jpeg"> \
            <img src = "../imageLibrary/slides/originals/' + rand + '.jpeg" oncontextmenu = "return false;" /> \
          </a> \
        </li> \
      ');
    }

    save = function() {
      var imgs = $("#slides img"), str = "";
      for (var i = 0; i < imgs.length; i++) {
        var src = imgs[i].src;
        str += "\n" + src.substr(src.lastIndexOf("/") + 1);
      }
      $img.saveSlidesOrder(str.substr(1));
    }

    $img.slidesOrderSaved = function() { }

    $("#slides").on("mouseup", "li", function(e) {
      if (e.which == 3 && confirm("Удалить это изображение?")) {
        var fname = $(this).attr("fname");
        $(this).remove();
        var imgs = $("#slides img"), str = "";
        for (var i = 0; i < imgs.length; i++) {
          var src = imgs[i].src;
          str += "\n" + src.substr(src.lastIndexOf("/") + 1);
        }
        $img.deleteSlide(fname, str.substr(1));
      }
    });

    $img.slideDeleted = function() { }
  });
</script>

<h4>Редактор слайдов</h4>
<div class = "commands">
  <a href = "javascript:$img.library([255, 105]);" id = "load">добавить</a>
  <a href = "javascript:save();" id = "save">сохранить</a>
</div>
<br /><br />
<ul id = "slides">
  <?php
    if (filesize("../imageLibrary/slides/order") > 0) {
    $forder = fopen("../imageLibrary/slides/order", "r");
    while (!feof($forder)) {
      $fname = trim(fgets($forder), "\r\n");
  ?>
  <li fname = "<?=$fname;?>">
    <a href = "../imageLibrary/slides/originals/<?=$fname;?>" data-lightbox = "image-set" title = "<?=$fname;?>">
      <img src = "../imageLibrary/slides/miniatures/<?=$fname;?>" oncontextmenu = "return false;" />
    </a>
  </li>
  <?php } fclose($forder); } ?>
</ul>
<?php require_once "template_bottom.php"; ?>