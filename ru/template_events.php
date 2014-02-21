<link type = "text/css" rel = "stylesheet" href = "../style/events.css" />
<script type = "text/javascript">
  $(function() {
    lbound_events = 0, count_events = 3, enabled_events = true;

    append_events = function(first_time) {
      if (enabled_events) {
        $.ajax({
          url: "database_events.php",
          type: "get",
          data: {
            "lbound_events": lbound_events,
            "count_events": count_events
          },
          success: function(html) {
            if (html == "")
              enabled_events = false;
            else {
              $("div.events").append((first_time ? "" : "<hr />") + html);
              lbound_events += count_events;
            }
          }
        });
      }
    }

    append_events(true);

    $("input#more_events").click(function() {
      append_events(false);
    });
  });
</script>

<div class = "block">
  <h4>Анонс</h4><br />
  <div class = "events"></div><br />
  <input type = "button" class = "submit" id = "more_events" value = "Больше событий" style = "margin-right: 30px;" />
</div>
<br />