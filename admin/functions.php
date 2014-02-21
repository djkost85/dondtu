<?php
  function encrypt($password) {
    for ($i = 0; $i < 1984; $i++)
      $password = sha1($password);
    return $password;
  }
?>