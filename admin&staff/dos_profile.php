<?php
error_reporting("E_NOTICE");
?>
<?php
include('../config.php');
session_start();

if (!isset($_SESSION['user_id'])){
header('location:../login.php');
}
//lOGIN USERNAME INFORMATION
$user_id=$_SESSION['user_id'];

$result=mysql_query("select * from users_tb where id='$user_id'")or die("mysql_error".mysql_error());
$d_row=mysql_fetch_array($result);

$username = $d_row['email'];

?>
<html>
<head>
  <title>Saint Philip Managment</title>
    <link rel="icon" href="../img/sch_sign.PNG" type="image">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="assets/datetimepicker/dist/css/bootstrap-datepicker3.css">
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.min.js"></script>
     <style type="text/css">
        body{
          background: url(../img/bg.jpg);
        }
    </style>
</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="dos.php"><img src="../img/sch_sign.png" style="position:absolute; width:40px; top:07px;"> <i style="position:relative; left:45px;">St.PHILIP TVET SCHOOL</i></a>

      </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <form class="navbar-form navbar-left" method="post" action="std_card_dos.php">
            <div class="input-group">
              <input type="text" class="form-control" name="search_std" size="40" placeholder="Search">
              <div class="input-group-btn">
                <button class="btn btn-default" name="search" type="submit">
                  <i class="icon-search"></i>
                </button>
              </div>
            </div>
          </form>

          <li class="active"><a href="dos_profile.php"><font color="orange" size="+1"><b><?php echo $username; ?></b></font></a></li>
          <li><a href="logout.php"><span class="icon-lock"></span> LOCK</a></li>
        </ul>
      </div>
    </div>
  </nav><br><br><br><!-- Navigation -->

  <section id="breadcrumb">
    <div class="container">
      <ol class="breadcrumb">
        <li class="active"><a href="dos.php">HOME</a> /  DEAN OF STUDIES' PROFILE</li>
      </ol>
    </div>
  </section><!-- Section 1 -->

  <section id="main">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="list-group">
          <a href="dos.php" class="list-group-item"><span class="icon-home"></span> HOME</a>
          <a href="class_subjcet.php" class="list-group-item "><span class="icon-pencil"></span> CLASS & SUBJECTS</a>
          <a href="student_conduct.php" class="list-group-item "><span class="icon-legal"></span> STUDENT CONDUCT</a>
          <a href="student_marks.php" class="list-group-item "><span class="icon-book"></span> STUDENT MARKS</a>
          <a href="student_list.php" class="list-group-item "><span class="icon-list-ol"></span> STUDENT LIST</a>

          </div>
        </div><!-- /End list group row -->

        <div class="col-md-9">
          <div class="panel panel-default">
            <div class="panel-heading" id="main-bg-color">
              <h3 class="panel-title"><center><span class="icon-user"></span> DEAN OF STUDIES' PROFILE</center></h3>
            </div>
            <div class="panel-body">
              <?php
               if (isset($_GET['save_update'])) {
                 $id = $_GET['id'];
                 $Newfirstname = $_GET['Newfirstname'];
                 $Newlastname = $_GET['Newlastname'];
                 $email = $_GET['email'];
                 $gender = $_GET['gender'];
                 $age = $_GET['age'];
                 $Newprovince = $_GET['Newprovince'];
                 $Newdistrict = $_GET['Newdistrict'];
                 $Newsector = $_GET['Newsector'];
                 $phone = $_GET['phone'];
                 $other_phone = $_GET['other_phone'];

                 $a_u_query = mysql_query("UPDATE `dos_tb` SET `firstname`='$Newfirstname',`lastname`='$Newlastname',`email`='$email',`gender`='$gender',`age`='$age',`province`='$Newprovince',`district`='$Newdistrict',`sector`='$Newsector',`phone`='$phone',`other_phone`='$other_phone' WHERE id='$id'");
                 if($a_u_query){
                   echo "<div class='col-md-12 alert alert-success'><center><span class=' icon-ok'></span> Profile Information has been Updated!!!</center></div>";

                 }
                 else{
                     echo"<div class='col-md-12 alert alert-danger'><center><span class=' icon-remove'></span> Profile Information has failed to be Updated!!!</center></div>".mysql_error();
                 }

               }
              ?>
              <?php
                $query = mysql_query("SELECT * FROM dos_tb WHERE email='$username'");
                $row = mysql_fetch_array($query);
              ?>
              <form class="form-inline row" action="dos_profile.php" method="get" role="form">
                <input type="hidden" name="id" value="<?php echo $row[0]; ?>">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">First Name:</label><br>
                    <input type="text" class="form-control" name="Newfirstname" value="<?php echo $row[firstname]; ?>" required>
                  </div>

                    <div class="form-group">
                    <label for="name">Last Name:</label><br>
                    <input type="text" class="form-control" name="Newlastname" value="<?php echo $row[lastname]; ?>" required>
                  </div>

                  <div class="form-group">
                  <label for="name">Email:</label><br>
                  <input type="email" class="form-control" name="email" value="<?php echo $username; ?>" readonly>
                </div>

                <div class="form-group">
                  <label for="name">Phone Number:</label><br>
                  <input type="number" class="form-control" name="phone" value="<?php echo $row[phone]; ?>"  required>
                </div>

                <div class="form-group">
                  <label for="name">Other Phone:</label><br>
                  <input type="number" class="form-control" name="other_phone" value="<?php echo $row[other_phone]; ?>" required>
                </div>

                <div class="form-group">
                  <label for="name">Gender:</label><br>
                  <select class="form-control" name="gender" required>
                    <option value="<?php echo $row[gender]; ?>" readonly selected><?php echo $row[gender]; ?></option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
                </div>

                <div class="col-md-6">

                  <div class="form-group">
                    <label for="name">Date of birth:</label><br>
                    <input type="text" class="form-control" name="age" value="<?php echo $row[age]; ?>" required>
                  </div>

                  <div class="form-group">
                    <label for="name">Province:</label><br>
                    <select class="form-control" name="Newprovince" required>
                      <option value="<?php echo $row[province]; ?>" readonly selected><?php echo $row[province]; ?></option>
                      <option value="Kigali City">Kigali City</option>
                      <option value="North Province">North Province</option>
                      <option value="East Province">East Province</option>
                      <option value="West Province">West Province</option>
                      <option value="South Province">South Province</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="name">District:</label><br>
                    <input class="form-control" name="Newdistrict" value="<?php echo $row[district]; ?>" required>
                  </div>

                  <div class="form-group">
                    <label for="name">Sector:</label><br>
                    <input class="form-control" name="Newsector" value="<?php echo $row[sector]; ?>" required>
                  </div>

                  <div class="form-group"><br>
                   <button type="submit" name="save_update" class="btn btn-primary"><span class="icon-save"></span> UPDATE PROFILE</button>
                  </div>

                </div>
                </form>

                <h3 class="panel-title" style="width:100%; height:30px; text-align:center; padding:6px;" id="main-bg-color">SET NEW PROFILE PASSWORD</h3><br>
                <?php
                 if (isset($_POST['update'])) {
                   $old_password = md5($_POST['old_password']);
                   $Newpassword = md5($_POST['Newpassword']);
                   $Re_password = md5($_POST['Re_password']);

                   $check_pass = mysql_query("SELECT * FROM users_tb WHERE email='$username'");
                   $p_row = mysql_fetch_array($check_pass);
                   if($old_password == $p_row['password']){
                     if(strlen($Newpassword < 6)){
                       if($Re_password == $Newpassword){
                         if($n_query = mysql_query("UPDATE `users_tb` SET `password`='$Newpassword' WHERE email='$username'")){
                          echo "<div class='col-md-12 alert alert-success'><center><span class=' icon-ok'></span> The Password was successfully Updated!!! <font color='red'>Click <a href='logout.php'>LOGOUT</a> to verify you new password</font></center></div>";
                         }
                         else{
                          echo "<div class='col-md-12 alert alert-success'><center><span class=' icon-ok'></span> The Password has failed to bee  Updated!!!</center></div>";
                         }
                       }
                       else{
                        echo "<div class='col-md-12 alert alert-danger'><center><span class=' icon-remove'></span> The Re-Typed password is not equal to the New Password inserted!!!</center></div>";
                       }
                     }
                     else {
                      echo "<div class='col-md-12 alert alert-info'><center><span class=' icon-remove'></span> The New Password must be greater than 6 Characters!!!</center></div>";
                     }
                   }
                   else {
                     echo "<div class='col-md-12 alert alert-warning'><center><span class=' icon-remove'></span> The Old Password Inserted is Incorrect!!!</center></div>";
                   }
                 }
                ?>

              <form action="" method="post" class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="name">Old Passaword:</label><br>
                    <input class="form-control" name="old_password" type="password" required>
                  </div>

                  <div class="form-group">
                    <label for="name">New Password:</label><br>
                    <input class="form-control" name="Newpassword" type="password" required>
                  </div>

                  <div class="form-group">
                    <label for="name">Re-Enter Password:</label><br>
                    <input class="form-control" name="Re_password" type="password" required>
                  </div>

                  <div class="form-group">
                    <button class="btn btn-success btn-block" name="update" type="submit">UPDATE NEW PROFILE PASSWORD</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

        </div>
      </div><!-- /End row  -->
    </div><!-- /End container -->
  </section><!-- / End section 2 -->

    <!-- Footer -->
      <footer id="footer">
        <p> &copy; 2018 Copyright Designed by NDAYISHIMIYE Muhamudu</p>
        <p>School email: <a href="#">saintphiliptss@gmail.com</a></p>
      </footer><!-- /End Footer -->
      <script type="text/javascript" src="assets/datetimepicker/dist/js/bootstrap-datepicker.min.js"></script>
      <script>
        $(document).ready(function(){
          var date_input=$('input[name="age"]'); //our date input has the name "date"
          var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
          var options={
            format: 'mm/dd/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
          };
          date_input.datepicker(options);
        })
      </script>
</body>
</html>
