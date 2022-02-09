<?php
error_reporting("E_NOTICE");
?>
<?php
  include('../config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Saint Philip T.S.S Login</title>
    <link rel="icon" href="../img/sch_sign.PNG" type="image">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../Font-Awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="assets/css/login.css" />
    <link rel="stylesheet" href="assets/plugins/magic/magic.css" />

  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.min.js"></script>

  <style type="text/css">
       body{
          background: url(../img/bg.jpg);
        }
        .loader {
          border: 16px solid #f3f3f3; /* Light grey */
          border-top: 16px solid blue;
          border-right: 16px solid green;
          border-bottom: 16px solid red;
          border-left: 16px solid pink;
          border-radius: 50%;
          width: 20px;
          height: 20px;
          animation: spin 2s linear infinite;
        }

        @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
        }
        .form-signin{
          background-color: white;
          opacity: 0.7;
        }
  </style>
</head>
<body>
  <div class="container">
  <div class="row">
        <div class="col-md-12">
        <div class="tab-content" style="margin-top: -10px;">
        <div id="login" class="tab-pane active">
            <form class="form-signin" method="post" action="">
            <center><img src="../img/sch_sign.PNG" style="width:30%; height:30%;"></center><br>
            <!-- Login Form -->
            <?php

              if (isset($_POST['login']))
              {
              $email=$_POST['email'];
              $level=$_POST['who'];
              $password=md5($_POST['password']);


              $query = mysql_query("SELECT * FROM users_tb WHERE email='$email' AND category='$level' AND password='$password'");
              $numrows = mysql_num_rows($query);

                  //check that at least one row was returned
                  $row=mysql_fetch_array($query);


                  if($row['category']==1){

                session_start();
                $_SESSION['user_id']=$row['id'];

                  echo "<div class='col-md-12 alert alert-success'><center>Wait While Proccessing <img src='../img/load.gif'></center> 
                      </div>";
                      echo "<meta http-equiv='refresh' content='4;url=admin.php'>";
                  }
                  else if($row['category']==2){
                  session_start();
                $_SESSION['user_id']=$row['id'];

                echo "<div class='col-md-12 alert alert-success'><center>Wait While Proccessing <img src='../img/load.gif'></center> 
                </div>";
                echo "<meta http-equiv='refresh' content='4;url=teacher.php'>";
                  }
                else if($row['category']==3){
                  session_start();
                $_SESSION['user_id']=$row['id'];

                echo "<div class='col-md-12 alert alert-success'><center>Wait While Proccessing <img src='../img/load.gif'></center> 
                </div>";
                echo "<meta http-equiv='refresh' content='4;url=secretary.php'>";
                }
                else if($row['category']==4){
                  session_start();
                $_SESSION['user_id']=$row['id'];

                echo "<div class='col-md-12 alert alert-success'><center>Wait While Proccessing <img src='../img/load.gif'></center> 
                </div>";
                echo "<meta http-equiv='refresh' content='4;url=dos.php'>";
                }
                else if($row['category']==5){
                    session_start();
                  $_SESSION['user_id']=$row['id'];
  
                  echo "<div class='col-md-12 alert alert-success'><center>Wait While Proccessing <img src='../img/load.gif'></center> 
                  </div>";
                  echo "<meta http-equiv='refresh' content='4;url=dod.php'>";
                  }
                else {
                  echo "<div class='col-md-12 alert alert-danger'><center>Email or Password is Incorrect!!</center>
                  </div>".mysql_error();
                }
              }

              ?>
              <!-- Reistration Form -->
              <?php
            if(isset($_POST['register']))
            {
              $email=$_POST['r_email'];
              $category=$_POST['r_category'];
              $password=md5($_POST['r_password']);

              $count = 0;
              $query = mysql_query("SELECT * FROM users_tb WHERE email='$email'");
              $count = mysql_num_rows($query);

              if($count != 0)
            {
                echo "<div class='col-md-12 alert alert-info'><center>Email Already Exist!!</center>
                </div>";

            }
              else{
                $sel = mysql_query("SELECT * FROM teacher_tb WHERE email='$email'");
                while($rows = mysql_fetch_assoc($sel)){
                  $dbemail = $rows['email'];
                }

                  if($email == $dbemail)
                  {
                    $query = mysql_query( "INSERT INTO users_tb(email,category,password) VALUES('$email','$category','$password')");
                    if ($query) {
                        echo "<div class='col-md-12 alert alert-success'><center>Successfully Registered!!</center>
                        </div>";
                    }
                    else{
                        echo "<div class='col-md-12 alert alert-danger'><center>Failed to Register!!</center>
                        </div>";
                    }

                  }
                  else{
                    echo "<div class='col-md-12 alert alert-warning'><center>Please!The Headmaster must first Register your Email!!</center>
                        </div>";

                  }
              }
          }
          ?>
                <input type="email" placeholder="Email Address" name="email" class="form-control" required/><br>
                <select class="form-control" name="who" required>
                    <option value="" disabled selected>Position</option>
                    <option value="1">Headmaster</option>
                    <option value="2">Teacher</option>
                    <option value="3">Secretary</option>
                    <option value="4">Dean of studies</option>
                    <option value="5">Dean of discipline</option>
                </select>
                <input type="password" placeholder="Password" name="password" class="form-control" required/>
                <button class="btn text-muted btn-block text-center btn-primary" name="login" type="submit"><span class="icon-key"></span> UNLOCK</button>
            </form>
        </div>
        <div id="signup" class="tab-pane">
            <form class="form-signin" method="post" action="index.php">
            <center><img src="../img/sch_sign.PNG" style="width:30%; height:30%;"></center><br>
                <input type="email" placeholder="E-mail Address" name="r_email" class="form-control" required/><br>
                <select class="form-control"  name="r_category" required>
                    <option value="" disabled selected>Position</option>
                    <option value="2">Teacher</option>
                </select>
                <input type="password" placeholder="Password" name="r_password" class="form-control" required/>
                <button class="btn text-muted btn-block text-center btn-success" name="register" type="submit"><span class="icon-user"></span> REGISTER</button>
            </form>
        </div>
    </div>
    <div class="text-center">
        <ul class="list-inline">
            <li><a class="text-muted" href="#login" data-toggle="tab">Login</a></li>
            <li><a class="text-muted" href="#signup" data-toggle="tab">Signup</a></li>
        </ul>
    </div>
        </div>
  </div><!-- End of Row -->
  </div>

<script src="assets/js/login.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.js"></script>
</body>
</html>
