<?php
// remove all session variables
session_unset();
if (isset($_COOKIE[session_name()])) {
  setcookie(session_name(), '', time() - 3600);
}

// destroy the session
session_destroy();

header("Location: https://1701560.azurewebsites.net");
die();
?>
