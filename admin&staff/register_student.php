<?php
error_reporting("E_NOTICE");
?>
<?php
include('../config.php');
session_start();

if (!isset($_SESSION['user_id'])){
header('location:signup.php');
}
//lOGIN USERNAME INFORMATION
$user_id=$_SESSION['user_id'];

$result=mysql_query("select * from users_tb where id='$user_id'")or die("mysql_error".mysql_error());
$row=mysql_fetch_array($result);

$username = $row['email'];
?>
<html>
<head>
  <title>Saint Philip Managment</title>
    <link rel="icon" href="../img/sch_sign.PNG" type="image">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="assets/datetimepicker/dist/css/bootstrap-datepicker3.css">
    <link rel="stylesheet" href="../css/style.css">
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.min.js"></script>
     <style type="text/css">
        body{
          background: url(../img/bg.jpg);
        }
    </style>
    <script type="text/javascript">
      $(document).ready(function(){
        $('.class').change(function(){
          var cl=$('.class').val();
          var num=Math.floor((Math.random() * 5000) + 1);
          var me=cl+num;
          $('#student_id').attr('value',me);
        });
      });
    </script>
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
        <a class="navbar-brand" href="secretary.php"><img src="../img/sch_sign.png" style="position:absolute; width:40px; top:07px;"> <i style="position:relative; left:45px;">St.PHILIP TVET SCHOOL</i></a>

      </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <form class="navbar-form navbar-left" method="post" action="std_card_secretary.php">
            <div class="input-group">
              <input type="text" class="form-control" name="search_std" size="40" placeholder="Search">
              <div class="input-group-btn">
                <button class="btn btn-default" name="search" type="submit">
                  <i class="icon-search"></i>
                </button>
              </div>
            </div>
          </form>

          <li class="active"><a href="secretary_profile.php"><font color="orange" size="+1"><b><?php echo $row['email']; ?></b></font></a></li>
          <li><a href="logout.php"><span class="icon-lock"></span> LOCK</a></li>
        </ul>
      </div>
    </div>
  </nav><br><br><br><!-- Navigation -->

  <section id="breadcrumb">
    <div class="container">
      <ol class="breadcrumb">
        <li class="active"><a href="secretary.php">HOME</a> / REGISTER STUDENT</li>
      </ol>
    </div>
  </section><!-- Section 1 -->

  <section id="main">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="list-group">
            <a href="secretary.php" class="list-group-item "><span class="icon-list-ol"></span> STUDENTS LIST</a>
            <a href="register_student.php" class="list-group-item active"><span class="icon-pencil"></span> REGISTER STUDENT</a>
            <a href="paid_student.php" class="list-group-item "><span class="icon-money"></span> PAID STUDENT</a>
            <a href="unpaid_student.php" class="list-group-item "><span class="icon-money"></span> UNPAID STUDENT</a>
            <a href="accountability.php" class="list-group-item "><span class="icon-bookmark"></span> ACCOUNTABILITY</a>
          </div>
        </div><!-- /End list group row -->

        <div class="col-md-9">
          <div class="panel panel-default">
            <div class="panel-heading" id="main-bg-color">
              <h3 class="panel-title"><center><span class="icon-pencil"></span> STUDENT REGISTRATION FORM</center></h3>
            </div>
            <div class="panel-body">
              <?php

                    if(isset($_POST['save_student']))
                    {
                      $firstname = $_POST['firstname'];
                      $lastname = $_POST['lastname'];
                      $student_id = $_POST['student_id'];
                      $content = $_POST['content'];
                      $status = $_POST['status'];
                      $r_year = $_POST['r_year'];
                      $gender = $_POST['gender'];
                      $date_of_birth = $_POST['date_of_birth'];
                      $class = $_POST['class'];
                      $father_name = $_POST['father_name'];
                      $father_phone = $_POST['father_phone'];
                      $mother_name = $_POST['mother_name'];
                      $mother_phone = $_POST['mother_phone'];
                      $date = date("m/d/Y");

                      if($date_of_birth > $date){
                        echo "<div class='col-sm-12 alert alert-warning'><center>Date of birth inserted is not yet valid on Calendar</center></div>";
                      }
                      else{
                        $sql = "SELECT * FROM student_tb WHERE firstname='$firstname' AND lastname='$lastname'";
                        $query = mysql_query($sql);
                        $numrows = mysql_num_rows($query);
                        if ($numrows != 0) {
                          echo "<div class='col-sm-12 alert alert-warning'><center>Student Already Exist In School Database!</center></div>";
                        }
                        else{
                          $query = mysql_query("INSERT INTO `student_tb`(`firstname`, `lastname`, `student_ID`, `gender`, `date_of_birth`, `class`, `registered_year`, `content`, `status`, `father_name`, `father_phone`, `mother_name`, `mother_phone`) VALUES ('$firstname','$lastname','$student_id','$gender','$date_of_birth','$class','$r_year','$content','$status','$father_name','$father_phone','$mother_name','$mother_phone')");

                        if($query)
                          {
                            echo "<div class='col-sm-12 alert alert-success'><center><span class='icon-ok'></span> Student has Successfully Saved in School Database</center></div>";
                          }
                          else {
                            echo "<div class='col-sm-12 alert alert-danger'><center><span class='icon-remove'></span> Student has not been Saved in School Database</center></div>".mysql_error();
                          }
                        }
                      }
                    }

                    ?>
              <form class="form-inline row" action="" method="post" role="form">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="name">First Name:</label><br>
                    <input type="text" class="form-control" name="firstname" required="First Name is Needed">
                  </div>

                    <div class="form-group">
                    <label for="name">Last Name:</label><br>
                    <input type="text" class="form-control" name="lastname" required="Last Name is Needed">
                  </div>
                    <div class="form-group"><br>
                    <label for="name">Select Class:</label><br>
                        <select class="form-control class" name="class" required="Class is Needed">
                             <option value="" disabled selected>Select Class</option>
                             <option value="L3ACC">L3 ACC</option>
                             <option value="L3CST">L3 CST</option>
                             <option value="L3SFTD">L3 SFTD</option>
                             <option value="L3TOUR">L3 TOUR</option>
                             <option value="L3F&B">L3 F&B</option>
                             <option value="L3C.A">L3 C.A</option>
                             <option value="L4ACC">L4 ACC</option>
                             <option value="L4CST">L4 CST</option>
                             <option value="L4SFTD">L4 SFTD</option>
                             <option value="L4TOUR">L4 TOUR</option>
                             <option value="L4F&B">L4 F&B</option>
                             <option value="L4C.A">L4 C.A</option>
                             <option value="L5ACC">L5 ACC</option>
                             <option value="L5CST">L5 CST</option>
                             <option value="L5SFTD">L5 SFTD</option>
                             <option value="L5TOUR">L5 TOUR</option>
                             <option value="L5F&B">L5 F&B</option>
                             <option value="L5C.A">L5 C.A</option>
                        </select>
                  </div>
                    <div class="form-group">
                    <label for="name">Student Serial number:</label><br>
                    <input type="text" class="form-control" name="student_id" id="student_id" readonly>
                  </div>

                  <div class="form-group">
                    <label for="name">Content:</label><br>
                    <select class="form-control" name="content" >
                      <option value="" disabled selected>Select Content</option>
                      <option value="Daycare">Daycare</option>
                      <option value="Boarding">Boarding</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="name">Status:</label><br>
                    <input type="text" class="form-control" value="Active" name="status" readonly>
                  </div>

                    <div class="form-group"><br>
                    <label for="name">Gender:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="gender" value="Male" checked><label>&nbsp; Male</label>
                    <input type="radio" name="gender" value="Female"><label>&nbsp; Female</label>
                  </div>

                  <div class="form-group"><br>
                    <label for="name">Date of birth:</label><br>
                    <input type="text" class="form-control" name="date_of_birth" id="date" required="Date Of Birth is Needed">
                  </div>

                  <div class="form-group"><br>
                    <label for="name">Year Registered:</label><br>
                    <select class="form-control" name="r_year" required>
                      <?php
                        $date = date('Y');
                        $year;
                        for($year = date('Y'); $year <= $date; $year++){
                          echo"<option>$year</option>";
                        }
                      ?>
                    </select>

                    <div class="form-group"><br>
                      <label for="name">Father Name:</label><br>
                      <input type="text" class="form-control" name="father_name">
                    </div>
                  </div>


                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="name">Father Contact:</label><br>
                    <input type="number" class="form-control" max-length="10" name="father_phone">
                  </div>

                    <div class="form-group">
                    <label for="name">Mother Name:</label><br>
                    <input type="text" class="form-control" name="mother_name">
                  </div>

                    <div class="form-group">
                    <label for="name">Mother Contact:</label><br>
                    <input type="number" class="form-control" max-length="10" name="mother_phone"><br>
                  </div>

                  <div class="form-group"><br>
                   <button type="submit" name="save_student" class="btn btn-primary"><span class="icon-save"></span> SAVE STUDENT</button>
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
          var date_input=$('input[name="date_of_birth"]'); //our date input has the name "date"
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
