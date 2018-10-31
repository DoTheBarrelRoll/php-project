<?php

  echo "testi";
  require_once('../open-connection.php');
  $query = "SELECT username, fname, lname FROM userinfo";
  $response = @mysqli_query($link, $query);

  echo $response;


?>
