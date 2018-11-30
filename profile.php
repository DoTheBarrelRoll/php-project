<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

ini_set('error_log', 'script_errors.log');  // change here
ini_set('log_errors', 'On');
session_start();



if (!(isset($_COOKIE[session_name()]))) {
  header("Location: https://1701560.azurewebsites.net");
}


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

$sql = "SELECT * FROM userinfo WHERE email='{$_SESSION['username']}'";


$result = mysqli_query($conn, $sql);

if (!$result) {
    printf("Errormessage: %s\n", mysqli_error($conn));
}

if ($rows = $result->num_rows) {

  while ($row = mysqli_fetch_assoc($result)) {
    $name = $row["fname"];
  }
}

$sql2 = "SELECT * FROM calendaritem WHERE userID='{$_SESSION['userID']}' ORDER BY eventDate, startTime, endTime";
$sql3= "SET DATEFIRST 1 SELECT * FROM calendaritem WHERE userID='{$_SESSION['userID']}'
AND 'eventDate' >= dateadd(day, 1-datepart(dw, getdate()), CONVERT(date,getdate()))
AND 'eventDate' <  dateadd(day, 8-datepart(dw, getdate()), CONVERT(date,getdate()))";

$result = $conn->query($sql2);

$ddate = date();
$date = new DateTime($ddate);
$viikko = $date->format("W");

echo $viikko;




$rivit = array();

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {

    $rivit[] = $row;
    $rowlength = count($row);
  }
} else {
  echo "Tapahtumia ei löytynyt";
}
$arrlength = count($rivit);



