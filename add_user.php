<?php
//luodaan yhteys tietokantaan
$connectstr_dbhost = '';
$connectstr_dbname = 'localdb';
$connectstr_dbusername = '';
$connectstr_dbpassword = '';

foreach ($_SERVER as $key => $value) {
if (strpos($key, "MYSQLCONNSTR_localdb") !== 0) {
continue;
}

$connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
$connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
$connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
}


$conn = mysqli_connect($connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword,$connectstr_dbname);

$fname = $_POST["sign_fname"];
$lname = $_POST["sign_lname"];
$email = $_POST["sign_email"];
$password = hash('sha512', $_POST["sign_password"]);

$sql = "INSERT INTO `userinfo`(`fname`, `lname`, `email`, `password`) VALUES ('$fname', '$lname', '$email', '$password')";
$check_email = "SELECT * FROM `userinfo` WHERE `email` = '$email'";
$create_time = "UPDATE `userinfo` SET `join_time` = NOW() WHERE `userinfo`.`email` = '$email'";

$checked = mysqli_query($conn, $check_email);


header("Location: https://1701560.azurewebsites.net/")


?>