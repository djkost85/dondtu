<?php require_once "template_top.php"; ?>

<script type = "text/javascript">
  slides = [];
  <?php
    if (filesize("../imageLibrary/slides/order") > 0) {
    $forder = fopen("../imageLibrary/slides/order", "r");
    while (!feof($forder)) {
      $fname = trim(fgets($forder), "\r\n");
  ?>
  slides.push("<?=$fname;?>");
  <?php } fclose($forder); } ?>

    var useragent = window.navigator.userAgent;
    var IEB = /MSIE *\d+\.\w+/i;
    IE = useragent.match(IEB);
    var msieVersion = IE[0].split(' ')[1];
    if(msieVersion < 8)
      alert("Требуется обновить Internet Explorer до версии 8.0");
    
</script>

<link rel = "stylesheet" href = "../style/slider.css" />
<script type = "text/javascript" src = "../scripts/slider.js"></script>
<div id = "slider">
  <img />
  <div id = "seld"></div>
  <div id = "curd"></div>
</div>
<!--
<div class = "marquee">
  <marquee>6 февраля состоится встреча с выпускниками школ г. Алчевска. Приглашаются все желающие. Начало 13-30 в аудитории 1.315 (1-й корпус, 3-й этаж.)</marquee>
</div>
-->
<div class = "block main">
  <div class = "container page-text" style = "margin: 0; width: 670px;">
    <?php require_once "template_news.php"; ?>
  </div>
  <div class = "container" style = "padding-left: 10px;">
    <?php require_once "template_events.php"; ?>
  </div>
</div>

<?php
  require_once "template_banner.php";
  require_once "template_footer.php";
  require_once "template_bottom.php";
?>
<style>
  .footer 
  {
    background: #cecece;
  } 

  div.marquee
  {
    width: 1020px;
    height: 30px;
    font-size: 20px;
    line-height: 30px;
    background:#17476f;    
    border-bottom: 1px solid #dddddd;
    border-top: 1px solid #dddddd;
    box-shadow:0px 5px 5px 3px rgba(0,0,0,0.3);
    text-shadow:0 0 30px #fff, 0 0 70px #00BFFF;
    color: yellow;
    overflow: hidden;
  }
</style>
<SCRIPT type="text/javascript">
  // Количество снежинок на странице (Ставьте в границах 30-40, больше не рекомендую)
  var snowmax = 40;
   
  // Установите цвет снега, добавьте столько цветов сколько пожелаете
  var snowcolor = new Array("#AAAACC","#DDDDFF","#CCCCDD","#F3F3F3","#F0FFFF","#FFFFFF","#EFF5FF")
   
  // Шрифты, из которых будет создана снежинка ставьте столько шрифтом сколько хотите
  var snowtype = new Array("Arial Black","Arial Narrow","Times","Comic Sans MS");
   
  // Символ из какого будут сделаны снежинки (по умолчанию * )
  var snowletter = "*";
   
  // Скорость падения снега (рекомендую в границах от 0.3 до 2)
  var sinkspeed = 0.6; 
   
  // Максимальный размер снежинки
  var snowmaxsize = 22;
   
  // Минимальный размер снежинки
  var snowminsize = 8;
   
  // Устанавливаем положение снега
  // 1 - снег по всему сайту
  // 2 - только слева 
  // 3 только по центру 
  // 4 снег справа
  var snowingzone = 1;   
  
    var snow=new Array();
    var marginbottom;
    var marginright;
    var timer;
    var i_snow=0;
    var x_mv=new Array();
    var crds=new Array();
    var lftrght=new Array();
    var browserinfos=navigator.userAgent;
    var ie5=document.all&&document.getElementById&&!browserinfos.match(/Opera/);
    var ns6=document.getElementById&&!document.all;
    var opera=browserinfos.match(/Opera/);
    var browserok=ie5||ns6||opera;
    function randommaker(range) {
      rand=Math.floor(range*Math.random());
      return rand;
    }
    function initsnow() {
      if (ie5 || opera) {
        marginbottom=document.body.clientHeight;
        marginright=document.body.clientWidth;
      }
      else if (ns6) {
        marginbottom=window.innerHeight;
        marginright=window.innerWidth;
      }
      var snowsizerange=snowmaxsize-snowminsize;
      for (i=0;i<=snowmax;i++) {
        crds[i]=0;
        lftrght[i]=Math.random()*15;
        x_mv[i]=0.03+Math.random()/10;
        snow[i]=document.getElementById("s"+i);
        snow[i].style.fontFamily=snowtype[randommaker(snowtype/length)];
        snow[i].size=randommaker(snowsizerange)+snowminsize;
        snow[i].style.fontSize=snow[i].size+"px";
        snow[i].style.color=snowcolor[randommaker(snowcolor.length)];
        snow[i].sink=sinkspeed*snow[i].size/5;
        if (snowingzone==1) {snow[i].posx=randommaker(marginright-snow[i].size)}
        if (snowingzone==2) {snow[i].posx=randommaker(marginright/2-snow[i].size)}
        if (snowingzone==3) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/4}
        if (snowingzone==4) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/2}
        snow[i].posy=randommaker(2*marginbottom-marginbottom-2*snow[i].size);
        snow[i].style.left=snow[i].posx+"px";
        snow[i].style.top=snow[i].posy+"px";
      }
      movesnow();
    }
    function movesnow() {
      for(i=0;i<=snowmax;i++) {
        crds[i]+=x_mv[i];
        snow[i].posy+=snow[i].sink;
        snow[i].style.left=snow[i].posx+lftrght[i]*Math.sin(crds[i])+"px";
        snow[i].style.top=snow[i].posy+"px";
        if (snow[i].posy>=marginbottom-2*snow[i].size || parseInt(snow[i].style.left)>(marginright-3*lftrght[i])) {
          if (snowingzone==1) {snow[i].posx=randommaker(marginright-snow[i].size)}
          if (snowingzone==2) {snow[i].posx=randommaker(marginright/2-snow[i].size)}
          if (snowingzone==3) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/4}
          if (snowingzone==4) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/2}
          snow[i].posy=0;
        }
      }
      var timer=setTimeout("movesnow()",50);
    }
    for (i=0;i<=snowmax;i++) {
      document.write("<span id='s"+i+"' style='position:absolute;top:-"+snowmaxsize+"px;'>"+snowletter+"</span>");
    }
    if (browserok) {
      window.onload=initsnow;
    }
    </SCRIPT>