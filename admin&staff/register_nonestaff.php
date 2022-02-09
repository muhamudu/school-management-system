<?php
error_reporting("E_NOTICE");
?>
<?php
include('../config.php');
session_start();

if (!isset($_SESSION['user_id'])){
header('location:index.php');
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
        <a class="navbar-brand" href="admin.php"><img src="../img/sch_sign.png" style="position:absolute; width:40px; top:07px;"> <i style="position:relative; left:45px;">St.PHILIP TVET SCHOOL</i></a>

      </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <form class="navbar-form navbar-left" method="post" action="std_card_admin.php">
            <div class="input-group">
              <input type="text" class="form-control" name="search_std" size="40" placeholder="Search">
              <div class="input-group-btn">
                <button class="btn btn-default" name="search" type="submit">
                  <i class="icon-search"></i>
                </button>
              </div>
            </div>
          </form>

          <li class="active"><a href="admin_profile.php"><font color="orange" size="+1"><b><?php echo $row['email']; ?></b></font></a></li>
          <li><a href="logout.php"><span class="icon-lock"></span> LOCK</a></li>
        </ul>
      </div>
    </div>
  </nav><br><br><br><!-- Navigation -->

  <section id="breadcrumb">
    <div class="container">
      <ol class="breadcrumb">
        <li class="active"><a href="admin.php">DASHBOARD</a> /  REGISTER NON-STAFF</li>
      </ol>
    </div>
  </section><!-- Section 1 -->

  <section id="main">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
            <div class="list-group">
            <a href="admin.php" class="list-group-item "><span class="icon-dashboard"></span> DASHBOARD</a>
            <?php
             $numrows = 0;
             $query = mysql_query("SELECT * FROM feedback");
             $numrows = mysql_num_rows($query);
            ?>
            <a href="feedback.php" class="list-group-item "><span class="icon-comment"></span> FEEDBACK<span class="badge"><?php echo "$numrows"; ?></span></a>
            <a href="article_post.php" class="list-group-item "><span class="icon-pencil"></span> POST ARTICLES</a>
            <a href="register_teacher.php" class="list-group-item "><span class="icon-group"></span> REGISTER TEACHER</a>
            <a href="register_nonestaff.php" class="list-group-item active"><span class="icon-group"></span> REGISTER NON-STAFF</a>
            <a href="teacher_payment.php" class="list-group-item "><span class="icon-money"></span> TEACHER'S PAYMENT</a>
            <a href="nonstaff_payment.php" class="list-group-item "><span class="icon-money"></span> NON-STAFF'S PAYMENT</a>
            <a href="report_card.php" class="list-group-item "><span class="icon-book"></span> STUDENT REPORT CARDS</a>
            <a href="unpaid_student2.php" class="list-group-item "><span class="icon-user"></span> UNPAID STUDENTS</a>

          </div>
        </div><!-- /End list group row -->

        <div class="col-md-9">
          <div class="panel panel-default">
            <div class="panel-heading" id="main-bg-color">
              <h3 class="panel-title"><center><span class="icon-group"></span> NONE STAFF RGISTRAION FORM</center></h3>
            </div>
            <div class="panel-body">
              <?php
                 if(isset($_POST['save_data']))
                 {
                   $fname= $_POST['firstname'];
                   $lname= $_POST['lastname'];
                   $duty= $_POST['duty'];
                   $gender=$_POST['gender'];
                   $age=$_POST['age'];
                   $salary = $_POST['salary'];
                   $date = date("m/d/Y");

                    if($age > $date){
                      echo "<div class='col-sm-12 alert alert-warning'><center>Date of birth inserted is not yet valid on Calendar</center></div>";
                    }
                    else {
                      //Query
                      $query = mysql_query("INSERT INTO non_staff(firstname,lastname,duty,gender,age,salary) VALUES('$fname','$lname','$duty','$gender','$age','$salary')");
                      if($query)
                      {
                        echo "<div class='col-sm-12 alert alert-success'><center><span class='icon-ok'></span> Non-staff has Successfully Saved in School Database</center></div>";
                        echo "<meta http-equiv='refresh' content='2;url=nonstaff_payment.php'>";
                      }
                      else
                      {
                        echo "<div class='col-sm-12 alert alert-success'><center><span class='icon-remove'></span> Failed to register Non-staff in School Database</center></div>";
                      }
                    } 
                  }
              ?>
             <form role="form" method="post" action="" class="row">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="text">First Name:</label>
                    <input type="text" class="form-control" name="firstname" placeholder="First Name" required>
                  </div>
                    <div class="form-group">
                    <label for="text">Last Name:</label>
                    <input type="text" class="form-control" name="lastname" placeholder="Last Name" required>
                  </div>
                  <div class="form-group">
                    <label for="pwd">Duty:</label>
                    <input type="text" name="duty" class="form-control" placeholder="duty" required>
                  </div>

                </div>

                  <div class="col-md-6">
                    <div class="form-group">
                    <label for="pwd">Select Age:</label>
                        <input type="text" class="form-control" name="age" id="date" required>
                  </div>
                  <div class="form-group">
                    <label for="text">Gender:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="gender" value="Male" checked>&nbsp;<label for="text">Male</label>
                    <input type="radio" name="gender" value="Female">&nbsp;<label for="text">Female</label>
                  </div>
                    <div class="form-group">
                      <label for="pwd">Salary:</label>
                      <input type="text" name="salary" class="form-control" placeholder="Salary" required>
                    </div>
                    <button type="submit" name="save_data" class="btn btn-success"><span class="icon-save"></span> SAVE</button>
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
