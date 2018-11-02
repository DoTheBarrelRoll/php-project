<?php
//luodaan yhteys tietokantaan
$connectstr_dbhost = '';
$connectstr_dbname = 'mydb';
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
$password = $_POST["sign_password"];

$sql = "INSERT INTO `userinfo`(`fname`, `lname`, `email`, `password`) VALUES ('$fname', '$lname', '$email', '$password')";
$create_time = "UPDATE `userinfo` SET `join_time` = NOW() WHERE `userinfo`.`email` = '$email'";

$conn->query($sql);
$conn->query($create_time);

echo $sql . "<br>";
echo $create_time;
?>
