
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

$sel_teacher = mysql_query("SELECT * FROM teacher_tb WHERE email='$username'");
$row_t = mysql_fetch_array($sel_teacher);
?>
<html>
<head>
  <title>Saint Philip Managment</title>
    <link rel="icon" href="../img/sch_sign.PNG" type="image">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="../css/style.css">
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.min.js"></script>
  <script type='text/javascript'>
    $(document).ready(function(){
      $('#classname').change(function(){
        var classname=$('#classname').val();
        $.ajax({
          url:"module.php",
          type:"post",
          data:"class_id="+classname,
          success:function(msg){
            $('#student_name').html(msg);
          }
        });
      });
      $('#classname').change(function(){
        var classname=$('#classname').val();
        var tech_id=$('#tech_id').val();
        $.ajax({
          url:"module.php",
          type:"post",
          data:"class_id2="+classname+"&tech="+tech_id,
          success:function(msg){
            $('#classn').attr('value',msg);
          }
        });
      });
      $('#subject').change(function(){
        var classname=$('#subject').val();
        var classmark=$('#student_name').val();
        $.ajax({
          url:"module.php",
          type:"post",
          data:"subject="+classname,
          success:function(msg){
            $('#test_marks').html(msg);
          }
        });
      });
      $('#subject').change(function(){
        var classname=$('#subject').val();
        var classmark=$('#student_name').val();
        var tech_id=$('#tech_id').val();
        $.ajax({
          url:"module.php",
          type:"post",
          data:"subject3="+classname+"&tech="+tech_id,
          success:function(msg){
            $('#sub').attr('value',msg);
          }
        });
      });

      $('#subject').change(function(){
        var classname=$('#subject').val();
        var classmark=$('#student_name').val();
        $.ajax({
          url:"module.php",
          type:"post",
          data:"subject2="+classname,
          success:function(msg){
            $('#exam_marks').html(msg);
          }
        });
      });

    });
