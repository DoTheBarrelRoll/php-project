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
echo "Error: Unable to connect to MySQL." . PHP_EOL;
echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
exit;
}





  $email = $_POST["email"];
  $passu = hash('sha512', $_POST["password"]);

  $sql = "SELECT * FROM userinfo WHERE email='$email' AND password='$passu'" ;


  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
// output data of each row
  while($row = $result->fetch_assoc()) {
      $_SESSION["username"] = $email;
      header("Location: https://1701560.azurewebsites.net/profile.php")
    }
  } else {
      echo "Incorrect email or password";
  }


  mysqli_close($conn);

?>
