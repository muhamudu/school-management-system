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
        <li class="active">HOME</li>
      </ol>
    </div>
  </section><!-- Section 1 -->

  <section id="main">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="list-group">
            <a href="dos.php" class="list-group-item active"><span class="icon-home"></span> HOME</a>
            <a href="class_subjcet.php" class="list-group-item "><span class="icon-pencil"></span> CLASS & SUBJECTS</a>
            <a href="student_conduct.php" class="list-group-item "><span class="icon-legal"></span> STUDENT CONDUCT</a>
            <a href="student_marks.php" class="list-group-item "><span class="icon-book"></span> STUDENT MARKS</a>
            <a href="student_list.php" class="list-group-item "><span class="icon-list-ol"></span> STUDENT LIST</a>
          </div>
        </div><!-- /End list group row -->
          
        <div class="col-md-9">
          <div class="panel panel-default">
            <div class="panel-heading" id="main-bg-color">
              <h3 class="panel-title"><center><span class="icon-home"></span> HOME</center></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12 table-responsive">
                <h5 align="center">STUDENTS CONDUCT</h5>
                    <table class="table table-striped table-bordered table-hover" id="datatable1" style="font-size:12px;">
                        <thead>
                          <tr>
                            <th>N<sup>o</sup></th>
                            <th>Students</th>
                            <th>Class</th>
                            <th>Conduct</th>
                            <th>Term</th>
                            <th>Year</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                      <?php
                            $query = mysql_query("SELECT * FROM conduct_tb");
                            $count = 0;

                            while($row = mysql_fetch_array($query))
                            {
                              $count++;
                              $sell=mysql_query("SELECT * FROM student_tb WHERE id='".$row[student_name]."'")or die(mysql_error());
                              $fe=mysql_fetch_array($sell);
                            echo "

                            <tr>
                              <td>$count</td>
                              <td>".$fe['firstname']."<br>".$fe['lastname']."</td>
                              <td>".$row['class']." ".$row['section']."</td>
                              <td>".$row['min_conduct']."</td>
                              <td>".$row['term']."</td>
                              <td>".$row['year']."</td>
                              <td><center><a href=remove_student_conduct.php?id=".$row['id']."><font color='red'><span class='icon-trash'> Delete</font></span></a></center></td>
                            </tr>
                            ";
                            }
                        ?>

                  </table>
                </div>

                <div class="col-md-12 table-responsive"><hr>
                <h5 align="center">TEACHER'S SUBJECT</h5>
                    <table class="table table-striped table-bordered table-hover" id="datatable2" style="font-size:12px;">
                        <thead>
                          <tr>
                            <th>N<sup>o</sup></th>
                            <th>Teacher</th>
                            <th>Class</th>
                            <th>subject</th>
                          </tr>
                        </thead>
                      <?php
                            $query_t = mysql_query("SELECT * FROM module_tb");
                            $count = 0;

                            while($row_t = mysql_fetch_array($query_t))
                            {
                              $count++;
                              $sell_t=mysql_query("SELECT * FROM teacher_tb WHERE email='$row_t[teacher_email]'")or die(mysql_error());
                              $fe_t=mysql_fetch_array($sell_t);
                              if($row_t['teacher_email']==$fe_t['email']){
                                echo "
                                <tr>
                                  <td>$count</td>
                                  <td>".$fe_t['firstname']."<br>".$fe_t['lastname']."</td>
                                  <td>".$row_t['level']."</td>
                                  <td>".$row_t['module_code']."</td>
                                </tr>
                                ";
                              }
                            }
                        ?>

                  </table>
                </div><!-- column 2 -->
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
    $("#datatable1").DataTable();
    $("#datatable2").DataTable();
  });
</script>