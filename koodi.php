<?php

  $servername = "localhost";
  $dbname = "mydb";
  $username = "root";
  $password = "";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
  }
  $email = $_POST["email"];
  $passu = $_POST["password"];
  // Create database
  $sql = "SELECT * FROM users WHERE email='$email' AND password='$passu'" ;


  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
// output data of each row
  while($row = $result->fetch_assoc()) {
      echo "Logged in!";
    }
  } else {
      echo "Incorrect email or password";
  }


  mysqli_close($conn);

?>