</script>
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
        <a class="navbar-brand" href="teacher.php"><img src="../img/sch_sign.png" style="position:absolute; width:40px; top:07px;"> <i style="position:relative; left:45px;">St.PHILIP TVET SCHOOL</i></a>

      </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <form class="navbar-form navbar-left" method="post" action="std_card_teacher.php">
            <div class="input-group">
              <input type="text" class="form-control" name="search_std" size="40" placeholder="Search">
              <div class="input-group-btn">
                <button class="btn btn-default" name="search" type="submit">
                  <i class="icon-search"></i>
                </button>
              </div>
            </div>
          </form>

          <li class="active"><a href="teacher_profile.php"><font color="orange" size="+1"><b><?php echo $row['email']; ?></b></font></a></li>
          <li><a href="logout.php"><span class="icon-lock"></span> LOCK</a></li>
        </ul>
      </div>
    </div>
  </nav><br><br><br><!-- Navigation -->

  <section id="breadcrumb">
    <div class="container">
      <ol class="breadcrumb">
        <li class="active"><a href="teacher.php">HOME /</a> REPORT STUDENT MARKS</li>
      </ol>
    </div>
  </section><!-- Section 1 -->

  <section id="main">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="list-group">
            <a href="teacher.php" class="list-group-item "><span class="icon-list-ul"></span> SUBJECTS LIST</a>
            <a href="r_subject.php" class="list-group-item "><span class="icon-laptop"></span> REGISTER SUBJECT / MODULE</a>
            <a href="report_marks.php" class="list-group-item active"><span class="icon-pencil"></span> REPORT STUDENT MARKS</a>
            <a href="view_marks.php" class="list-group-item "><span class="icon-table"></span> VIEW STUDENT MARKS</a>
            <a href="assessment_report.php" class="list-group-item"><span class="icon-book"></span> ASSESSMENT REPORT</a>
          </div>
        </div><!-- /End list group row -->

        <div class="col-md-9">
          <div class="panel panel-default">
            <div class="panel-heading" id="main-bg-color">
              <h3 class="panel-title"><center><span class="icon-pencil"></span> REPORT STUDENT MARKS</center></h3>
            </div>
            <div class="panel-body">
            <?php
                 if(isset($_POST['save_marks']))
                 {
                   //$teacher_id = $_POST['teacher_name'];
                   $teacher=$_POST['teacher'];
                   $student_id = $_POST['student_name'];
                   $c_title_id = $_POST['c_title'];
                   $level_id = $_POST['level'];
                   $credit_hour = $_POST['credit_and_hour'];
                   $year = $_POST['year'];
                   $max = $_POST['max'];
                   $credit_point = $credit_hour * $max;

                   $sel_t = mysql_query("SELECT * FROM teacher_tb WHERE email='$username'");
                   $row_t = mysql_fetch_array($sel_t);

                   $check = mysql_query("SELECT * FROM module_tb WHERE teacher_email='$username' AND level='".$_POST['level']."' ") or die(mysql_error());
                   $fclass = mysql_fetch_array($check);

                     $query = mysql_query("INSERT INTO `reported_modules`(`teacher_email`, `std_id`, `level_id`, `competence_id`, `credit_hour_id`, `year`,`credit_point`,`max`) VALUES ('$teacher','$student_id','$level_id','$c_title_id','$credit_hour','$year','$credit_point','$max')");

                     if ($query) {
                      echo "<div class='col-sm-12 alert alert-success'><center><font color='green'><span class='icon-ok'></span> Teacher ".$row_t['lastname'].", Marks are Successfully Saved!</font></center></div>";
                     }
                     else {
                       echo "<font color='red'>Failed Saved!</font>".mysql_error();
                     }

                 }

              ?>
               <form role="form" method="post" action="" class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="text">Teacher Name:</label>
                      <?php
                      $result = mysql_query("SELECT * FROM teacher_tb");
                      while($row = mysql_fetch_array($result)){
                        if($username == $row['email']){
                          echo "
                            <input type='text' disabled class='form-control' name='teacher_name2' title='".$row['lastname']."' value='".$row['firstname']." ".$row['lastname']."'>
                            <input type='hidden' class='form-control' name='teacher' id='tech_id' value='".$row['id']."'>
                          ";
                        }

                      }
                      ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="text">Level:</label>
                      <select class="form-control" id="classname" required>
                        <option value="" selected="">Select Level</option>
                        <?php
                        $result = mysql_query("SELECT * FROM module_tb ");
                        while($row = mysql_fetch_array($result))
                        {
                          if ($username == $row['teacher_email']) {
                            echo "<option value='".$row['level']."' name='classt'>".$row['level']." ".$row['competence_title']."</option>";
                          }
                        }
                        ?>
                      </select>
                      <input type='hidden' name='level' id='classn'>
                    </div>

                    <div class="form-group">
                      <label for="text">Student Names:</label>
                      <select class="form-control" name="student_name" id='student_name'required>
                        <option value="" disabled selected="">Select Student</option>
                      </select>
                    </div>

                      <div class="form-group">
                      <label for="text">Competence Title:</label>
                      <input type='hidden' name='c_title' id='sub'>
                      <select class="form-control"  required id='subject'>
                        <option value="" disabled selected="">Select Competence Title</option>
                        <?php
                      $result = mysql_query("SELECT * FROM module_tb ");
                      while($row = mysql_fetch_array($result))
                      {
                        if ($username == $row['teacher_email']) {
                          echo "<option>".$row['competence_title']."</option>";
                        }
                       }
                      ?>
                      </select>

                    </div>

                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="text">Credit / Hour:</label>
                      <select class="form-control" name="credit_and_hour" required id='test_marks' readonly>
                        <option value="" disabled selected=""></option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="text">Year:</label>
                    <select name="year" class="form-control" required>
                        <option value="" disabled selected>Select Year</option>
                        <?php
                          $year;

                          for ($year= 2014; $year <= date('Y'); $year++) {
                            echo "<option>$year</option>";
                          }

                        ?>
                    </select>
                  </div>
                    <div class="form-group">
                      <label for="text">Max/100:</label>
                      <input type="number" class="form-control" name="max" placeholder="MAX / 100" required>
                    </div><br>

                    <div class="form-group">
                      <button type="submit" name="save_marks" class="btn btn-primary btn-block"><span class="icon-save"></span> SAVE MODULE MARKS</button>
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
</body>
</html>