$(document).ready(function() {
  $("a.zoom").mouseenter(function() {
  	$(this).append("<img class = 'zoom_icon' />");
  });
  $("a.zoom").mouseleave(function() {
  	$(this).children("img.zoom_icon").remove();
  });
});