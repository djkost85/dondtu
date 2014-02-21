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

<link type = "text/css" rel = "stylesheet" href = "../style/events.css" />
<script type = "text/javascript" src = "../ckeditor/ckeditor.js"></script>
<script type = "text/javascript">
  $(function() {
    lbound = 0, count = 3, enabled = true, lang = "<?=$_SESSION['lang'];?>", currentId = null, vkPostId = 0;
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
      $("#single_preview").html("");
      $("#single_text").html("");
      vkPostId = target.children(".vkPostId").html();
    }

    select = function(id) {
      if (currentId != id) {
        currentId = id;
        var target = $("#event" + id);
        $("#single_header").val(target.find(".header").html());
        $("#single_date").val(target.children(".date").html());
        $("#single_preview").html(target.find(".preview").html());
        $("#single_text").html(target.find(".text").html());
      }
    }

    add = function() {
      replaceAt($("#single_text"));
      $img.addEvent(
        $("#single_header").val(),
        $("#single_date").val(),
        $("#single_preview").html(),
        $("#single_text").html(),
        lang, currentId
      );
    }

    edit = function() {
      if (currentId) {
        replaceAt($("#single_text"));
        $img.editEvent(
          $("#single_header").val(),
          $("#single_date").val(),
          $("#single_preview").html(),
          $("#single_text").html(),
          lang, currentId
        );
      }
      else
        alert("Вы должны выбрать событие для редактирования");
    }

    $(".events").on("mouseup", ".event", function(e) {
      if (e.which == 3 && confirm("Удалить это событие?"))
        $img.deleteEvent($(this).attr("eid"));
    });

    $img.eventAdded = $img.eventEdited = $img.eventDeleted = function() {
      $(".events").html("");
      lbound = 0, count = 3, enabled = true;
      append(true);
      clear();
    }

    $img.vkEventAdded = function(html) {
      if (html == "ERR")
        alert("Произошла ошибка при доступе к базе данных");
    }

    activate = function(eid) {
      $img.activateEvent(eid);
    }

    deactivate = function(eid) {
      $img.deactivateEvent(eid);
    }

    $img.eventActivated = $img.eventDeactivated = function() { }

    append = function(first_time) {
      if (enabled) {
        $.ajax({
          url: "eventsVual.php",
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
              $("div.events").append((first_time ? "" : "<hr />") + html);
              lbound += count;
            }
          }
        });
      }
    }

    append(true);

    $("input#more").click(function() {
      append(false);
    });

    chlang = function(sel) {
      $(".events").html("");
      lbound = 0, count = 3, enabled = true, lang = sel;
      append(true);
    }
  });
</script>

<br /><div id = "radio">
  <input type = "radio" id = "lang_ua" name = "lang" onChange = "chlang('ua')" <?=$_SESSION["lang"] == "ua" ? "checked" : "";?> /><label for = "lang_ua">Украинский</label>
  <input type = "radio" id = "lang_ru" name = "lang" onChange = "chlang('ru')" <?=$_SESSION["lang"] == "ru" ? "checked" : "";?> /><label for = "lang_ru">Русский</label>
  <input type = "radio" id = "lang_en" name = "lang" onChange = "chlang('en')" <?=$_SESSION["lang"] == "en" ? "checked" : "";?> /><label for = "lang_en">Английский</label>
</div><br />
<div class = "block" style = "width: 1110px;">
  <div class = "container page-text" style = "margin: 0; width: 320px;">
    <h4>Ближайшие события</h4>
    <div class = "block">
      <div class = "events" style = "width: 295px;"></div><br />
      <input type = "button" class = "submit" id = "more" value = "Еще события" style = "margin-right: 30px;" />
    </div>
  </div>
  <div class = "container" style = "padding-left: 10px;">
    <h4>Текущее событие</h4>
    <div class = "commands">
      <a href = "javascript:clear()" id = "neutral">очистить</a>
      <a href = "javascript:add();" id = "load">добавить</a>
      <a href = "javascript:edit();" id = "save">сохранить</a>
      <a href = "javascript:$img.vkAddEvent()" class = "vk">разместить</a>
      <a href = "javascript:alert('<?=$vkError;?>')" class = "vk" id = "wall">к записи</a>
    </div><br /><br />
    <table id = "single">
      <tr>
        <th>Заголовок</th>
        <td><input type = "text" id = "single_header" /></td>
      </tr>
      <tr>
        <th>Дата события</th>
        <td><input type = "text" id = "single_date" /></td>
      </tr>
      <tr>
        <th>Краткий обзор</th>
        <td><div id = "single_preview" contentEditable = "true" style = "min-width: 256px; max-width: 256px;"></div></td>
      </tr>
      <tr>
        <th>Текст события</th>
        <td><div id = "single_text" contentEditable = "true" style = "min-width: 650px; max-width: 650px; min-height: 300px;"></div></td>
      </tr>
    </table>
  </div>
</div>
<?php require_once "template_bottom.php"; ?>