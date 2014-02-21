<?php
  $str = "<?xml version='1.0' encoding='UTF-8'?><urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation='http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd'>";
  function Scan($name) {
  	global $str;
  	$dir = opendir($name);
  	while ($file = readdir($dir))
  	  if ($file != "." && $file != "..") {
  	  	$file = $name . "/" . $file;
  	  	if (is_dir($file))
  	  	  Scan($file);
  	  	else
  	  	  $str .= "<url><loc>http://www.dmmi.edu.ua/" . $file . "</loc></url>";
  	  }
  	closedir($dir);
  }
  foreach (array("en", "ru", "ua", "files") as $dir)
  	Scan($dir);
  $str .= "</urlset>";
  file_put_contents("Sitemap.xml", $str);
  header("location:Sitemap.xml");
?>