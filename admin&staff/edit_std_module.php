
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

          <li class="active"><a href="teacher_profile.php"><font color="orange" size="+1"><b><?php echo $username; ?></b></font></a></li>
          <li><a href="logout.php"><span class="icon-lock"></span> LOCK</a></li>
        </ul>
      </div>
    </div>
  </nav><br><br><br><!-- Navigation -->

  <section id="breadcrumb">
    <div class="container">
      <ol class="breadcrumb">
        <li class="active"><a href="teacher.php">HOME /</a> UPDATE STUDENT MODULE</li>
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
            <a href="report_marks.php" class="list-group-item "><span class="icon-pencil"></span> REPORT STUDENT MARKS</a>
            <a href="view_marks.php" class="list-group-item active"><span class="icon-table"></span> VIEW STUDENT MARKS</a>
            <a href="assessment_report.php" class="list-group-item"><span class="icon-book"></span> ASSESSMENT REPORT</a>
          </div>
        </div><!-- /End list group row -->

        <div class="col-md-9">
          <div class="panel panel-default">
            <div class="panel-heading" id="main-bg-color">
              <h3 class="panel-title"><center><span class="icon-book"></span> UPDATE STUDENT MODULE</center></h3>
            </div>
            <div class="panel-body">
              <?php
                $id = $_REQUEST['id'];
                $m_query = mysql_query("SELECT * FROM reported_modules WHERE id='$id' ");
                $m_fetch = mysql_fetch_array($m_query);
              ?>
            <?php
                 if (isset($_GET['update'])) {
                   $id = $_GET['id'];
                   $Newmax = $_GET['Newmax'];
                   $New2sitting = $_GET['New2sitting'];
                   $New2nd_sitting_result = $_GET['New2nd_sitting_result'];
                   $Newcomment_observation = $_GET['Newcomment_observation'];

                   $u_query = mysql_query("UPDATE `reported_modules` SET `max`='$Newmax',`2nd_sitting_piont`='$New2sitting', `2nd_sitting_result`='$New2nd_sitting_result',`mode_comment_observation`='$Newcomment_observation' WHERE id='$id'");

                   if ($u_query) {
                    echo "<div class='col-sm-12 alert alert-success'><center><span class='icon-ok'></span> Module Marks are Successfully Updated !!!!!!!!</center></div>";
                    echo "<meta http-equiv='refresh' content='1;url=view_marks.php'>";
                   }
                   else {
                     echo "<div class='col-sm-12 alert alert-danger'><center><span class='icon-remove'></span> Module Marks has failed to be Updated !!!!!!!!</center></div>".mysql_error();
                   }
                 }

              ?>
               <form role="form" method="get" action="" class="row">
                <div class="col-md-6">
                  <input type="hidden" name="id" class="form-control" value="<?php echo $m_fetch[0]; ?>">
                  <div class="form-group">
                      <label for="text">Student Names:</label>
                      <?php 
                        $sel_s = mysql_query("SELECT * FROM student_tb WHERE id='".$m_fetch['std_id']."' ");
                        $fet_s = mysql_fetch_array($sel_s);
                      ?>
                      <input type="text" class="form-control" value="<?php echo $fet_s['firstname']; echo " "; echo $fet_s['lastname']; ?>" disabled>
                    </div>

                    <div class="form-group">
                      <label for="text">Level:</label>
                      <?php 
                        $sel_l = mysql_query("SELECT * FROM module_tb WHERE id='".$m_fetch['level_id']."' ");
                        $fet_l = mysql_fetch_array($sel_l);
                      ?>
                      <input class="form-control" value="<?php echo $fet_l['level']; ?>" disabled>
                    </div>

                      <div class="form-group">
                      <label for="text">Competence Title:</label>
                      <?php 
                        $sel_c = mysql_query("SELECT * FROM module_tb WHERE id='".$m_fetch['competence_id']."' ");
                        $fet_c = mysql_fetch_array($sel_c);
                      ?>
                      <input type="text" class="form-control" value="<?php echo $fet_c['competence_title']; ?>" disabled >
                    </div>

                    <div class="form-group">
                      <label for="text">Credit / Hour:</label>
                      <?php 
                        $sel_h = mysql_query("SELECT * FROM module_tb WHERE id='".$m_fetch['credit_hour_id']."' ");
                        $fet_h = mysql_fetch_array($sel_h);
                      ?>
                      <input type="text" class="form-control" value="<?php echo $fet_h['credit']; echo '/'; echo $fet_h['hour']; ?>" disabled >
                    </div>

                    <div class="form-group">
                      <label for="text">Year:</label>
                    <input type="text" class="form-control" value="<?php echo $m_fetch['year']; ?>" disabled>
                  </div>

                  </div>

                  <div class="col-md-6">
                  <div class="form-group">
                      <label for="text">Max / 100:</label>
                      <input type="number" class="form-control" name="Newmax" value="<?php echo $m_fetch['max']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="text">2<sup>nd</sup> Sitting Credit Pionts:</label>
                      <input type="number" class="form-control" name="New2sitting" value="<?php echo $m_fetch['2nd_sitting_piont']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="text">2<sup>nd</sup> Sitting Result:</label>
                      <select class="form-control" name="New2nd_sitting_result">
                        <option value="<?php echo $m_fetch['2nd_sitting_result']; ?>" readonly selected><?php echo $m_fetch['2nd_sitting_result']; ?></option>
                        <option>Compitent</option>
                        <option>Not yet Compitent</option>
                      </select>
                    </div>
                    
                    <div class="form-group">
                      <label for="text">Mode Comment / Observation:</label>
                      <select class="form-control" name="Newcomment_observation">
                        <option value="<?php echo $m_fetch['mode_comment_observation']; ?>" readonly selected><?php echo $m_fetch['mode_comment_observation']; ?></option>
                        <option>Excelent</option>
                        <option>Very Good</option>
                        <option>Good</option>
                        <option>Fair</option>
                        <option>Fail</option>
                      </select>
                    </div><br>

                    <div class="form-group">
                      <button type="submit" name="update" class="btn btn-primary btn-block"><span class="icon-save"></span> UPDATE MODULE MARK</button>
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