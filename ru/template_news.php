<link type = "text/css" rel = "stylesheet" href = "../style/news.css" />
<script type = "text/javascript">
  $(function() {
    lbound_news = 0, count_news = 6, enabled_news = true;
    
    append_news = function() {
      if (enabled_news) {
        $.ajax({
          url: "database_news.php",
          type: "get",
          data: {
            "lbound_news": lbound_news,
            "count_news": count_news
          },
          success: function(html) {
            if (html == "")
              enabled_news = false;
            else {
              $("div.news").append(html);
              lbound_news += count_news;
            }
          }
        });
      }
    }

    append_news();

    $("input#more_news").click(function() {
      append_news();
    });
  });
</script>

<div class = "block">
  <h4>Новости</h4><br />
  <div class = "news"></div>
  <input type = "button" class = "submit" id = "more_news" value = "Больше новостей" style = "margin-right: 70px;" />
</div>
<br />