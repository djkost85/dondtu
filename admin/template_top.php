<!DOCTYPE html>
<html>
  <head>
    <title>Админ-панель</title>
    <meta charset = "utf-8" />
    <script type = "text/javascript" src = "../scripts/jquery-1.9.1.min.js"></script>
    <script type = "text/javascript" src = "../jquery-ui/js/jquery-ui-1.10.3.custom.min.js"></script>
    <script type = "text/javascript" src = "//vk.com/js/api/openapi.js"></script>
    <link type = "text/css" rel = "stylesheet" href = "../jquery-ui/css/jquery-ui-1.10.3.custom.min.css" />
    <script type = "text/javascript">
      $(function() {
        VK.init({
          apiId: 4003546
        });
        $("#radio").buttonset();
        $(".button").button();
        $("#images").button({ icons: { primary: "ui-icon-image" } });
        $("#slider").button({ icons: { primary: "ui-icon-video" } });
        $("#news").button({ icons: { primary: "ui-icon-star" } });
        $("#events").button({ icons: { primary: "ui-icon-pin-w" } });
        $("#admin").button({ icons: { primary: "ui-icon-wrench" } });
        $("#index").button({ icons: { primary: "ui-icon-circle-check" } });
      });
    </script>
    <link type = "text/css" rel = "stylesheet" href = "style/main.css" />
  </head>
  <body>
    <div style = "display: block; width: 1110px;">
      <a href = "slider.php" id = "slider">Редактор слайдов</a>
      <a href = "news.php" id = "news">Редактор новостей</a>
      <a href = "events.php" id = "events">Редактор анонса</a>
      <?php if ($showImages) { ?>
      <a href = "javascript:$img.library()" id = "images">Изображения</a>
      <?php } ?>
      <a href = "." id = "admin">На главную</a>
      <a href = ".." id = "index" target = "_blank">Перейти к WEB-сайту</a>
    </div><br />