<?php
session_start();

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

if (!$conn) {

exit;
}





  $email = $_POST["email"];
  $passu = hash('sha512', $_POST["password"]);

  $sql = "SELECT * FROM userinfo WHERE email='$email' AND password='$passu'" ;


  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $_SESSION["username"] = $email;
    header("Location: https://1701560.azurewebsites.net/profile.php");

  } else {
      echo "Incorrect email or password";
  }

  mysqli_close($conn);

?>
