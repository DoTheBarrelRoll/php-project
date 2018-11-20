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

$sql = "SELECT * FROM userinfo WHERE email='{$_SESSION['username']}'";
$sql2 = "SELECT DAYNAME("2018-11-20")";

$result = mysqli_query($conn, $sql2);

if (!$result) {
    printf("Errormessage: %s\n", mysqli_error($conn));
}

if ($count = $result->num_rows) {
  echo $count;

  while ($row = mysqli_fetch_assoc($result)) {
    echo $row[0];
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
<<<<<<< HEAD
         <h1>Welcome, <?php echo $row['fname'];?></h1>
=======
         <h1>Welcome, <?php echo $user; ?></h1>
>>>>>>> parent of e691eca... Revert "Lisää fronttia. Paljon hiottavaa vielä."
       </div>

       <div class="row">
         <div class="col-sm-12">
           <div class="lukkari">
             <h2> Your schedule this week </h2>
             <h6> (Click the weekdays to open)</h4>
             <br>

             <div class= "card-deck">

             <div class="card card-lukkari">
               <button type="button" class="btn btn-block btn-outline-primary btn-lukkari"
                       data-toggle="collapse" data-target="#lukkari-ma">
               <div class="card-body" style="align-content: center;">
                <h4>Mon</h4>
              </div>
            </button>
            </div>

            <div class="card card-lukkari">
              <button type="button" class="btn btn-block btn-outline-primary btn-lukkari"
                      data-toggle="collapse" data-target="#lukkari-ti">
              <div class="card-body" style="align-content: center;">
               <h4>Tue</h4>
             </div>
           </button>
           </div>

           <div class="card card-lukkari">
             <button type="button" class="btn btn-block btn-outline-primary btn-lukkari"
                     data-toggle="collapse" data-target="#lukkari-ke">
             <div class="card-body" style="align-content: center;">
              <h4>Wed</h4>
            </div>
          </button>
          </div>

          <div class="card card-lukkari">
            <button type="button" class="btn btn-block btn-outline-primary btn-lukkari"
                    data-toggle="collapse" data-target="#lukkari-to">
            <div class="card-body" style="align-content: center;">
             <h4>Thu</h4>
           </div>
         </button>
         </div>

         <div class="card card-lukkari">
           <button type="button" class="btn btn-block btn-outline-primary btn-lukkari"
                   data-toggle="collapse" data-target="#lukkari-pe">
           <div class="card-body" style="align-content: center;">
            <h4>Fri</h4>
          </div>
        </button>
        </div>

        <div class="card card-lukkari">
          <button type="button" class="btn btn-block btn-outline-danger btn-lukkari"
                  data-toggle="collapse" data-target="#lukkari-la">
          <div class="card-body" style="align-content: center;">
           <h4>Sat</h4>
         </div>
       </button>
       </div>

       <div class="card card-lukkari">
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
              <h5> (Date here) </h5>
            </div>

            <div class="col-sm-8">
              <br>
              <h4> Your schedule for this Monday comes here
                   once we figure out how to do it
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
              <h5> (Date here) </h5>
            </div>

            <div class="col-sm-8">
              <br>
              <img src="https://i.ytimg.com/vi/kfVsfOSbJY0/maxresdefault.jpg"
                   alt="F R I D A Y" style="max-width:75%;max-height:75%;">
              <h4> GOTTA' GET DOWN, GOTTA' EAT CEREAL </h4>
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
         <div class="col-sm-3">

           <div id="navCard" class="card card-options ">
             <ul class="nav nav-tabs flex-column" role="tablist">

               <li class="nav-item">
                 <a class="nav-link active" data-toggle="tab" href="#newItem">
                 <img src="NewCalendarItem_small.png" style="float:left;"
                      alt="" class="nav-img">
                 <h5>Add a new event</h5>
               </a>
             </li>

               <li class="nav-item">
                 <a class="nav-link" data-toggle="tab" href="#archive">
                 <img src="full-schedule_small.png" style="float:left;"
                      alt="" class="nav-img">
                 <h5>View full Schedule</h5>
               </a>
             </li>

               <li class="nav-item">
                 <a class="nav-link" data-toggle="tab" href="#profile">
                 <img src="editProfile_small.png" style="float:left;"
                      alt="create new" class="nav-img">
                 <h5>Manage profile</h5>
               </a>
             </li>

             </div>
            </div>

          <div class="col-sm-9">
            <div class="tab-content">

          <div id="newItem" class="container tab-pane active card-options media">
              <img src="NewCalendarItem_small.png"
                   alt="create new" class="card-img">

              <div class="media-body">
                <br>
                <h3> Add a new calendar event </h3>
              </div>

              <!-- tämän form-tagin sisällä on lomake, joka lisää merkinnän -->
              <form action="profile-proto.php" method="post">

                <div class="form-group">
                  <input type="text" name=""
                         class="form-control"  placeholder="Date">
                </div>

                <div class="form-inline">
                  <input type="text" name=""
                         class="form-control"  placeholder="Starts">

                  <input type="email" name="sign_email"
                         class="form-control" placeholder="Ends">
                </div>

                <div class="form-group">
                  <label>Description</label> <!-- salasanan syöttö rekisteröityessä -->
                  <textarea rows="3" name="description"
                            class="form-control" style="max-height:50%;"></textarea>
                  <small id="descHelp" class="form-text text-muted">
                    Describe your event in 150 characters. Please do this. Reading these
                    is the only way I feel like I have friends.
                  </small>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
              <div>

            </div>
          </div>

          <div id="archive" class="container tab-pane card-options media">
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
              </div>
              <div>

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
