<?php
  $address = $_SERVER["REQUEST_URI"];
  foreach (array("/ua/", "/ru/", "/en/") as $lang)
    if ($index = strpos($address, $lang))
      break;
  $page = substr($address, $index + 4);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>ДонГТУ</title>
    <meta charset = "utf-8" />
    <link rel="shortcut icon" href = "../images/favicon.ico" type = "image/x-icon">
    <link type = "text/css" rel = "stylesheet" href = "../style/main.css" />
    <script type = "text/javascript" src = "../scripts/jquery-1.9.1.min.js"></script>
    <script type = "text/javascript" src = "../scripts/menu.js"></script>
    <script type = "text/javascript" src = "../scripts/gallery.js"></script>
    <script type = "text/javascript" src = "../scripts/jquery-timers.js"></script>
    
    <link type = "text/css" rel = "stylesheet" href = "../lightbox/css/lightbox.css" />
    <script type = "text/javascript" src = "../lightbox/js/lightbox-2.6.min.js"></script>

    <script type = "text/javascript" src = "../ckeditor/ckeditor.js"></script>
    <script type = "text/javascript">
      CKEDITOR.ENTER_BR = 1;
    </script>
  </head>
  <body><center>
    <div id = "content">
      <img src = "../images/header.png" style = "border: none; margin: 0px; padding: 0px;" />
      <a href = "." id = "emblem">
        <img src = "../images/emblem.png" />
      </a>
      <a href = "." id = "header" style = "margin-left: 260px;">ДОНБАСЬКИЙ ДЕРЖАВНИЙ ТЕХНІЧНИЙ УНІВЕРСИТЕТ</a> 
      <?php 
        if(!strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
        {
      ?>
      <span class = "NewYear" style = "margin-left: 200px;">b</span>
      <?php } ?>
      <div id = "lang">
        <a href = "../ua/<?=$page;?>" title = "Українська">
          <img src = "../images/lang/ua.jpg" />
        </a>
        <a href = "../ru/<?=$page;?>" title = "Російська">
          <img src = "../images/lang/ru.jpg" />
        </a>    
        <a href = "../en/<?=$page;?>" title = "Англійська">
          <img src = "../images/lang/gb.jpg" />
        </a>
      </div>
      <ul class = "menu">
        <li class = "menu-item">
          <a href = "history.php">Про університет</a>
          <ul class = "smenu">
            <li class = "smenu-item"><a href = "history.php">Історія</a></li>
            <li class = "smenu-item"><a href = "administration.php">Ректорат</a></li>
            <li class = "smenu-item">
              <a href = "default.php">Вчена Рада</a>
              <ul class = "ssmenu">
                <li class = "ssmenu-item"><a href = "scientific_Council_composition.php">Склад</a></li>
                <li class = "ssmenu-item"><a href = "scientific_Council_plan.php">План роботи 2013-2014</a></li>
              </ul>
            </li>
            <li class = "smenu-item">
              <a href = "default.php">Навчально-методична рада</a>
              <ul class = "ssmenu">
                <li class = "ssmenu-item"><a href = "training_and_methodology_committee.php">Склад</a></li>
                <li class = "ssmenu-item"><a href = "default.php">План роботи 2013-2014</a></li>
                <li class = "ssmenu-item"><a href = "coordinators.php">Координатори ECTS</a></li>
              </ul>
            </li>
            <li class = "smenu-item"><a href = "public_information.php">Доступ до публічної інформації</a></li>
            <li class = "smenu-item"><a href = "gos_zakupki.php">Державні закупівлі</a></li>
          </ul>
        </li>

        <li class = "menu-item">
          <a href = "selection_committee.php">Абітурієнту</a>
          <ul class = "smenu">
	          <li class = "smenu-item"><a href = "selection_commission.php">Приймальна комісія</a></li>
			  <li class = "smenu-item"><a href = "foreign_students_department.php">Відділ по роботі з іноземними студентами</a></li>
			  <li class = "smenu-item"><a href = "pk_postdegree_education.php">Центр післядипломної освіти</a></li>
			  <li class = "smenu-item"><a href = "default.php">Довузівська підготовка</a></li>
			  <li class = "smenu-item"><a href = "pk_consalting_point.php">Консультаційний пункт ЗНО</a></li>
          </ul>
        </li>
        <li class = "menu-item">
          <a href = "selection_committee.php">Студенту</a>
          <ul class = "smenu">
            <li class = "smenu-item"><a href = "ckid.php">ЦК та Д "Талант"</a></li>
            <li class = "smenu-item"><a href = "default.php">Газета "Імпульс"</a></li>
            <li class = "smenu-item"><a href = "default.php">Спорт</a></li>
            <li class = "smenu-item"><a href = "sstvis.php">Працевлаштування</a></li>
            <li class = "smenu-item"><a href = "contests.php">Конкурси</a></li>
            <li class = "smenu-item"><a href = "../forum">Гостьова книга</a></li>
          </ul>
        </li>
        <li class = "menu-item">
          <a href = "structure.php">Структура</a>
          <ul class = "smenu">
            <li class = "smenu-item">
              <a href = "default.php">Факультети</a>
              <ul class = "ssmenu">
                <li class = "ssmenu-item"><a href = "st_mining_faculty.php">Факультет гірництва</a></li>
                <li class = "ssmenu-item"><a href = "st_metallurgy_faculty.php">Факультет металургії</a></li>
                <li class = "ssmenu-item"><a href = "st_construction_faculty.php">Будівельний факультет</a></li>
                <li class = "ssmenu-item"><a href = "st_mechanics_faculty.php">Факультет механіки</a></li>
                <li class = "ssmenu-item"><a href = "st_AES_faculty.php">Факультет АЕС</a></li>
                <li class = "ssmenu-item"><a href = "st_economics_and_finance_faculty.php">Факультет економіки і фінансів</a></li>
                <li class = "ssmenu-item"><a href = "st_managment_faculty.php">Факультет менеджменту</a></li>
              </ul>
            </li>
            <li class = "smenu-item">
              <a href = "default.php">Філії</a>
              <ul class = "ssmenu">
                <li class = "ssmenu-item"><a href = "st_branch_enakievo.php">Єнакіївська філія</a></li>
                <li class = "ssmenu-item"><a href = "st_branch_krasniyluch.php">Краснолуцька філія</a></li>
                <li class = "ssmenu-item"><a href = "st_branch_rovenki.php">Ровеньківська філія</a></li>
                <li class = "ssmenu-item"><a href = "st_branch_lisichansk.php">Лисичанська філія</a></li>
                <li class = "ssmenu-item"><a href = "st_branch_sverdlovsk.php">Свердловська філія</a></li>
                <li class = "ssmenu-item"><a href = "st_branch_pervomaisk.php">Первомайська філія</a></li>
                <li class = "ssmenu-item"><a href = "st_branch_krasnodon.php">Краснодонська філія</a></li>
              </ul>
            </li>
            <li class = "smenu-item"><a href = "default.php">Технікуми</a>
              <ul class = "ssmenu">
                <li class = "ssmenu-item"><a href = "http://alit.16mb.com/tekhnikum/zagalna-informatsiya.html">Індустріальний технікум</a></li>
                <li class = "ssmenu-item"><a href = "default.php">Перевальський технікум</a></li>
              </ul>
            </li>
            <li class = "smenu-item"><a href = "st_college.php">Коледж</a></li>
            <li class = "smenu-item">
              <a href = "default.php">Інші підрозділи</a>
              <ul class = "ssmenu">
                <li class = "ssmenu-item"><a href = "oi.php">Інформаційний відділ</a></li>
                <li class = "ssmenu-item"><a href = "ivc.php">Інформаційно-обчислювальний центр</a></li>
                <li class = "ssmenu-item"><a href = "department_of_the_international_relations.php">Відділ міжнародного співробітництва</a></li>
                <li class = "ssmenu-item"><a href = "foreign_students_department.php">Відділ по роботi з iноземними студентами</a></li>
                <li class = "ssmenu-item"><a href = "lado.php">Видавництво "ЛАДО"</a></li>
              </ul>
            </li>
            <li class = "smenu-item">
              <a href = "default.php">Громадські організації</a>
              <ul class = "ssmenu">
                <li class = "ssmenu-item"><a href = "http://www.studprofkom.dmmi.edu.ua/">Профком студентів</a></li>
                <li class = "ssmenu-item"><a href = "http://profkom.dmmi.edu.ua/">Профком викладачів</a></li>
                <li class = "ssmenu-item"><a href = "default.php">Студентське самоуправління</a></li>
              </ul>
            </li>
            <li class = "smenu-item"><a href = "library.php">Наукова бібліотека</a></li>
          </ul>
        </li>

        <li class = "menu-item">
          <a href = "science.php">Наука</a>
          <ul class = "smenu">
            <li class = "smenu-item"><a href = "nich.php">Науково-дослідна частина</a></li>
            <li class = "smenu-item">
              <a href = "research_units.php">Наукові підрозділи</a>
              <ul class = "ssmenu">
                <li class = "ssmenu-item"><a href = "parametr.php">НДПКІ "Параметр"</a></li>
              </ul>
            </li>
            <li class = "smenu-item"><a href = "research.php">Напрямки наукових досліджень</a></li>
            <li class = "smenu-item"><a href = "sc_development.php">Наукові розробки</a></li>
            <li class = "smenu-item"><a href = "sc_services.php">Науково-технічні послуги</a></li>
            <li class = "smenu-item"><a href = "sc_collection.php">Збірка наукових праць</a></li>
            <li class = "smenu-item"><a href = "sc_conferences.php">Наукові конференції ДонДТУ</a></li>
            <li class = "smenu-item"><a href = "specialized_scientific_committee.php">Спеціалізована вчена рада</a></li>
            <li class = "smenu-item"><a href = "council_of_young_scientists.php">Рада молодих вчених</a></li>
            <li class = "smenu-item"><a href = "sc_mono.php">Авторські роботи</a></li>
            <li class = "smenu-item"><a href = "sc_partner.php">Наші партнери</a></li>
          </ul>
        </li>
        <li class = "menu-item">
          <a href = "default.php">Наші сайти</a>
          <ul class = "smenu" style = "margin-left: -200px; width: 520px;">   
          <li style = "height: auto;">
            <ul class = "menu-column">
              <li class = "smenu-item"><a href = "http://library.dmmi.edu.ua/">Наукова бібліотека</a></li>
              <li class = "smenu-item"><a href = "http://do.dmmi.edu.ua/">Дистанційне навчання</a></li>
              <li class = "smenu-item"><a href = "http://www.ita.dmmi.edu.ua/">IT-академія ДонДТУ</a></li>
              <li class = "smenu-item"><a href = "http://ivc.lan/">Сайт ІОЦ</a></li>
              <li class = "smenu-item"><a href = "http://alit.16mb.com/">Індустріальний технікум</a></li>            
              <li class = "smenu-item"><a href = "http://www.studprofkom.dmmi.edu.ua/">Профком студентів</a></li>
              <li class = "smenu-item"><a href = "http://profkom.dmmi.edu.ua/">Профком викладачів</a></li>
              <li class = "smenu-item"><a href = "http://www.testlado.com.ua/">Видавництво "ЛАДО"</a></li>
            </ul>
            <ul class = "menu-column">
              <li class = "department">Факультет економіки і фінансів</li>
              <li class = "smenu-item"><a href = "http://sgd.webuda.com/">Кафедра СГД</a></li>
              <li class = "smenu-item"><a href = "http://oblik-dondtu.com.ua/">Кафедра обліку і аудиту</a></li>
              <li class = "smenu-item"><a href = "http://ekit.lg.ua/">Кафедра економічної кібернетики</a></li>  
              <li class = "department">Факультет менеджменту</li>
              <li class = "smenu-item"><a href = "http://kafman.at.ua/">Кафедра менеджменту</a></li>    
              <li class = "smenu-item"><a href = "http://manved.at.ua/">Кафедра МЗД</a></li> 
              <li class = "smenu-item"><a href = "http://kafedrampf.ucoz.ru/">Кафедра ТППІМ</a></li> 
            </ul>
          </li>            
          <li>
            <ul class = "menu-column">
              <li class = "department">Факультет АЕС</li>
              <li class = "smenu-item"><a href = "http://scs.dmmi.edu.ua/">Кафедра СКС</a></li>
              <li class = "smenu-item"><a href = "http://es.dmmi.edu.ua/">Кафедра ЕС</a></li>  
              <li class = "smenu-item"><a href = "http://aems.dmmi.edu.ua/">Кафедра АЕС</a></li>
              <li class = "smenu-item"><a href = "http://www.autp.incity.in.ua/">Кафедра АУТП</a></li>
            </ul>
             <ul class = "menu-column">
              <li class = "department">Факультет механіки</li>
              <li class = "smenu-item"><a href = "http://mechanika.dondtu.lg.ua/kafedry-fakulteta/tomp">Кафедра ТОМВ</a></li>
              <li class = "smenu-item"><a href = "http://mechanika.dondtu.lg.ua/kafedry-fakulteta/pgm">Кафедра ПГМ</a></li>
              <li class = "smenu-item"><a href = "http://mechanika.dondtu.lg.ua/kafedry-fakulteta/mmk-i-pm">Кафедра ММК і ПМ</a></li>            
              <li class = "smenu-item"><a href = "http://mechanika.dondtu.lg.ua/kafedry-fakulteta/gemio">Кафедра ГЕМІО</a></li> 
            </ul>
          </li>  
          <li>
            <ul class = "menu-column">
              <li class = "department">Факультет металургії</li>
              <li class = "smenu-item"><a href = "../chemistry">Кафедра ЗМіХ</a></li>
              <li class = "smenu-item"><a href = "http://donstusportedu.blogspot.com/">Фізичне виховання студентів ДонДТУ</a></li>   
            </ul>
             <ul class = "menu-column">
              <li class = "department">Факультет гірництва</li>
              <li class = "smenu-item"><a href = "http://sggs-donstu.ucoz.ru/">Кафедра будівельних геотехнологій</a></li>  
              <li class = "smenu-item"><a>&nbsp;</a></li>
            </ul>
          </li>   
        </ul>
       </li>
      </ul>