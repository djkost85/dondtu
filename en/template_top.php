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
    <title>DonSTU</title>
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
    <style>
      li.menu-item a 
      {
        padding: 0px 12px;
      }
    </style>
  </head>
  <body><center>
    <div id = "content">
      <img src = "../images/header.png" style = "border: none; margin: 0px; padding: 0px;" />
      <a href = "." id = "emblem">
        <img src = "../images/emblem.png" />
      </a>
      <a href = "." id = "header" style = "margin-left: 260px;">Donbass State Technical University</a> 
      <?php 
        if(!strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
        {
      ?>
      <span class = "NewYear" style = "margin-left: 140px;">b</span>
      <?php } ?>
      <div id = "lang">
        <a href = "../ua/<?=$page;?>" title = "Ukraine">
          <img src = "../images/lang/ua.jpg" />
        </a>
        <a href = "../ru/<?=$page;?>" title = "Russian">
          <img src = "../images/lang/ru.jpg" />
        </a>    
        <a href = "../en/<?=$page;?>" title = "English">
          <img src = "../images/lang/gb.jpg" />
        </a>
      </div>
      <ul class = "menu">
        <li class = "menu-item">
          <a href = "history.php">About University</a>
          <ul class = "smenu">
            <li class = "smenu-item"><a href = "history.php">History</a></li>
            <li class = "smenu-item"><a href = "administration.php">Rectorate</a></li>
            <li class = "smenu-item">
              <a href = "default.php">The Academic Council</a>
              <ul class = "ssmenu">
                <li class = "ssmenu-item"><a href = "scientific_Council_composition.php">Composition</a></li>
                <li class = "ssmenu-item"><a href = "scientific_Council_plan.php">Working plan 2013-2014</a></li>
              </ul>
            </li>
            <li class = "smenu-item">
              <a href = "default.php">Educational and Methodological Council</a>
              <ul class = "ssmenu">
                <li class = "ssmenu-item"><a href = "training_and_methodology_committee.php">Composition</a></li>
                <li class = "ssmenu-item"><a href = "default.php">Working plan 2013-2014</a></li>
                <li class = "ssmenu-item"><a href = "coordinators.php">Coordinators ECTS</a></li>
              </ul>
            </li>
            <li class = "smenu-item"><a href = "public_information.php">Access to public information</a></li>
            <li class = "smenu-item"><a href = "gos_zakupki.php">State procurements</a></li>
          </ul>
        </li>

        <li class = "menu-item">
          <a href = "selection_committee.php">Information for Admission</a>
          <ul class = "smenu">
	          <li class = "smenu-item"><a href = "selection_commission.php">Admission committee</a></li>
        <li class = "smenu-item"><a href = "pk_postdegree_education.php">Center for Second Higher Education</a></li>
			  <li class = "smenu-item"><a href = "foreign_students_department.php">Department of foreign students</a></li>
        <li class = "smenu-item"><a href = "default.php">Pre-university training</a></li>
			  <li class = "smenu-item"><a href = "pk_consalting_point.php">Consulting center of Unified independent testing</a></li>
          </ul>
        </li>
        <li class = "menu-item">
          <a href = "selection_committee.php">Students</a>
          <ul class = "smenu">
            <li class = "smenu-item"><a href = "ckid.php">Centre of culture and leisure "Talant"</a></li>
            <li class = "smenu-item"><a href = "default.php">Newspaper "Impuls"</a></li>
            <li class = "smenu-item"><a href = "default.php">Sport</a></li>
            <li class = "smenu-item"><a href = "sstvis.php">Employment of students</a></li>
            <li class = "smenu-item"><a href = "contests.php">Contests</a></li>
            <li class = "smenu-item"><a href = "../forum">Forum</a></li>
          </ul>
        </li>
        <li class = "menu-item">
          <a href = "structure.php">Structure</a>
          <ul class = "smenu">
            <li class = "smenu-item">
              <a href = "default.php">Faculties</a>
              <ul class = "ssmenu">
                <li class = "ssmenu-item"><a href = "st_mining_faculty.php">Mining faculty</a></li>
                <li class = "ssmenu-item"><a href = "st_metallurgy_faculty.php">Metallurgical faculty</a></li>
                <li class = "ssmenu-item"><a href = "st_construction_faculty.php">Faculty of civil engineering</a></li>
                <li class = "ssmenu-item"><a href = "st_mechanics_faculty.php">Mechanics faculty</a></li>
                <li class = "ssmenu-item"><a href = "st_AES_faculty.php">AES faculty</a></li>
                <li class = "ssmenu-item"><a href = "st_economics_and_finance_faculty.php">Faculty of economics and finance</a></li>
                <li class = "ssmenu-item"><a href = "st_managment_faculty.php">Management faculty</a></li>
              </ul>
            </li>
            <li class = "smenu-item">
              <a href = "default.php">Branches</a>
              <ul class = "ssmenu">
                <li class = "ssmenu-item"><a href = "st_branch_enakievo.php">Branch of Yenakiieve</a></li>
                <li class = "ssmenu-item"><a href = "st_branch_krasniyluch.php">Branch of Krasnyi Luch</a></li>
                <li class = "ssmenu-item"><a href = "st_branch_rovenki.php">Branch of Rovenky</a></li>
                <li class = "ssmenu-item"><a href = "st_branch_lisichansk.php">Branch of Lysychansk</a></li>
                <li class = "ssmenu-item"><a href = "st_branch_sverdlovsk.php">Branch of Sverdlovsk</a></li>
                <li class = "ssmenu-item"><a href = "st_branch_pervomaisk.php">Branch of Pervomaysk</a></li>
                <li class = "ssmenu-item"><a href = "st_branch_krasnodon.php">Branch of Krasnodon</a></li>
              </ul>
            </li>
            <li class = "smenu-item"><a href = "default.php">Technical Schools</a>
              <ul class = "ssmenu">
                <li class = "ssmenu-item"><a href = "http://alit.16mb.com/tekhnikum/zagalna-informatsiya.html">Industrial Technical School</a></li>
                <li class = "ssmenu-item"><a href = "default.php">Perevalsk Technical School</a></li>
              </ul>
            </li>
            <li class = "smenu-item"><a href = "st_college.php">College</a></li>
            <li class = "smenu-item">
              <a href = "default.php">Other departments</a>
              <ul class = "ssmenu">
                <li class = "ssmenu-item"><a href = "oi.php">Information department</a></li>
                <li class = "ssmenu-item"><a href = "ivc.php">The Computer Office</a></li>
                <li class = "ssmenu-item"><a href = "department_of_the_international_relations.php">International Affairs Office</a></li>
                <li class = "ssmenu-item"><a href = "foreign_students_department.php">Department of foreign students</a></li>
                <li class = "ssmenu-item"><a href = "lado.php">Publishing house "LADO"</a></li>
              </ul>
            </li>
            <li class = "smenu-item">
              <a href = "default.php">Public organizations</a>
              <ul class = "ssmenu">
                <li class = "ssmenu-item"><a href = "http://www.studprofkom.dmmi.edu.ua/">Students’ union</a></li>
                <li class = "ssmenu-item"><a href = "http://profkom.dmmi.edu.ua/">University trade union</a></li>
                <li class = "ssmenu-item"><a href = "default.php">Students self-government</a></li>
              </ul>
            </li>
            <li class = "smenu-item"><a href = "library.php">Scientific Library</a></li>
          </ul>
        </li>

        <li class = "menu-item">
          <a href = "science.php">Science</a>
          <ul class = "smenu">
            <li class = "smenu-item"><a href = "nich.php">Scientific and Research Department</a></li>
            <li class = "smenu-item">
              <a href = "research_units.php">Science subdivisions</a>
              <ul class = "ssmenu">
                <li class = "ssmenu-item"><a href = "parametr.php">SRDI «Parametr»</a></li>
              </ul>
            </li>
            <li class = "smenu-item"><a href = "research.php">Directions of scientific research</a></li>
            <li class = "smenu-item"><a href = "sc_development.php">Scientific developments</a></li>
            <li class = "smenu-item"><a href = "sc_services.php">Scientific and technical services</a></li>
            <li class = "smenu-item"><a href = "sc_collection.php">Bulletin of scientific works</a></li>
            <li class = "smenu-item"><a href = "sc_conferences.php">Scientific conferences of DonSTU</a></li>
            <li class = "smenu-item"><a href = "specialized_scientific_committee.php">Specialized scientific council</a></li>
            <li class = "smenu-item"><a href = "council_of_young_scientists.php">Council of young scientists</a></li>
            <li class = "smenu-item"><a href = "sc_mono.php">Author’s works</a></li>
            <li class = "smenu-item"><a href = "sc_partner.php">Our partners</a></li>
          </ul>
        </li>
        <li class = "menu-item">
          <a href = "default.php">Our sites</a>
          <ul class = "smenu" style = "margin-left: -200px; width: 520px;">   
          <li style = "height: auto;">
            <ul class = "menu-column">
              <li class = "smenu-item"><a href = "http://library.dmmi.edu.ua/">Scientific Library</a></li>
              <li class = "smenu-item"><a href = "http://do.dmmi.edu.ua/">Distance education</a></li>
              <li class = "smenu-item"><a href = "http://www.ita.dmmi.edu.ua/">IT-academy of DonSTU</a></li>
              <li class = "smenu-item"><a href = "http://ivc.lan/">The Computer Office site </a></li>
              <li class = "smenu-item"><a href = "http://alit.16mb.com/">Industrial Technical School</a></li>            
              <li class = "smenu-item"><a href = "http://www.studprofkom.dmmi.edu.ua/">Students’ union</a></li>
              <li class = "smenu-item"><a href = "http://profkom.dmmi.edu.ua/">University trade union</a></li>
              <li class = "smenu-item"><a href = "http://www.testlado.com.ua/">Publishing house "LADO"</a></li>
            </ul>
            <ul class = "menu-column">
              <li class = "department">Faculty of economics and finance</li>
              <li class = "smenu-item"><a href = "http://sgd.webuda.com/">Chair of Socio-humanitarian disciplines</a></li>
              <li class = "smenu-item"><a href = "http://oblik-dondtu.com.ua/">Chair of accounting and auditing</a></li>
              <li class = "smenu-item"><a href = "http://ekit.lg.ua/">Chair of economic cybernetics and IT</a></li>  
              <li class = "department">Management faculty</li>
              <li class = "smenu-item"><a href = "http://kafman.at.ua/">Management Chair</a></li>    
              <li class = "smenu-item"><a href = "http://manved.at.ua/">Chair of FEA management </a></li> 
              <li class = "smenu-item"><a href = "http://kafedrampf.ucoz.ru/">Chair of TTPFL</a></li> 
            </ul>
          </li>            
          <li>
            <ul class = "menu-column">
              <li class = "department">AES faculty</li>
              <li class = "smenu-item"><a href = "http://scs.dmmi.edu.ua/">Chair of SCS</a></li>
              <li class = "smenu-item"><a href = "http://es.dmmi.edu.ua/">Chair of ES</a></li>  
              <li class = "smenu-item"><a href = "http://aems.dmmi.edu.ua/">Chair of AES</a></li>
              <li class = "smenu-item"><a href = "http://www.autp.incity.in.ua/">Chair of ACTP</a></li>
            </ul>
             <ul class = "menu-column">
              <li class = "department">Mechanics faculty</li>
              <li class = "smenu-item"><a href = "http://mechanika.dondtu.lg.ua/kafedry-fakulteta/tomp">Chair of TOEP</a></li>
              <li class = "smenu-item"><a href = "http://mechanika.dondtu.lg.ua/kafedry-fakulteta/pgm">Chair of AHME </a></li>
              <li class = "smenu-item"><a href = "http://mechanika.dondtu.lg.ua/kafedry-fakulteta/mmk-i-pm">Chair of MCMAM</a></li>            
              <li class = "smenu-item"><a href = "http://mechanika.dondtu.lg.ua/kafedry-fakulteta/gemio">Chair of MEME</a></li> 
            </ul>
          </li>  
          <li>
            <ul class = "menu-column">
              <li class = "department">Metallurgical faculty</li>
              <li class = "smenu-item"><a href = "../chemistry">Chair of general metallurgy and chemistry</a></li>
              <li class = "smenu-item"><a href = "http://donstusportedu.blogspot.com/" style = "font-size: 12px;">Physical education of students in DonSTU</a></li>   
            </ul>
             <ul class = "menu-column">
              <li class = "department">Mining faculty</li>
              <li class = "smenu-item"><a href = "http://sggs-donstu.ucoz.ru/">Chair of building geological technologies</a></li>  
              <li class = "smenu-item"><a>&nbsp;</a></li>
            </ul>
          </li>   
        </ul>
       </li>
      </ul>