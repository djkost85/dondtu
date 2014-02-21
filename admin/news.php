<?php
  session_start();
  if ($_SESSION["auth"] != "1")
    header("location:.");
  if ($_SESSION["lang"] != "ru" && $_SESSION["lang"] != "ua" && $_SESSION["lang"] != "en")
    $_SESSION["lang"] = "ua";
  $showImages = TRUE;
  $vkError = "Эта запись не прикреплена в социальной сети";
  require_once "template_top.php";
  require_once "imageManipulator.php";
?>

<link type = "text/css" rel = "stylesheet" href = "../style/news.css" />
<script type = "text/javascript" src = "../ckeditor/ckeditor.js"></script>
<script type = "text/javascript">
  $(function() {
    lbound = 0, count = 4, enabled = true, lang = "<?=$_SESSION['lang'];?>", currentId = newImage = null, vkPostId = 0;
    CKEDITOR.ENTER_BR = 1;

    $("#single_date").datepicker({
      dateFormat: "yy-mm-dd",
      changeMonth: true,
      changeYear: true
    });

    replaceAt = function(node) {
      var targets = node.find("a > img").parent(), target;
      for (var i = 0; i < targets.length; i++) {
        target = $(targets[i]);
        if (target.attr("rel"))
          target.attr("data-lightbox", target.attr("rel"));
      }
    }

    clear = function() {
      currentId = newImage = null;
      $("#single_header").val("");
      $("#single_date").val("");
      $("#single_img").attr("src", "../imageLibrary/news/default.png");
      $("#single_preview").html("");
      $("#single_text").html("");
      vkPostId = 0;
      $("#wall").attr("href", "javascript:alert('<?=$vkError;?>')");
    }

    select = function(id) {
      if (currentId != id) {
        currentId = id;
        var target = $("#new" + id);
        $("#single_header").val(target.children("h5").html());
        $("#single_date").val(target.children(".date").html());
        $("#single_img").attr("src", target.find("img").attr("src"));
        $("#single_preview").html(target.children(".preview").html());
        $("#single_text").html(target.children(".text").html());
        VK.Auth.getLoginStatus(function authInfo(response) {
          if (response.session) {
            vkPostId = target.children(".vkPostId").html();
            VK.Api.call("wall.getById", {
              "posts": "-1823100_" + vkPostId
            }, function(resp) {
              if(resp.response[0]) {
                vkPostId = parseInt(resp.response[0]["id"]);
                $("#wall").attr("href", "http://vk.com/wall-1823100_" + vkPostId);
              }
              else
                vkPostId = 0;
            });
          }
        });
      }
    }

    add = function() {
      replaceAt($("#single_text"));
      $img.addNews(
        $("#single_header").val(),
        $("#single_date").val(),
        $("#single_preview").html(),
        $("#single_text").html(),
        lang, newImage, currentId
      );
    }

    edit = function() {
      if (currentId) {
        replaceAt($("#single_text"));
        $img.editNews(
          $("#single_header").val(),
          $("#single_date").val(),
          $("#single_preview").html(),
          $("#single_text").html(),
          lang, newImage, currentId
        );
      }
      else
        alert("Вы должны выбрать новость для редактирования");
    }

    $(".news").on("mouseup", ".new", function(e) {
      if (e.which == 3 && confirm("Удалить эту новость?"))
        $img.deleteNews($(this).attr("nid"));
    });

    $img.newsAdded = function() {
      if (confirm("Разместить запись ВКонтакте?"))
        $img.vkAddNews();
      else {
        $(".news").html("");
        lbound = 0, count = 4, enabled = true;
        append();
        clear();
      }
    }

    $img.newsEdited = $img.newsDeleted = function() {
      $(".news").html("");
      lbound = 0, count = 4, enabled = true;
      append();
      clear();
    }

    $img.vkNewsAdded = function(html) {
      if (html == "ERR")
        alert("Произошла ошибка при доступе к базе данных");
    }

    $img.resizeComplete = function() {
      $img.processNews();
    }

    $img.newsProcessed = function() {
      newImage = true;
      $("#single_img").attr("src", "../imageLibrary/news/miniatures/temp");
    }

    activate = function(nid) {
      $img.activateNews(nid);
    }

    deactivate = function(nid) {
      $img.deactivateNews(nid);
    }

    $img.newsActivated = $img.newsDeactivated = function() { }

    chlang = function(sel) {
      $(".news").html("");
      lbound = 0, count = 4, enabled = true, lang = sel;
      append();
    }

    append = function() {
      if (enabled) {
        $.ajax({
          url: "newsVual.php",
          type: "post",
          data: {
            "lbound": lbound,
            "count": count,
            "lang": lang
          },
          success: function(html) {
            if (html == "")
              enabled = false;
            else {
              $("div.news").append(html);
              lbound += count;
            }
          }
        });
      }
    }

    append();

    $("input#more").click(function() {
      append();
    });
  });
</script>

<br /><div id = "radio">
  <input type = "radio" id = "lang_ua" name = "lang" onChange = "chlang('ua')" <?=$_SESSION["lang"] == "ua" ? "checked" : "";?> /><label for = "lang_ua">Украинский</label>
  <input type = "radio" id = "lang_ru" name = "lang" onChange = "chlang('ru')" <?=$_SESSION["lang"] == "ru" ? "checked" : "";?> /><label for = "lang_ru">Русский</label>
  <input type = "radio" id = "lang_en" name = "lang" onChange = "chlang('en')" <?=$_SESSION["lang"] == "en" ? "checked" : "";?> /><label for = "lang_en">Английский</label>
</div><br />
<div class = "block" style = "width: 1110px;">
  <div class = "container page-text" style = "margin: 0; width: 320px;">
    <h4>Последние новости</h4>
    <div class = "block">
      <div class = "news"></div>
      <input type = "button" class = "submit" id = "more" value = "Еще новости" style = "margin-right: 30px;" />
    </div>
  </div>
  <div class = "container" style = "padding-left: 10px;">
    <h4>Текущая новость</h4>
    <div class = "commands">
      <a href = "javascript:clear()" id = "neutral">очистить</a>
      <a href = "javascript:add();" id = "load">добавить</a>
      <a href = "javascript:edit();" id = "save">сохранить</a>
      <a href = "javascript:$img.vkAddNews()" class = "vk">разместить</a>
      <a href = "javascript:alert('<?=$vkError;?>')" class = "vk" id = "wall">к записи</a>
    </div><br /><br />
    <table id = "single">
      <tr>
        <th>Заголовок</th>
        <td><input type = "text" id = "single_header" /></td>
      </tr>
      <tr>
        <th>Дата новости</th>
        <td><input type = "text" id = "single_date" /></td>
      </tr>
      <tr>
        <th>Изображение</th>
        <td style = "width: 290px;">
          <a href = "javascript:$img.library([260, 146])" class = "imageWrapper">
            <img id = "single_img" style = "width: 260px; height: 146px;" src = "../imageLibrary/news/default.png" title = "Кликните, чтобы загрузить новое изображение" />
          </a>
        </td>
      </tr>
      <tr>
        <th>Краткий обзор</th>
        <td><div id = "single_preview" contentEditable = "true" style = "min-width: 256px; max-width: 256px;"></div></td>
      </tr>
      <tr>
        <th>Текст новости</th>
        <td><div id = "single_text" contentEditable = "true" style = "min-width: 650px; max-width: 650px; min-height: 300px;"></div></td>
      </tr>
    </table>
  </div>
</div>
<?php require_once "template_bottom.php"; ?>