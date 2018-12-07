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

  $passu1 = $_POST["new_password1"];
  $passu2 = $_POST["new_password2"];
  $vanhaPassu = $_POST["sign_password"];
  $sposti = $_SESSION["email"];
  if ($passu1 == $passu2) {
    $passu = hash('sha512', $passu1);
    $sql = "UPDATE 'userinfo' SET 'password'='$passu' WHERE 'email' = '$sposti'";

    
  }



  $conn->query($sql);



  mysqli_close($conn);

?>
