<?php
  session_start();
  if ($_SESSION["auth"] != "1")
    header("location:.");
?>

<link type = "text/css" rel = "stylesheet" href = "../jcrop/css/jquery.Jcrop.min.css" />
<script type = "text/javascript" src = "../jcrop/js/jquery.Jcrop.min.js"></script>
<script type = "text/javascript" src = "scripts/main.js"></script>

<script type = "text/javascript">
  $(function() {
    /* Variables */ {
      domain = "http://localhost/dondtu/";
      $img = [];

      coords = null;
      resizer = null;
      format = null;
    }

    /* Images */ {
      $("#inputFile").change(function() {
        if ($(this).val() != "") {
          var fid = "upload_" + Math.random();
          $("#frm").attr("target", fid);
          $("#uploads").append("<iframe id = '" + fid + "' onLoad = 'uploadComplete(id)'></iframe>");
          $("#frm").submit();
        }
      });
      uploadComplete = function(fid) {
        var
          frame = document.getElementById(fid),
          content = frame.contentWindow.document.body.innerHTML;
        $("#" + fid).remove();
        addImage(content);
      }
      $img.library = function(tformat) {
        format = tformat;
        $("#imageLibrary").dialog({
          width: 698,
          minHeight: 500,
          modal: true,
          buttons: {
            "Добавить из файла": function() {
              $("#inputFile").click();
            },
            "Добавить по ссылке": function() {
              if (address = prompt("Введите адрес изображения"))
                $.ajax({
                  url: "imageManipulatorVual.php",
                  type: "post",
                  data: {
                    "action": "uploadImageRemote",
                    "address": address
                  },
                  success: function(html) {
                    //console.log(html);
                    addImage(html);
                  }
                });
            },
            "Закрыть": function() {
              $(this).dialog("close");
            }
          }
        });
      }
      addImage = function(rand) {
        if (rand == "General error")
          alert("Произошла ошибка при загрузке файла.\nВозможно размер файла превысил ограничение.");
        else if (rand == "Format error")
          alert("Произошла ошибка при загрузке файла.\nФайл имел неверный формат.\nДопустимые форматы: \"bmp\", \"png\", \"jpg\", \"gif\"");
        else if (rand != "") {
          $("#imageLibrary").append(' \
            <div class = "holder" fname = "' + rand + '"> \
              <div class = "wrapper"> \
                <img src = "../imageLibrary/images/miniatures/' + rand + '" oncontextmenu = "return false;" /> \
              </div> \
            </div> \
          ');
        }
      }
      $img.select = function(img, format) {
        img.Jcrop({
          aspectRatio: format[0] / format[1],
          onSelect: jcoords,
          onChange: jcoords
        }, function() {
          resizer = this;
        });
      }
      $img.deselect = function() {
        if (resizer) {
          resizer.destroy();
          resizer = null;
        }
      }
      $img.processSlide = function() {
        var target = $("#target");
        var fname = target.attr("realSrc");
        $.ajax({
          url: "imageManipulatorVual.php",
          type: "post",
          data: {
            "action": "processSlide",
            "fname": fname,
            "selectedLeft": coords.x,
            "selectedTop": coords.y,
            "selectedWidth": coords.w,
            "selectedHeight": coords.h,
            "cssWidth": parseInt(target.css("width")),
            "cssHeight": parseInt(target.css("height"))
          },
          success: function(html) {
            $("#imageEditor").dialog("close");
            $("#imageLibrary").dialog("close");
            $img.slideProcessed(html);
          }
        });
      }
      $img.saveSlidesOrder = function(sorder) {
        $.ajax({
          url: "imageManipulatorVual.php",
          type: "post",
          data: {
            "action": "saveSlidesOrder",
            "order": sorder
          },
          success: function() {
            $img.slidesOrderSaved();
          }
        });
      }
      jcoords = function(current) {
        coords = current;
      }
      $("#imageLibrary").on("mouseup", "div.holder", function(e) {
        if (e.which == 3) {
          if (confirm("Удалить это изображение?")) {
            var holder = $(this);
            $.ajax({
              url: "imageManipulatorVual.php",
              type: "post",
              data: {
                "action": "deleteImage",
                "fname": $(this).attr("fname")
              },
              success: function(html) {
                holder.remove();
              }
            });
          }
        }
        else {
          if (format) {
            var target = $("#target")
              .attr("src", "../imageLibrary/images/originals/" + $(this).attr("fname") + "?rand=" + Math.random())
              .attr("realSrc", "../imageLibrary/images/originals/" + $(this).attr("fname"));
            var img = $(this).find("img");
            $img.select(target, [ format[0], format[1] ]);
            $("#imageEditor").dialog({
              width: 500 / parseInt(img.css("height")) * parseInt(img.css("width")) + 24,
              modal: true,
              resizable: false,
              buttons: {
                "Сохранить": function() {
                  if (resizer && coords)
                    $img.resizeComplete();
                  else
                    alert("Вы должны выбрать область картинки");
                },
                "Отмена": function() {
                  $(this).dialog("close");
                }
              },
              close: function() {
                $img.deselect();
              }
            });
          }
          else {
            $("#link").val(domain + "imageLibrary/images/originals/" + $(this).attr("fname"));
            $("#imageLink").dialog({
              width: 500,
              modal: true,
              resizable: false,
              buttons: {
                "Закрыть": function() {
                  $(this).dialog("close");
                }
              }
            });
            $("#link").select();
          }
        }
      });
      $img.deleteSlide = function(fname, sorder) {
        $.ajax({
          url: "imageManipulatorVual.php",
          type: "post",
          data: {
            "action": "deleteSlide",
            "fname": fname,
            "order": sorder
          },
          success: function(html) {
            $img.slideDeleted();
          }
        });
      }
    }

    /* News */ {
      $img.processNews = function() {
        var target = $("#target");
        var fname = target.attr("realSrc");
        $.ajax({
          url: "imageManipulatorVual.php",
          type: "post",
          data: {
            "action": "processNews",
            "fname": fname,
            "selectedLeft": coords.x,
            "selectedTop": coords.y,
            "selectedWidth": coords.w,
            "selectedHeight": coords.h,
            "cssWidth": parseInt(target.css("width")),
            "cssHeight": parseInt(target.css("height"))
          },
          success: function(html) {
            $("#imageEditor").dialog("close");
            $("#imageLibrary").dialog("close");
            $img.newsProcessed();
          }
        });
      }
      $img.addNews = function(header, date, preview, text, lang, newImage, editing) {
        $.ajax({
          url: "imageManipulatorVual.php",
          type: "post",
          data: {
            "action": "addNews",
            "header": header,
            "date": date,
            "preview": preview,
            "text": text,
            "lang": lang,
            "newImage": newImage,
            "editing": editing
          },
          success: function(html) {
            $img.newsAdded();
          }
        });
      }
      $img.editNews = function(header, date, preview, text, lang, newImage, editing) {
        $.ajax({
          url: "imageManipulatorVual.php",
          type: "post",
          data: {
            "action": "editNews",
            "header": header,
            "date": date,
            "preview": preview,
            "text": text,
            "lang": lang,
            "newImage": newImage,
            "editing": editing
          },
          success: function(html) {
            $img.newsEdited();
          }
        });
      }
      $img.activateNews = function(nid) {
        $.ajax({
          url: "imageManipulatorVual.php",
          type: "post",
          data: {
            "action": "activateNews",
            "id": nid
          },
          success: function(html) {
            if (html == "1")
              $img.newsActivated();
          }
        });
      }
      $img.deactivateNews = function(nid) {
        $.ajax({
          url: "imageManipulatorVual.php",
          type: "post",
          data: {
            "action": "deactivateNews",
            "id": nid
          },
          success: function(html) {
            if (html == "1")
              $img.newsDeactivated();
          }
        });
      }
      $img.deleteNews = function(nid) {
        $.ajax({
          url: "imageManipulatorVual.php",
          type: "post",
          data: {
            "action": "deleteNews",
            "id": nid
          },
          success: function(html) {
            $img.newsDeleted();
          }
        });
      }
    }

    /* Events */ {
      $img.addEvent = function(header, date, preview, text, lang) {
        $.ajax({
          url: "imageManipulatorVual.php",
          type: "post",
          data: {
            "action": "addEvent",
            "header": header,
            "date": date,
            "preview": preview,
            "text": text,
            "lang": lang
          },
          success: function(html) {
            $img.eventAdded();
          }
        });
      }
      $img.editEvent = function(header, date, preview, text, lang, editing) {
        $.ajax({
          url: "imageManipulatorVual.php",
          type: "post",
          data: {
            "action": "editEvent",
            "header": header,
            "date": date,
            "preview": preview,
            "text": text,
            "lang": lang,
            "editing": editing
          },
          success: function(html) {
            $img.eventEdited();
          }
        });
      }
      $img.activateEvent = function(eid) {
        $.ajax({
          url: "imageManipulatorVual.php",
          type: "post",
          data: {
            "action": "activateEvent",
            "id": eid
          },
          success: function(html) {
            if (html == "1")
              $img.eventActivated();
          }
        });
      }
      $img.deactivateEvent = function(eid) {
        $.ajax({
          url: "imageManipulatorVual.php",
          type: "post",
          data: {
            "action": "deactivateEvent",
            "id": eid
          },
          success: function(html) {
            if (html == "1")
              $img.eventDeactivated();
          }
        });
      }
      $img.deleteEvent = function(eid) {
        $.ajax({
          url: "imageManipulatorVual.php",
          type: "post",
          data: {
            "action": "deleteEvent",
            "id": eid
          },
          success: function(html) {
            $img.eventDeleted();
          }
        });
      }
    }

    /* VK */ {
      $img.vkWrap = function(elem) {
        var
          replacingHtmlElems = [ "div", "span", "img", "a", "ul", "ol", "table", "tbody", "tr", "td", "strong", "b", "i", "u", "center" ],
          removingElems = [ "br", "hr", "iframe" ];

        elem.html(elem.html()
          .replace(/\n/g, " ")
        );

        for (var i in replacingHtmlElems)
          while (elem.find(replacingHtmlElems[i]).length > 0)
            elem.find(replacingHtmlElems[i]).each(function() {
              if ($(this).html() == "")
                $(this).remove();
              else
                $(this).replaceWith($(this).html());
            });

        while (elem.find("p").length > 0)
          elem.find("p").each(function() {
            $(this).replaceWith($(this).html() + "\n");
          });

        while (elem.find("li").length > 0)
          elem.find("li").each(function() {
            $(this).replaceWith("- " + $(this).html() + "\n");
          });

        for (var i in removingElems)
          elem.find(removingElems[i]).remove();

        var message = elem.html()
          .replace("<o:p></o:p>", "")
          .replace(":<o:p></o:p>", "")
          .replace(/&nbsp;/g, " ")
          .substr(0, 620);
        message = message.substr(0, message.lastIndexOf(" ")) + "..";
        elem.html(message);
      }

      var months = [ "сiчня", "лютого", "березня", "квiтня", "травня", "червня", "липня", "серпня", "вересня", "жовтня", "листопада", "грудня" ];
      getStrDate = function(str) {
        date = str.split("-");
        if (date[2][0] == '0')
          date[2] = date[2][1];
        return date[2] + " " + months[date[1] - 1] + " " + date[0] + " р.";
      }

      $img.vkAddNews = function() {
        if (currentId)
          VK.Auth.getLoginStatus(function authInfo(response) {
            if (response.session) {
              var text = $("#single_text"), html = text.html();
              $img.vkWrap(text);
              var message = $("#single_header").val() + "\n" + getStrDate($("#single_date").val()) + " #новости@dongtu\n\n" + text.html();
              text.html(html);
              VK.Api.call("photos.getUploadServer", {
                aid: 183398301,
                gid: 1823100
              }, function(resp) {
                $.ajax({
                  url: "imageManipulatorVual.php",
                  type: "post",
                  data: {
                    "action": "vkUploadPhoto",
                    "photo": "/var/www/dmmi.edu.ua/imageLibrary/news/originals/" + currentId + ".jpeg",
                    "url": resp.response.upload_url
                  },
                  success: function(html) {
                    var upload = [];
                    JSON.parse(html, function(key, value) {
                      if (key == "server")
                        upload.server = value;
                      else if (key == "photos_list")
                        upload.photos_list = value;
                      else if (key == "hash")
                        upload.hash = value;
                    });
                    VK.Api.call("photos.save", {
                      aid: 183398301,
                      server: upload.server,
                      photos_list: upload.photos_list,
                      hash: upload.hash,
                      gid: 1823100
                    }, function(resp) {
                      resp = resp.response[0];
                      VK.Api.call("wall.post", {
                        "owner_id": -1823100,
                        "from_group": 1,
                        "message": message,
                        "attachments": "photo" + resp.owner_id + "_" + resp.pid + ",http://www.dmmi.edu.ua/ua/news.php?id=" + currentId
                      }, function(resp) {
                        var vkPostId = parseInt(resp.response["post_id"]);
                        if (vkPostId <= 0)
                          alert("Ошибка ВКонтакте");
                        else {
                          $("#wall").attr("href", "http://vk.com/wall-1823100_" + vkPostId);
                          $.ajax({
                            url: "imageManipulatorVual.php",
                            type: "post",
                            data: {
                              "action": "vkNewsSent",
                              "id": currentId,
                              "vkPostId": vkPostId
                            },
                            success: function(html) {
                              $img.vkNewsAdded(html);
                            }
                          });
                        }
                      });
                    });
                  }
                });
              });
            }
          });
        else
          alert("Вы должны выбрать новость для размещения");
      }

      $img.vkAddEvent = function() {
        if (currentId)
          VK.Auth.getLoginStatus(function authInfo(response) {
            if (response.session) {
              var text = $("#single_text"), html = text.html();
              $img.vkWrap(text);
              var message = $("#single_header").val() + "\n" + getStrDate($("#single_date").val()) + " #анонс@dongtu\n\n" + text.html();
              text.html(html);
              VK.Api.call("wall.post", {
                "owner_id": -1823100,
                "from_group": 1,
                "message": message,
                "attachments": "http://www.dmmi.edu.ua/ua/event.php?id=" + currentId
              }, function(resp) {
                var vkPostId = parseInt(resp.response["post_id"]);
                if (vkPostId <= 0)
                  alert("Ошибка ВКонтакте");
                else {
                  $("#wall").attr("href", "http://vk.com/wall-1823100_" + vkPostId);
                  $.ajax({
                    url: "imageManipulatorVual.php",
                    type: "post",
                    data: {
                      "action": "vkEventSent",
                      "id": currentId,
                      "vkPostId": vkPostId
                    },
                    success: function(html) {
                      $img.vkEventAdded(html);
                    }
                  });
                }
              });
            }
          });
        else
          alert("Вы должны выбрать событие для размещения");
      }
    }

  });
</script>

<form method = "post" action = "imageManipulatorVual.php" enctype = "multipart/form-data" id = "frm" style = "display: none;">
  <input type = "file" id = "inputFile" name = "inputFile" />
  <input type = "hidden" name = "action" value = "uploadImageLocal" />
</form>
<div id = "uploads" style = "display: none;"></div>

<div id = "imageLibrary" title = "Библиотека изображений" style = "display: none;">
  <?php
    $dir = opendir("../imageLibrary/images/miniatures/");
    while ($fname = readdir($dir))
      if ($fname != "." && $fname != "..") {
  ?>
  <div class = "holder" fname = "<?=$fname;?>">
    <div class = "wrapper">
      <img src = "../imageLibrary/images/miniatures/<?=$fname;?>" oncontextmenu = "return false;" />
    </div>
  </div>
  <?php } closedir($dir); ?>
</div>

<div id = "imageEditor" title = "Редактор изображения" style = "display: none;">
  <img id = "target" />
</div>

<div id = "imageLink" title = "Ссылка на изображение" style = "display: none;">
  <input type = "text" id = "link" />
</div>