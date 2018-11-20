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

$sql = "SELECT fname FROM userinfo WHERE email='{$_SESSION['username']}'";

$result = mysqli_query($conn, $sql);

if ($count = $result->num_rows) {
  echo $count;


}




 ?>

 <html lang="en">
   <head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
           integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
           crossorigin="anonymous">
     <link rel="stylesheet" href="tyyli.css">

     <title>My profile</title>
   </head>

   <body>

     <div class="container">
       <div class="jumbotron">
         <h1>Welcome, <?php echo $user;?></h1>
       </div>

       <div class="row">
         <div class="col-sm-12">
           <div class="lukkari">

             <div class= "card-deck">
             <div class="card">
               <div class="card-body" style="align-content: center;">
                 <h6> Ma </h6>
              </div>
            </div>
            <div class="card">
              <div class="card-body" style="align-content: center;">
                <h6> Ti </h6>
             </div>
           </div>
           <div class="card">
             <div class="card-body" style="align-content: center;">
               <h6> Ke </h6>
            </div>
          </div>
          <div class="card">
            <div class="card-body" style="align-content: center;">
              <h6> To </h6>
           </div>
         </div>
         <div class="card">
           <div class="card-body" style="align-content: center;">
             <h6> Pe </h6>
          </div>
        </div>
        <div class="card">
          <div class="card-body" style="align-content: center;">
            <h6> La </h6>
         </div>
       </div>
       <div class="card">
         <div class="card-body" style="align-content: center;">
           <h6> Su </h6>
        </div>
      </div>

          </div>

           </div>
           </div>

         </div>

       <div class="row">
         <div class="col-sm-12">
           <div class= "card-deck">

           <div class="card">
             <img src="scared granny.png" alt="create new" class="card-img">
             <div class="card-body" style="align-content: center;">

               <h4 class="card-title">Create a new schedule</h4>
               <br>
               <button type="button" class="btn btn-info card-link">Go --></button>

            </div>
          </div>

          <div class="card">
            <img src="Andyface.png" alt="manage" class="card-img">
            <div class="card-body">

              <h4 class="card-title">Manage profile</h4>
              <br>
              <button type="button" class="btn btn-info card-link">Go --></button>

           </div>
         </div>

         <div class="card">
           <img src="M_A_Numminen_2011.jpg" alt="create new" class="card-img">
           <div class="card-body">

             <h5 class="card-title">We have no idea what this one is going to do,
                                    but it'll be amazing!</h4>
             <button type="button" class="btn btn-info card-link">Go --></button>

          </div>
        </div>

         </div>
        </div>
       </div>

       <form action="logout.php" method="post">
         <button type="submit" class="btn btn-danger" style="margin-top: 30px;">Log out</button>
       </form>
     </div>


       <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
               integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
               crossorigin="anonymous"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
               integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
               crossorigin="anonymous"></script>
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
               integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
               crossorigin="anonymous"></script>
     </body>
  </html>
