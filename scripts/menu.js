$(function() {
  $("li.menu-item").mouseenter(function() {
    $(this)
      .css("background", "url(../images/active.gif) repeat-x 0% 50%")
      .children("ul.smenu")
      .css("display", "block");
  });
  $("li.menu-item").mouseleave(function() {
    $(this)
      .css("background", "none")
      .children("ul.smenu")
      .css("display", "none");
  });
  $("li.smenu-item").mouseenter(function() {
    $(this)
      .children("ul.ssmenu")
      .css("display", "block");
  });
  $("li.smenu-item").mouseleave(function() {
    $(this)
      .children("ul.ssmenu")
      .css("display", "none");
  });
});