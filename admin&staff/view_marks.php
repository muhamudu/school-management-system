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
$t_row=mysql_fetch_array($result);

$username = $t_row['email'];

$sel_teacher = mysql_query("SELECT * FROM teacher_tb WHERE email='$username'");
$row_t = mysql_fetch_array($sel_teacher);
?>
<html>
<head>
  <title>Saint Philip Managment</title>
    <link rel="icon" href="../img/sch_sign.PNG" type="image">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />

    <!-- DataTables -->
  <link href="assets/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="assets/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.min.js"></script>
     <style type="text/css">
        body{
          background: url(../img/bg.jpg);
        }
        .panel-body {
          overflow-y: hidden;
          overflow-x: hidden;
          width: 100%;
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
        <li class="active"><a href="teacher.php">HOME /</a> VIEW STUDENT MARKS</li>
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
              <h3 class="panel-title"><center><span class="icon-table"></span> VIEW STUDENT MARKS</center></h3>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="datatable" style="font-size:12px;">
                    <thead>
                       <tr>
                         <th>N<sup>o</sup></th>
                         <th>Student Name</th>
                         <th>Level</th>
                         <th>Year</th>
                         <th>Competence Title</th>
                         <th>Credit / Hour</th>
                         <th>Max / 100</th>
                         <th>Result</th>
                         <th>2<sup>nd</sup> Sitting Marks</th>
                         <th>2<sup>nd</sup> Sitting Result</th>
                         <th>Action</th>
                       </tr>
                    </thead>
                   <?php

                        $query = mysql_query("SELECT * FROM reported_modules");
                        $count=0;
                        while ($row = mysql_fetch_array($query)) {
                          if ($row['teacher_email'] == $row_t['id']) {
                            $sell=mysql_query("SELECT * FROM student_tb WHERE id='".$row[std_id]."'")or die(mysql_error());
                            $fe=mysql_fetch_array($sell);
                            $teacher_query=mysql_query("SELECT * FROM teacher_tb WHERE id='".$row['teacher_id']."'");
                            $fetch_t=mysql_fetch_array($teacher_query);

                            $subject_query=mysql_query("SELECT * FROM module_tb WHERE id='".$row['credit_hour_id']."' ");
                            $fetch_tt=mysql_fetch_array($subject_query);

                            $sell_subject=mysql_query("SELECT * FROM module_tb WHERE id='".$fetch_tt['id']."' ")or die(mysql_error());
                            $fe_subject=mysql_fetch_array($sell_subject);

                            $hour_p = $row['max'];
                            if ($hour_p<50) {
                              $hour_p = "<font color='red' style='font-weight:bold;'>Not Comp</font>";
                            }
                            else{
                              $hour_p = "<font color='green' style='font-weight:bold;'>Compitent</font> ";
                            }

                              $count++;
                              echo "
                              
                               <tr>
                                 <td>$count</td>
                                 <td>".$fe['firstname']." ".$fe['lastname']."</td>
                                 <td>".$fetch_tt['level']."</td>
                                 <td>".$row['year']."</td>
                                 <td>".$fe_subject['competence_title']."</td>
                                 <td>".$fe_subject['credit']."/".$fetch_tt['hour']."</td>
                                 <td>".$row['max']."</td>
                                 <td font color='green' style='font-weight:bold;'>$hour_p</td>
                                 <td>".$row['2nd_sitting_piont']."</td>
                                 <td><font color='orange'><b>".$row['2nd_sitting_result']."</b></font></td>
                                 <td><center>
                                 <a href=edit_std_module.php?id=".$row['id']."><span class='icon-edit'></span> Edit</a> |
                                 <a href=delete_std_module.php?id=".$row['id']."><font color='red'><span class='icon-trash'></span> Delete</font></a>
                                 </center></td>
                               </tr>";
                          }

                        }
                    ?>

                </table>
              </div>
            
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
<!-- Required datatable js -->
<script src="assets/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/datatables/dataTables.bootstrap4.min.js"></script>
  <!-- Responsive examples -->
  <script src="assets/datatables/dataTables.responsive.min.js"></script>
  <script src="assets/datatables/responsive.bootstrap4.min.js"></script>
</html>
<script>
  $(document).ready(function(){
    $("#datatable").DataTable();
  });
</script>