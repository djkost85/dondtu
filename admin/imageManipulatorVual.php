<?php
  header("Content-Type: text/html; charset=utf-8");
  session_start();
  if ($_SESSION["auth"] != "1")
    header("location:.");
  
  $format = array(
    "slidew" => 1020,
    "slideh" => 420,
    "miniaturew" => 160,
    "miniatureh" => 120,
    "newsw" => 260,
    "newsh" => 146,
    "origw" => 800,
    "origh" => 1000
  );

  function processImage($file, $type) {
    if ($type == "image/jpeg" || $type == ".jpeg" || $type == ".jpg")
      $img = @imagecreatefromjpeg($file);
    elseif ($type == "image/png" || $type == ".png")
      $img = @imagecreatefrompng($file);
    elseif ($type == "image/bmp" || $type == ".bmp")
      $img = @imagecreatefromwbmp($file);
    elseif ($type == "image/gif" || $type == ".gif")
      $img = @imagecreatefromgif($file);
    else {
      echo "Format error";
      exit;
    }

    do {
      $rand = mt_rand() . ".jpeg";
      $foriginal = "../imageLibrary/images/originals/" . $rand;
      $fminiature = "../imageLibrary/images/miniatures/" . $rand;
    }
    while (file_exists($foriginal) || file_exists($fminiature));

    global $format;
    $size = getimagesize($file);
    $origs = $size[0] / $size[1];

    $mins = $format["miniaturew"] / $format["miniatureh"];
    if ($origs < $mins) {
      $height = $format["miniatureh"];
      $width = $format["miniaturew"] * $origs / $mins;
    }
    else {
      $width = $format["miniaturew"];
      $height = $format["miniatureh"] * $mins / $origs;
    }
    $min = imagecreatetruecolor($width, $height);
    imagecopyresampled($min, $img, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
    imagejpeg($min, $fminiature);
    imagedestroy($min);

    $mins = $format["origw"] / $format["origh"];
    if ($origs < $mins) {
      $height = $format["origh"];
      $width = $format["origw"] * $origs / $mins;
    }
    else {
      $width = $format["origw"];
      $height = $format["origh"] * $mins / $origs;
    }
    $min = imagecreatetruecolor($width, $height);
    imagecopyresampled($min, $img, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
    imagejpeg($min, $foriginal);
    imagedestroy($min);

    imagedestroy($img);
    unlink($file);
    return $rand;
  }

  switch ($_POST["action"]) {

    case "uploadImageLocal":
      if ($_FILES["inputFile"]["error"] != "0") {
        echo "General error";
        exit;
      }
      echo processImage($_FILES["inputFile"]["tmp_name"], $_FILES["inputFile"]["type"]);
      break;
    case "uploadImageRemote":
      $address = $_POST["address"];
      $temp = "../imageLibrary/images/temp";
      file_put_contents($temp, file_get_contents($address));
      echo processImage($temp, strrchr($address, "."));
      break;
    case "processSlide":
      $fname = $_POST["fname"];
      do {
        $rand = mt_rand();
        $foriginal = "../imageLibrary/slides/originals/" . $rand . ".jpeg";
        $fminiature = "../imageLibrary/slides/miniatures/" . $rand . ".jpeg";
      }
      while (file_exists($foriginal) || file_exists($fminiature));
      $size = getimagesize($fname);
      $ix = $size[0] / $_POST["cssWidth"];
      $iy = $size[1] / $_POST["cssHeight"];
      $dest = imagecreatetruecolor($format["slidew"], $format["slideh"]);
      $src = imagecreatefromjpeg($fname);
      imagecopyresampled($dest, $src, 0, 0,
        $_POST["selectedLeft"] * $ix, $_POST["selectedTop"] * $iy,
        $format["slidew"], $format["slideh"],
        $_POST["selectedWidth"] * $ix, $_POST["selectedHeight"] * $iy);
      imagejpeg($dest, $foriginal);
      imagedestroy($src);
      $origs = $format["slidew"] / $format["slideh"];
      $mins = $format["miniaturew"] / $format["miniatureh"];
      if ($origs < $mins) {
        $height = $format["miniatureh"];
        $width = $format["miniaturew"] * $origs / $mins;
      }
      else {
        $width = $format["miniaturew"];
        $height = $format["miniatureh"] * $mins / $origs;
      }
      $min = imagecreatetruecolor($width, $height);
      imagecopyresampled($min, $dest, 0, 0, 0, 0, $width, $height, $format["slidew"], $format["slideh"]);
      imagejpeg($min, $fminiature);
      imagedestroy($min);
      imagedestroy($dest);

      $forder = fopen("../imageLibrary/slides/order", "a");
      fwrite($forder, (filesize("../imageLibrary/slides/order") > 0 ? "\n" : "") . $rand . ".jpeg");
      fclose($forder);

      echo $rand;
      break;
    case "deleteImage":
      $fname = $_POST["fname"];
      unlink("../imageLibrary/images/originals/" . $fname);
      unlink("../imageLibrary/images/miniatures/" . $fname);
      break;
    case "saveSlidesOrder":
      $forder = fopen("../imageLibrary/slides/order", "w");
      fwrite($forder, $_POST["order"]);
      fclose($forder);
      break;
    case "deleteSlide":
      $fname = $_POST["fname"];
      unlink("../imageLibrary/slides/originals/" . $fname);
      unlink("../imageLibrary/slides/miniatures/" . $fname);
      $forder = fopen("../imageLibrary/slides/order", "w");
      fwrite($forder, $_POST["order"]);
      fclose($forder);
      break;

    case "processNews":
      $fname = $_POST["fname"];
      $selectedWidth = $_POST["selectedWidth"];
      $selectedHeight = $_POST["selectedHeight"];
      $size = getimagesize($fname);
      $ix = $size[0] / $_POST["cssWidth"];
      $iy = $size[1] / $_POST["cssHeight"];
      $dest = imagecreatetruecolor($selectedWidth, $selectedHeight);
      $src = imagecreatefromjpeg($fname);
      imagecopyresampled($dest, $src, 0, 0,
        $_POST["selectedLeft"] * $ix, $_POST["selectedTop"] * $iy,
        $selectedWidth, $selectedHeight,
        $selectedWidth * $ix, $selectedHeight * $iy);
      imagejpeg($dest, "../imageLibrary/news/originals/temp");
      imagedestroy($src);
      $min = imagecreatetruecolor($format["newsw"], $format["newsh"]);
      imagecopyresampled($min, $dest, 0, 0, 0, 0, $format["newsw"], $format["newsh"], $selectedWidth, $selectedHeight);
      imagejpeg($min, "../imageLibrary/news/miniatures/temp");
      imagedestroy($min);
      imagedestroy($dest);
      break;
    case "addNews":
      require_once "../mysql.php";
      mysql_query("
        INSERT INTO news(`header`, `preview`, `text`, `date`, `lang`, `active`)
        VALUES('" . $_POST["header"] . "', '" . $_POST["preview"] . "', '" . $_POST["text"] . "', '" . $_POST["date"] . "', '" . $_POST["lang"] . "', 0)
      ");
      $id = mysql_insert_id();
      $editing = $_POST["editing"];
      $newImage = $_POST["newImage"];
      if ($newImage) {
        rename("../imageLibrary/news/originals/temp", "../imageLibrary/news/originals/" . $id . ".jpeg");
        rename("../imageLibrary/news/miniatures/temp", "../imageLibrary/news/miniatures/" . $id . ".jpeg");
      }
      elseif ($editing) {
        copy("../imageLibrary/news/originals/" . $editing . ".jpeg", "../imageLibrary/news/originals/" . $id . ".jpeg");
        copy("../imageLibrary/news/miniatures/" . $editing . ".jpeg", "../imageLibrary/news/miniatures/" . $id . ".jpeg");
      }
      break;
    case "editNews":
      require_once "../mysql.php";
      $editing = $_POST["editing"];
      $newImage = $_POST["newImage"];
      mysql_query("
        UPDATE news
        SET
          `header` = '" . $_POST["header"] . "',
          `preview` = '" . $_POST["preview"] . "',
          `text` = '" . $_POST["text"] . "',
          `lang` = '" . $_POST["lang"] . "',
          `date` = '" . $_POST["date"] . "'
        WHERE
          id = " . $editing . "
      ");
      if ($newImage) {
        rename("../imageLibrary/news/originals/temp", "../imageLibrary/news/originals/" . $editing . ".jpeg");
        rename("../imageLibrary/news/miniatures/temp", "../imageLibrary/news/miniatures/" . $editing . ".jpeg");
      }
      break;
    case "activateNews":
      require_once "../mysql.php";
      echo mysql_query("
        UPDATE news
        SET `active` = 1
        WHERE id = " . $_POST["id"] . "
      ");
      break;
    case "deactivateNews":
      require_once "../mysql.php";
      echo mysql_query("
        UPDATE news
        SET `active` = 0
        WHERE id = " . $_POST["id"] . "
      ");
      break;
    case "deleteNews":
      $id = $_POST["id"];
      unlink("../imageLibrary/news/originals/" . $id . ".jpeg");
      unlink("../imageLibrary/news/miniatures/" . $id . ".jpeg");
      require_once "../mysql.php";
      mysql_query("
        UPDATE news
        SET deleted = 1
        WHERE id = " . $id . "
      ");
      break;

    case "addEvent":
      require_once "../mysql.php";
      mysql_query("
        INSERT INTO events(`header`, `preview`, `text`, `date`, `lang`, `active`)
        VALUES('" . $_POST["header"] . "', '" . $_POST["preview"] . "', '" . $_POST["text"] . "', '" . $_POST["date"] . "', '" . $_POST["lang"] . "', 0)
      ");
      break;
    case "editEvent":
      require_once "../mysql.php";
      $editing = $_POST["editing"];
      mysql_query("
        UPDATE events
        SET
          `header` = '" . $_POST["header"] . "',
          `preview` = '" . $_POST["preview"] . "',
          `text` = '" . $_POST["text"] . "',
          `date` = '" . $_POST["date"] . "',
          `lang` = '" . $_POST["lang"] . "'
        WHERE
          id = " . $editing . "
      ");
      break;
    case "activateEvent":
      require_once "../mysql.php";
      echo mysql_query("
        UPDATE events
        SET `active` = 1
        WHERE id = " . $_POST["id"] . "
      ");
      break;
    case "deactivateEvent":
      require_once "../mysql.php";
      echo mysql_query("
        UPDATE events
        SET `active` = 0
        WHERE id = " . $_POST["id"] . "
      ");
      break;
    case "deleteEvent":
      require_once "../mysql.php";
      mysql_query("
        UPDATE events
        SET deleted = 1
        WHERE id = " . $_POST["id"] . "
      ");
      break;

    case "vkNewsSent":
      require_once "../mysql.php";
      echo mysql_query("
        UPDATE news
        SET vkPostId = " . $_POST["vkPostId"] . "
        WHERE id = " . $_POST["id"] . "
      ") ? "OK" : "ERR";
      break;

    case "vkEventSent":
      require_once "../mysql.php";
      echo mysql_query("
        UPDATE events
        SET vkPostId = " . $_POST["vkPostId"] . "
        WHERE id = " . $_POST["id"] . "
      ") ? "OK" : "ERR";
      break;

    case "vkUploadPhoto":
      $ch = curl_init($_POST["url"]);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
      curl_setopt($ch, CURLOPT_TIMEOUT, 60);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, array(
        "photo" => "@" . $_POST["photo"]
      ));
      curl_exec($ch);
      curl_close($ch);
      break;
  }
?>