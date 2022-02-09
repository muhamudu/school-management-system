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
    <link rel="stylesheet" href="../css/style.css">

    <!-- DataTables -->
    <link href="assets/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="assets/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.min.js"></script>
     <style type="text/css">
        body{
          background: url(../img/bg.jpg);
        }
        .panel-body {
          overflow: hidden;
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
        <li class="active"><a href="admin.php">DASHBOARD</a> / UPDATE UNPAID STUDENT</li>
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
          <a href="register_nonestaff.php" class="list-group-item "><span class="icon-group"></span> REGISTER NON-STAFF</a>
          <a href="teacher_payment.php" class="list-group-item "><span class="icon-money"></span> TEACHER'S PAYMENT</a>
          <a href="nonstaff_payment.php" class="list-group-item "><span class="icon-money"></span> NON-STAFF'S PAYMENT</a>
          <a href="report_card.php" class="list-group-item "><span class="icon-book"></span> STUDENT REPORT CARDS</a>
          <a href="unpaid_student2.php" class="list-group-item active"><span class="icon-user"></span> UNPAID STUDENTS</a>

          </div>
        </div><!-- /End list group row -->

        <div class="col-md-9">
          <div class="panel panel-default">
            <div class="panel-heading" id="main-bg-color">
              <h3 class="panel-title"><center><span class="icon-user"></span> UPDATE UNPAID STUDENT</center></h3>
            </div>
            <div class="panel-body">
            <?php
                $id = $_REQUEST['id'];
                $sel = mysql_query("SELECT * FROM student_fees WHERE id='$id' ");
                $fet = mysql_fetch_array($sel);

                $std_sel = mysql_query("SELECT * FROM student_tb WHERE id='".$fet['std_id']."' ");
                $std_fet = mysql_fetch_array($std_sel);
                    if(isset($_GET['update']))
                    {
                      $id = $_GET['id'];
                      $Newstatus = $_GET['Newstatus'];
                      $Newterm = $_GET['Newterm'];
                      $Newyear = $_GET['Newyear'];
                      $Newpaidfees = $_GET['Newpaidfees'];

                      $query = mysql_query("UPDATE `student_fees` SET `status`='$Newstatus',`term`='$Newterm',`year`='$Newyear',`paid_fees`='$Newpaidfees' WHERE `id`='$id' ");

                      if($query)
                        {
                          echo "<div class='col-sm-12 alert alert-success'><center><span class='icon-ok'></span> Student data has Successfully updated in School Database</center></div>";
                          echo "<meta http-equiv='refresh' content='2;url=edit_std_payment2.php?id=$_REQUEST[id]'>";
                        }
                        else {
                          echo "<div class='col-sm-12 alert alert-danger'><center><span class='icon-remove'></span> Student has not been updated in School Database</center></div>".mysql_error();
                        }
                    }

                ?>
              <form method="get" action="" class="row">
                    <div class="col-md-6">
                        <div class="thumbnail" style="width: 190px; height: 200px; margin-left:120px;">
                            <img src="student_img/<?php echo $std_fet['profile_picture']; ?>" style="width: 190px; height: 190px;">
                        </div>
                        <input type="hidden" name="id" value="<?php echo $fet[0]; ?>">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="icon-home"></i>
                            </div>
                            <select class="form-control"  disabled>
                                <option value="<?php echo $fet['class']; ?>"><?php echo $fet['class']; ?></option>
                                <option value="L3CSC">L3 CSC</option>
                                <option value="L3TOUR">L3 TOUR</option>
                                <option value="L3HOT">L3 HOT</option>
                                <option value="L3ACC">L3 ACC</option>
                                <option value="L4CSC">L4 CSC</option>
                                <option value="L4TOUR">L4 TOUR</option>
                                <option value="L4HOT">L4 HOT</option>
                                <option value="L4ACC">L4 ACC</option>
                                <option value="L5CSC">L5 CSC</option>
                                <option value="L5TOUR">L5 TOUR</option>
                                <option value="L5HOT">L5 HOT</option>
                                <option value="L5ACC">L5 ACC</option>
                            </select>
                        </div><br>
                        <!-- /.input group -->

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="icon-user"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="<?php echo "".$std_fet['firstname']." ".$std_fet['lastname']; ?>"  disabled >
                      </div><br>
                      <!-- /.input group -->
                    </div>

                      <div class="col-md-6">

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="icon-list"></i>
                            </div>
                            <select class="form-control" name="Newstatus" required>
                                <option value="<?php echo $fet['status']; ?>"><?php echo $fet['status']; ?></option>
                                <option value="Daycare">Daycare</option>
                                <option value="Boarding">Boarding</option>
                            </select>
                        </div><br>
                        <!-- /.input group -->

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="icon-list"></i>
                            </div>
                            <select class="form-control" name="Newterm" required>
                                <option value="<?php echo $fet['term']; ?>"><?php echo $fet['term']; ?></option>
                                <option>1st Term</option>
                                <option>2nd Term</option>
                                <option>3rd Term</option>
                            </select>
                        </div><br>
                        <!-- /.input group -->

                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="icon-calendar"></i>
                          </div>
                          <select class="form-control" name="Newyear" required>
                            <option value="<?php echo $fet['year']; ?>"><?php echo $fet['year']; ?></option>
                            <?php
                              $year;
                              for($year = date('Y'); $year >= 2001; $year--){
                                echo"<option value='$year'>$year</option>";
                              }
                            ?>
                          </select>
                        </div><br>

                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="icon-list"></i>
                          </div>
                          <input type="text" name="Newpaidfees" value="<?php echo $fet['paid_fees']; ?>" class="form-control pull-right">
                        </div><br>
                        <!-- /.input group -->

                        <button type="submit" name="update" class="btn btn-default btn-block"><i class="icon-save"></i> Update payment</button>
                        <!-- /.Button -->
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
