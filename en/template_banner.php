<link type = "text/css" rel = "stylesheet" href = "../style/banner.css" />

<div class = "banners">
  <div class = "images" style = "overflow: hidden;">
      <div class = "banner_columns monbanners" style = "width: 220px; margin-right: 20px;">
        <h5>Корисні посилання</h5>
        <a href = "sc_development.php">
          <img src = "../images/content/banners/b_science_ua.png" title = "Наукові розробки університету" />
        </a>
        <a href = "http://www.mon.gov.ua/" target="_blank">
          <img src = "../images/content/banners/Mon_Baner.jpg" title = "Міністерство освіти і науки України" />
        </a>
        <a href = "http://vnz.org.ua/" target="_blank">
          <img src = "../images/content/banners/vnz.jpg" title = "Вища освіта" />
        </a>
        <a href = "http://www.osvita.com/" target="_blank">
          <img src = "../images/content/banners/osvvstup.gif" title = "Єдине освітнє інформаційне вікно України" />
        </a>
        <a href = "http://alit.16mb.com/" target="_blank">
          <img src = "../images/content/banners/itdongtu.png" title = "Алчевський індустріальний технікум ДонДТУ" />
        </a>
        <a href = "http://testportal.gov.ua/" target="_blank">
          <img src = "../images/content/banners/cok.gif" title = "Український центр оцінювання якості освіти" />
        </a>
        <a href = "http://pedpresa.com.ua/" target="_blank">
          <img src = "../images/content/banners/pedpress.gif" title = "Освітній портал ПедПРЕСА" />
        </a>
      </div>
      <!--
      <div class = "banner_columns missdongtu" style = "width: 410px; margin-right: 20px;">
        <h5>Голосування "Міс ДонДТУ 2013"</h5> 
          <?php 
          //$names = array("Аль-Кабаб Амаль ТОМ-13", "Бакунова Катерина МЧМ-12", "Казак Аліна ФП-13-1", "Піскун Анастасія СКС-13", "Мухіна Ольга ФП-11-1", "Кустова Євгенія ПР-13", "Ковальова Ксенія ТОМ-10-2", "Стасенко Наталя БХА-13");
          //$j = 0;
          for($i = 1; $i <= 24; $i+=3) {?>
            <a href = "missDonGTU.php">
              <img src = "../images/missdongtu/<?=$i?>.jpg" title = "<?=$names[$j++];?>" />
            </a>
           <?php }?>
      </div>
      -->
      <div class = "banner_columns" style = "margin-left: 435px;">
        <h5>Ми вконтакте</h5>
        <script type = "text/javascript" src = "//vk.com/js/api/openapi.js?105"></script>
        <div id = "vk_groups" style = "margin-top: 4px;"></div>
        <script type = "text/javascript">
          VK.Widgets.Group("vk_groups", {
            mode: 0,
            width: "280",
            color1: "F2F2F2",
            color2: "2B587A",
            color3: "5B7FA6"
          }, 1823100);
        </script>
      </div>

  </div>

  <style>

  .monbanners a img
  {
    width: 100px;
  }

  .missdongtu img 
  {
    height: 139px;
  }

  </style>