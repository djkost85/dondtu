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
      <a href = "." id = "header" style = "margin-left: 220px;">ДОНБАССКИЙ ГОСУДАРСТВЕННЫЙ ТЕХНИЧЕСКИЙ УНИВЕРСИТЕТ</a>
      <?php 
        if(!strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
        {
      ?>
      <span class = "NewYear" style = "margin-left: 260px;">b</span>
      <?php } ?>
      <div id = "lang">
        <a href = "../ua/<?=$page;?>" title = "Украинский">
          <img src = "../images/lang/ua.jpg" />
        </a>
        <a href = "../ru/<?=$page;?>" title = "Русский">
          <img src = "../images/lang/ru.jpg" />
        </a>    
        <a href = "../en/<?=$page;?>" title = "Английский">
          <img src = "../images/lang/gb.jpg" />
        </a>
      </div>

      <ul class = "menu">
        <li class = "menu-item">
          <a href = "history.php">Об университете</a>
          <ul class = "smenu">
            <li class = "smenu-item"><a href = "history.php">История</a></li>
            <li class = "smenu-item"><a href = "administration.php">Ректорат</a></li>
            <li class = "smenu-item">
              <a href = "default.php">Ученый Совет</a>
              <ul class = "ssmenu">
                <li class = "ssmenu-item"><a href = "scientific_Council_composition.php">Состав</a></li>
                <li class = "ssmenu-item"><a href = "scientific_Council_plan.php">План работы 2013-2014</a></li>
              </ul>
            </li>
            <li class = "smenu-item">
              <a href = "default.php">Учебно-методический совет</a>
              <ul class = "ssmenu">
                <li class = "ssmenu-item"><a href = "training_and_methodology_committee.php">Состав</a></li>
                <li class = "ssmenu-item"><a href = "default.php">План работы 2013-2014</a></li>
                <li class = "ssmenu-item"><a href = "coordinators.php">Координаторы ECTS</a></li>
              </ul>
            </li>
            <li class = "smenu-item"><a href = "public_information.php">Доступ к публичной информации</a></li>
            <li class = "smenu-item"><a href = "gos_zakupki.php">Государственные закупки</a></li>
          </ul>
        </li>

        <li class = "menu-item">
          <a href = "selection_committee.php">Абитуриенту</a>
          <ul class = "smenu">
            <li class = "smenu-item"><a href = "selection_commission.php">Приемная комиссия</a></li>
            <li class = "smenu-item"><a href = "foreign_students_department.php">Отдел по работе с иностранными студентами</a></li>
            <li class = "smenu-item"><a href = "pk_postdegree_education.php">Центр последипломного образования</a></li>
            <li class = "smenu-item"><a href = "default.php">Довузовская подготовка</a></li>
            <li class = "smenu-item"><a href = "pk_consalting_point.php">Консультационный пункт ВНО</a></li>
          </ul>
        </li>
        <li class = "menu-item">
          <a href = "selection_committee.php">Студенту</a>
          <ul class = "smenu">
            <li class = "smenu-item"><a href = "ckid.php">ЦК и Д "Талант"</a></li>
            <li class = "smenu-item"><a href = "default.php">Газета "Импульс"</a></li>
            <li class = "smenu-item"><a href = "default.php">Спортивные новости</a></li>
            <li class = "smenu-item"><a href = "sstvis.php">Трудоустройство</a></li>
            <li class = "smenu-item"><a href = "contests.php">Конкурсы</a></li>
            <li class = "smenu-item"><a href = "../forum">Гостевая книга</a></li>
          </ul>
        </li>
        <li class = "menu-item">
          <a href = "structure.php">Структура</a>
          <ul class = "smenu">
            <li class = "smenu-item">
              <a href = "default.php">Факультеты</a>
              <ul class = "ssmenu">
                <li class = "ssmenu-item"><a href = "st_mining_faculty.php">Горный факультет</a></li>
                <li class = "ssmenu-item"><a href = "st_metallurgy_faculty.php">Факультет металлургии</a></li>
                <li class = "ssmenu-item"><a href = "st_construction_faculty.php">Строительный факультет</a></li>
                <li class = "ssmenu-item"><a href = "st_mechanics_faculty.php">Факультет механики</a></li>
                <li class = "ssmenu-item"><a href = "st_AES_faculty.php">Факультет АЭС</a></li>
                <li class = "ssmenu-item"><a href = "st_economics_and_finance_faculty.php">Факультет экономики и финансов</a></li>
                <li class = "ssmenu-item"><a href = "st_managment_faculty.php">Факультет менеджмента</a></li>
              </ul>
            </li>
            <li class = "smenu-item">
              <a href = "default.php">Филиалы</a>
              <ul class = "ssmenu">
                <li class = "ssmenu-item"><a href = "st_branch_enakievo.php">Енакиевский филиал</a></li>
                <li class = "ssmenu-item"><a href = "st_branch_krasniyluch.php">Краснолуцкий филиал</a></li>
                <li class = "ssmenu-item"><a href = "st_branch_rovenki.php">Ровеньковский филиал</a></li>
                <li class = "ssmenu-item"><a href = "st_branch_lisichansk.php">Лисичанский филиал</a></li>
                <li class = "ssmenu-item"><a href = "st_branch_sverdlovsk.php">Свердловский филиал</a></li>
                <li class = "ssmenu-item"><a href = "st_branch_pervomaisk.php">Первомайский филиал</a></li>
                <li class = "ssmenu-item"><a href = "st_branch_krasnodon.php">Краснодонский филиал</a></li>
              </ul>
            </li>
            <li class = "smenu-item"><a href = "default.php">Техникумы</a>
              <ul class = "ssmenu">
                <li class = "ssmenu-item"><a href = "http://alit.16mb.com/tekhnikum/zagalna-informatsiya.html">Индустриальный техникум</a></li>
                <li class = "ssmenu-item"><a href = "default.php">Перевальский техникум</a></li>
              </ul>
            </li>
            <li class = "smenu-item"><a href = "st_college.php">Колледж</a></li>
            <li class = "smenu-item">
              <a href = "default.php">Другие подразделения</a>
              <ul class = "ssmenu">
                <li class = "ssmenu-item"><a href = "oi.php">Информационный отдел</a></li>
                <li class = "ssmenu-item"><a href = "ivc.php">Информационно-вычислительный центр</a></li>
                <li class = "ssmenu-item"><a href = "department_of_the_international_relations.php">Отдел международного сотрудничества</a></li>
                <li class = "ssmenu-item"><a href = "foreign_students_department.php">Отдел по работе с иностранными студентами</a></li>
                <li class = "ssmenu-item"><a href = "lado.php">Издательство "ЛАДО"</a></li>
              </ul>
            </li>
            <li class = "smenu-item">
              <a href = "default.php">Общественные организации</a>
              <ul class = "ssmenu">
                <li class = "ssmenu-item"><a href = "http://www.studprofkom.dmmi.edu.ua/">Профком студентов</a></li>
                <li class = "ssmenu-item"><a href = "http://profkom.dmmi.edu.ua/">Профком преподавателей</a></li>
                <li class = "ssmenu-item"><a href = "default.php">Студенческое самоуправление</a></li>
              </ul>
            </li>
            <li class = "smenu-item"><a href = "library.php">Научная библиотека</a></li>
          </ul>
        </li>

        <li class = "menu-item">
          <a href = "science.php">Наука</a>
          <ul class = "smenu">
            <li class = "smenu-item"><a href = "nich.php">Научно-исследовательская часть</a></li>
            <li class = "smenu-item">
              <a href = "research_units.php">Научные подразделения</a>
              <ul class = "ssmenu">
                <li class = "ssmenu-item"><a href = "parametr.php">НИПКИ "Параметр"</a></li>
              </ul>
            </li>            
            <li class = "smenu-item"><a href = "research.php">Направления научных исследований</a></li>
            <li class = "smenu-item"><a href = "sc_development.php">Научные разработки</a></li>
            <li class = "smenu-item"><a href = "sc_services.php">Научно-технические услуги</a></li>
            <li class = "smenu-item"><a href = "sc_collection.php">Сборник научных трудов</a></li>
            <li class = "smenu-item"><a href = "sc_conferences.php">Научные конференции ДонГТУ</a></li>
            <li class = "smenu-item"><a href = "specialized_scientific_committee.php">Специализированный ученый совет</a></li>
            <li class = "smenu-item"><a href = "council_of_young_scientists.php">Совет молодых ученых</a></li>
            <li class = "smenu-item"><a href = "sc_mono.php">Авторские работы</a></li>
            <li class = "smenu-item"><a href = "sc_partner.php">Наши партнеры</a></li>
          </ul>
        </li>

        <li class = "menu-item">
          <a href = "default.php">Наши сайты</a>
          <ul class = "smenu" style = "margin-left: -200px; width: 520px;">   
          <li style = "height: auto;">
            <ul class = "menu-column">
              <li class = "smenu-item"><a href = "http://library.dmmi.edu.ua/">Научная библиотека</a></li>
              <li class = "smenu-item"><a href = "http://do.dmmi.edu.ua/">Дистанционное обучение</a></li>
              <li class = "smenu-item"><a href = "http://www.ita.dmmi.edu.ua/">IT-академия ДонГТУ</a></li>
              <li class = "smenu-item"><a href = "http://ivc.lan/">Сайт ИВЦ</a></li>
              <li class = "smenu-item"><a href = "http://alit.16mb.com/">Индустриальный техникум</a></li>            
              <li class = "smenu-item"><a href = "http://www.studprofkom.dmmi.edu.ua/">Профком студентов</a></li>
              <li class = "smenu-item"><a href = "http://profkom.dmmi.edu.ua/">Профком преподавателей</a></li>
              <li class = "smenu-item"><a href = "http://www.testlado.com.ua/">Издательство "ЛАДО"</a></li>
            </ul>
            <ul class = "menu-column">
              <li class = "department">Факультет экономики и финансов</li>
              <li class = "smenu-item"><a href = "http://sgd.webuda.com/">Кафедра СГД</a></li>
              <li class = "smenu-item"><a href = "http://oblik-dondtu.com.ua/">Кафедра учета и аудита</a></li>
              <li class = "smenu-item"><a href = "http://ekit.lg.ua/">Кафедра экономической кибернетики</a></li>  
              <li class = "department">Факультет менеджмента</li>
              <li class = "smenu-item"><a href = "http://kafman.at.ua/">Кафедра менеджмента</a></li>    
              <li class = "smenu-item"><a href = "http://manved.at.ua/">Кафедра МВД</a></li> 
              <li class = "smenu-item"><a href = "http://kafedrampf.ucoz.ru/">Кафедра ТППИЯ</a></li> 
            </ul>
          </li>            
          <li>
            <ul class = "menu-column">
              <li class = "department">Факультет АЭС</li>
              <li class = "smenu-item"><a href = "http://scs.dmmi.edu.ua/">Кафедра СКС</a></li>
              <li class = "smenu-item"><a href = "http://es.dmmi.edu.ua/">Кафедра ЭС</a></li>  
              <li class = "smenu-item"><a href = "http://aems.dmmi.edu.ua/">Кафедра АЭС</a></li>
              <li class = "smenu-item"><a href = "http://www.autp.incity.in.ua/">Кафедра АУТП</a></li>
            </ul>
             <ul class = "menu-column">
              <li class = "department">Факультет механики</li>
              <li class = "smenu-item"><a href = "http://mechanika.dondtu.lg.ua/kafedry-fakulteta/tomp">Кафедра ТОМП</a></li>
              <li class = "smenu-item"><a href = "http://mechanika.dondtu.lg.ua/kafedry-fakulteta/pgm">Кафедра ПГМ</a></li>
              <li class = "smenu-item"><a href = "http://mechanika.dondtu.lg.ua/kafedry-fakulteta/mmk-i-pm">Кафедра ММК и ПМ</a></li>            
              <li class = "smenu-item"><a href = "http://mechanika.dondtu.lg.ua/kafedry-fakulteta/gemio">Кафедра ГЭМ и О</a></li> 
            </ul>
          </li>  
          <li>
            <ul class = "menu-column">
              <li class = "department">Факультет металлургии</li>
              <li class = "smenu-item"><a href = "../chemistry">Кафедра ОМиХ</a></li>
              <li class = "smenu-item"><a href = "http://donstusportedu.blogspot.com/" style = "font-size: 11px;">Физическое воспитание студентов ДонГТУ</a></li>   
            </ul>
             <ul class = "menu-column">
              <li class = "department">Горный факультет</li>
              <li class = "smenu-item"><a href = "http://sggs-donstu.ucoz.ru/">Кафедра строительных геотехнологий</a></li>  
              <li class = "smenu-item"><a>&nbsp;</a></li>
            </ul>
          </li>   
        </ul>
       </li>
      </ul>