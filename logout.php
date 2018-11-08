<?php
// remove all session variables
session_unset();

// destroy the session
session_destroy();

header("Location: https://1701560.azurewebsites.net/index.php");
?>
