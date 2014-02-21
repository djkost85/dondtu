<?php
  session_start();
  switch ($_POST["action"]) {
  	case "auth":
      require_once "functions.php";
      $password = encrypt($_POST["password"]);
      if ($_POST["login"] == "root" && $password == "5ae23692ea307861f9f25825a704e7c428a40dfa") {
  	    $_SESSION["auth"] = "1";
        $_SESSION["lang"] = "0";
      }
  	  break;
  	case "exit":
  	  session_destroy();
  	  break;
  }
  header("location:.");
?>