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
$viikko = $date->format("Y-d-m W");


function getDailyEvents($weekday) {
try {
  while ($row = $result->fetch_assoc()) {
    if ($row["eventDate"] == $weekday) {
      echo $row["startTime"] . " - " . $row["endTime"] . $row["description"];
      $date = new DateTime($row["eventDate"]);
      $viikko = $date->format("W");
      $viikonpäivä = $date->format("l");
      echo "<br>";
    } else {
    }
  }
} catch (Exception $e) {
  echo $e->getMessage();
}

  }

/*
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo  $row["description"], " ";
    $date = new DateTime($row["eventDate"]);
    $viikko = $date->format("W");
    $viikonpäivä = $date->format("l");
    echo $viikko , " ", $viikonpäivä;
    echo "<br>";
  }
} else {
  echo "Tapahtumia ei löytynyt";
}
*/




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

                ?>
             </h5>
            </div>

            <div class="col-sm-8">
              <br>
              <h4>
                <?php

                ?>
              </h4>
            </div>
          </div>

          <div id="lukkari-ti" class="row collapse">

            <div class="col-sm-3" style="margin-top: 25px">
              <h3> Tuesday </h3>
              <h5> (Date here) </h5>
            </div>

            <div class="col-sm-8">
              <br>
              <h4> You seem to have nothing on your schedule
                   this Tuesday. Like, the whole day doesn't
                   seem to even exist. Weird.
              </h4>
            </div>
          </div>

          <div id="lukkari-ke" class="row collapse">

            <div class="col-sm-3" style="margin-top: 25px">
              <h3> Wednesday </h3>
              <h5> (Date here) </h5>
            </div>

            <div class="col-sm-8">
              <br>
              <h4> Whatever you had planned for Wednesday seems to
                   have completely disappeared. I guess you should
                   take this opportunity to practice your PHP.
              </h4>
            </div>
          </div>

          <div id="lukkari-to" class="row collapse">

            <div class="col-sm-3" style="margin-top: 25px">
              <h3> Thursday </h3>
              <h5> (Date here) </h5>
            </div>

            <div class="col-sm-8">
              <br>
              <h4> Ah, Thursday. I think it's the most underappreciated
                   day of the week. After all, Friday comes right after
                   and you've had three full days before, meaning you've
                   also had three full days to work on your projects, which
                   you of course did, as a responsible student.
              </h4>
            </div>
          </div>

          <div id="lukkari-pe" class="row collapse">

            <div class="col-sm-3" style="margin-top: 25px">
              <h3> Friday </h3>
              <h5>
                <?php
                  $unix = strtotime("Friday");
                  $friday_date = date("Y-m-d", $unix);
                  echo $friday_date;
                ?>
            </h5>
            </div>

            <div class="col-sm-8">
              <br>
              <h4>
                  <?php
                    getDailyEvents($friday_date);
                  ?>
              </h4>
            </div>
          </div>

          <div id="lukkari-la" class="row collapse">

            <div class="col-sm-3" style="margin-top: 25px">
              <h3> Saturday </h3>
              <h5> (Date here) </h5>
            </div>

            <div class="col-sm-8">
              <br>
              <h4> Good thinking not scheduling anything for Saturday.
                   You can now spend the whole day doing homework. I'm so
                    proud of you for not going out drinking last night!
              </h4>
            </div>
          </div>

          <div id="lukkari-su" class="row collapse">

            <div class="col-sm-3" style="margin-top: 25px">
              <h3> Sunday </h3>
              <h5> (Date here) </h5>
            </div>

            <div class="col-sm-8">
              <br>
              <h4>
                  I'm not working on this on Sunday. I don't care
                  if you had something to do.
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
                    <input type="time" name="startTime" style="max-width:90px;"
                           class="form-control"  placeholder="Starts">
                  </div>

                  <div class="form-group" style="display:inline-block; margin-left: 15px;">
                    <label>End time:  </label>
                    <input type="time" name="endTime" style="max-width:90px;"
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