function getDailyEvents($weekday, $weeknum) {
try {
  for($x = 0; $x < $GLOBALS['arrlength']; $x++) {
    $ddate = $GLOBALS['rivit'][$x]["eventDate"];
    $date = new DateTime($ddate);
    $viikko = $date->format("W");

    if ($GLOBALS['rivit'][$x]["eventDate"] == $weekday and $viikko == $weeknum) {
      echo $GLOBALS['rivit'][$x]["startTime"] . " - " . $GLOBALS['rivit'][$x]["endTime"] . $GLOBALS['rivit'][$x]["description"];
      $date = new DateTime($GLOBALS['rivit'][$x]["eventDate"]);
      $viikko = $date->format("W");
      $viikonpäivä = $date->format("l");
      echo "<br>";
    }
  }


} catch (Exception $e) {
  echo $e->getMessage();
}

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
         <h1>Welcome, <?php echo $name;?></h1>
       </div>

       <div class="row">
         <div class="col-md-12">
           <div class="lukkari">
             <h2> Your schedule this week </h2>
             <h6> (Click the weekdays to open)</h6>
             <br>

             <div>

             <div class="card-lukkari">
               <button type="button" class="btn btn-block btn-outline-primary btn-lukkari"
                       data-toggle="collapse" data-target="#lukkari-ma">
               <div class="card-body" style="align-content: center;">
                <h4>Mon</h4>
              </div>
            </button>
            </div>

            <div class="card-lukkari ">
              <button type="button" class="btn btn-block btn-outline-primary btn-lukkari"
                      data-toggle="collapse" data-target="#lukkari-ti">
              <div class="card-body" style="align-ontent: center;">
               <h4>Tue</h4>
             </div>
           </button>
           </div>

           <div class="card-lukkari ">
             <button type="button" class="btn btn-block btn-outline-primary btn-lukkari"
                     data-toggle="collapse" data-target="#lukkari-ke">
             <div class="card-body" style="align-content: center;">
              <h4>Wed</h4>
            </div>
          </button>
          </div>

          <div class="card-lukkari ">
            <button type="button" class="btn btn-block btn-outline-primary btn-lukkari"
                    data-toggle="collapse" data-target="#lukkari-to">
            <div class="card-body" style="align-content: center;">
             <h4>Thu</h4>
           </div>
         </button>
         </div>

         <div class="card-lukkari ">
           <button type="button" class="btn btn-block btn-outline-primary btn-lukkari"
                   data-toggle="collapse" data-target="#lukkari-pe">
           <div class="card-body" style="align-content: center;">
            <h4>Fri</h4>
          </div>
        </button>
        </div>

        <div class="card-lukkari">
          <button type="button" class="btn btn-block btn-outline-danger btn-lukkari"
                  data-toggle="collapse" data-target="#lukkari-la">
          <div class="card-body" style="align-content: center;">
           <h4>Sat</h4>
         </div>
       </button>
       </div>

       <div class="card-lukkari">
         <button type="button" class="btn btn-block btn-outline-danger btn-lukkari"
                 data-toggle="collapse" data-target="#lukkari-su">
         <div class="card-body" style="align-content: center;">
          <h4>Sun</h4>
        </div>
      </button>
      </div>

          </div>

          <div id="lukkari-ma" class="row collapse">

            <div class="col-sm-3" style="margin-top: 25px">
              <h3> Monday </h3>
              <h5>
                 <?php
                 $monday_date = date("Y-m-d", strtotime("Monday this week"));
                 echo $monday_date;
                ?>
             </h5>
            </div>

            <div class="col-sm-8">
              <br>
              <h4>
                <?php
                  getDailyEvents($monday_date, $viikko);
                ?>
              </h4>
            </div>
          </div>

          <div id="lukkari-ti" class="row collapse">

            <div class="col-sm-3" style="margin-top: 25px">
              <h3> Tuesday </h3>
              <h5>
                <?php
                  $tuesday_date = date("Y-m-d", strtotime("Tuesday this week"));
                  echo $tuesday_date;
                ?>
           </h5>
            </div>

            <div class="col-sm-8">
              <br>
              <h4>
                <?php
                  getDailyEvents($tuesday_date, $viikko);
                ?>
              </h4>
            </div>
          </div>

          <div id="lukkari-ke" class="row collapse">

            <div class="col-sm-3" style="margin-top: 25px">
              <h3> Wednesday </h3>
              <h5><?php
                $wednesday_date = date("Y-m-d", strtotime("Wednesday this week"));
                echo $wednesday_date;
              ?></h5>
            </div>

            <div class="col-sm-8">
              <br>
              <h4>
                <?php
                  getDailyEvents($wednesday_date, $viikko);
                ?>
              </h4>
            </div>
          </div>

          <div id="lukkari-to" class="row collapse">

            <div class="col-sm-3" style="margin-top: 25px">
              <h3> Thursday </h3>
              <h5><?php
                $thursday_date = date("Y-m-d", strtotime("Thursday this week"));
                echo $thursday_date;
              ?></h5>
            </div>

            <div class="col-sm-8">
              <br>
              <h4>
                <?php
                  getDailyEvents($thursday_date, $viikko);
                ?>
              </h4>
            </div>
          </div>

          <div id="lukkari-pe" class="row collapse">

            <div class="col-sm-3" style="margin-top: 25px">
              <h3> Friday </h3>
              <h5>
                <?php
                  $friday_date = date("Y-m-d", strtotime("Friday this week"));
                  echo $friday_date;
                ?>
            </h5>
            </div>

            <div class="col-sm-8">
              <br>
              <h4>
                  <?php
                    getDailyEvents($friday_date, $viikko);
                  ?>
              </h4>
            </div>
          </div>

          <div id="lukkari-la" class="row collapse">

            <div class="col-sm-3" style="margin-top: 25px">
              <h3> Saturday </h3>
              <h5><?php
                  $saturday_date = date("Y-m-d", strtotime("Saturday this week"));
                  echo $saturday_date;
              ?></h5>
            </div>

            <div class="col-sm-8">
              <br>
              <h4>
                <?php
                  getDailyEvents($saturday_date, $viikko);
                ?>
              </h4>
            </div>
          </div>

          <div id="lukkari-su" class="row collapse">

            <div class="col-sm-3" style="margin-top: 25px">
              <h3> Sunday </h3>
              <h5><?php
                  $sunday_date = date("Y-m-d", strtotime("Sunday this week"));
                  echo $sunday_date;
              ?></h5>
            </div>

            <div class="col-sm-8">
              <br>
              <h4>
                <?php
                  getDailyEvents($sunday_date, $viikko);
                 ?>
              </h4>
            </div>
          </div>

           </div>
           </div>

         </div>

         <div class="row">
           <div class="col-md-3">

             <div id="navCard" class="card-options ">
               <ul class="nav flex-column" role="tablist">

                 <li class="nav-item">
                   <a class="valinta-nappi nav-link active"
                           data-toggle="tab" href="#newItem">
                   <h5>Add a new event</h5>
                 </a>
               </li>

                 <li class="nav-item">
                   <a class="valinta-nappi nav-link"
                           data-toggle="tab" href="#archive">
                   <h5>View full Schedule</h5>
                 </a>
               </li>

                 <li class="nav-item">
                   <a class="valinta-nappi nav-link"
                           data-toggle="tab" href="#profile">
                   <h5>Manage profile</h5>
                 </a>
               </li>
             </ul>

               </div>

               <form action="logout.php" method="post">
                 <button type="submit" class="btn btn-danger" style="margin-top: 30px;">Log out</button>
               </form>
              </div>

            <div class="col-md-9">
              <div class="tab-content">

            <div id="newItem" class="tab-pane active card-options media">
                <img src="NewCalendarItem_small.png"
                     alt="create new" class="card-img">

                <div class="media-body">
                  <h3> Add a new calendar event </h3>
                  <br><br>
                </div>


                <form action="addCalendarItem.php" method="post">

                  <div class="form-group">
                    <label>Choose the date of your event</label>
                    <input type="date" name="eventDate" style="max-width:150px;"
                           class="form-control"  placeholder="Date">
                  </div>

                  <div class="form-group" style="display:inline-block;">
                    <label>Start time:  </label>
                    <input type="time" name="startTime" style="max-width:100px;"
                           class="form-control"  placeholder="Starts">
                  </div>

                  <div class="form-group" style="display:inline-block; margin-left: 15px;">
                    <label>End time:  </label>
                    <input type="time" name="endTime" style="max-width:100px;"
                           class="form-control" placeholder="Ends">
                  </div>
                  <br>
                  <div class="form-group">
                    <textarea rows="3" name="description"
                              class="form-control" style="max-height:75px;"
                              placeholder="Description"></textarea>
                    <small id="descHelp" class="form-text text-muted">
                      Describe your event in 150 characters. Please do this. Reading these
                      is the only way I feel like I have friends.
                    </small>
                  </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>


                <div>

              </div>
            </div>

            <div id="archive" class="tab-pane card-options media">
                <img src="full-schedule_small.png"
                     alt="create new" class="card-img">

                <div class="media-body">
                  <h3> View your full schedule</h3>
                </div>
                <div>

                </div>
              </div>

            <div id="profile" class="container tab-pane card-options media">
                <img src="editProfile_small.png"
                     alt="create new" class="card-img">

                <div class="media-body">
                  <h3>Manage your user profile</h3>
                  <br><br>
                </div>
                <div>
                  <form action="" method="post">

                  <div class="form-group" style="display:inline-block;">
                      <label for="exampleInputPassword1">Enter a new password</label>
                      <input type="password" name="new_password"
                             class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>

                    <div class="form-group" style="display:inline-block;">
                      <label for="exampleInputPassword1">Re-enter your new password</label>
                      <input type="password" name="new_password"
                             class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Enter your old password to allow changes</label> <!-- salasanan syöttö rekisteröityessä -->
                      <input type="password" name="sign_password"
                             class="form-control" id="exampleInputPassword1" placeholder="Password">
                      <small id="emailHelp" class="form-text text-muted">Passwords are hashed with SHA512 so no one can see them, not even us!</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
              </div>
            </div>

         </div>
       </div>
     </div>



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
