$(function() {
  var
    current = 0, num, slideTime = 10000,
    width = parseInt($("div#slider").css("width")),
    pwidth = width / slides.length,
    pheight = parseInt($("div#slider img").css("height")),
    middle = parseInt($("div#slider img").css("height")) / 2 - 18;
    
  $("div#curd")
    .css("width", pwidth)
    .css("top", /*$("div#slider").offset().top*/ 158 + parseInt($("div#slider img").css("height")) - 4);

  $("div#seld")
    .css("width", pwidth)
    .css("height", pheight - middle)
    .css("padding-top", middle)
    .css("top", /*$("div#slider").offset().top*/ 158);

  $("div#slider").children("img").attr("src", "../imageLibrary/slides/originals/" + slides[current]);

  function slide() {
    if (++current == slides.length)
      current = 0;
    $(this).children("img")
      .animate({ opacity: 0 }, 200, function() {
        $(this)
          .attr("src", "../imageLibrary/slides/originals/" + slides[current])
          .animate({ opacity: 1 }, 500);
      });
    $("div#curd").css("margin-left", current * pwidth);
  }

  $("div#slider").everyTime(slideTime, slide);

  $("div#slider img").mousemove(function(e) {
    num = parseInt(Math.floor(e.pageX - $("div#slider").offset().left) / pwidth);
    $("div#seld").css("margin-left", num * pwidth);
    if (num == slides.length)
      $("div#seld").css("width", Math.ceil(pwidth));
    else
      $("div#seld").css("width", pwidth);
  });

  $("div#slider img").mouseenter(function() {
    $("div#seld").css("display", "block");
  });

  $("div#seld").mouseleave(function() {
    $("div#seld").css("display", "none");
  });

  $("div#seld").click(function() {
    $("div#slider").stopTime();
    current = num;
    $("div#slider img")
      .animate({ opacity: 0 }, 200, function() {
        $(this)
          .attr("src", "../imageLibrary/slides/originals/" + slides[current])
          .animate({ opacity: 1 }, 500);
      });
    $("div#curd").css("margin-left", current * pwidth);
    $("div#slider").everyTime(slideTime, slide);
  });
});