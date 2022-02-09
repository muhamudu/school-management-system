<?php
error_reporting("E_NOTICE");
?>
<?php
include('../config.php');
session_start();

if (!isset($_SESSION['user_id'])){
header('location:../index.php');
}
//lOGIN USERNAME INFORMATION
$user_id=$_SESSION['user_id'];

$result=mysql_query("select * from users_tb where id='$user_id'")or die("mysql_error".mysql_error());
$row=mysql_fetch_array($result);

$username = $row['email'];

$sel_secretary = mysql_query("SELECT * FROM secretary_tb WHERE email='$username'");
$row_s = mysql_fetch_array($sel_secretary);
?>
<html>
<head>
  <title>Saint Philip Managment</title>
    <link rel="icon" href="../img/sch_sign.PNG" type="image">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.min.js"></script>

  <!-- DataTables -->
  <link href="assets/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="assets/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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

          <li class="active"><a href="secretary_profile.php"><font color="orange" size="+1"><b><?php echo $username; ?></b></font></a></li>
          <li><a href="logout.php"><span class="icon-lock"></span> LOCK</a></li>
        </ul>
      </div>
    </div>
  </nav><br><br><br><!-- Navigation -->

  <section id="breadcrumb">
    <div class="container">
      <ol class="breadcrumb">
        <li class="active">HOME / </li>
      </ol>
    </div>
  </section><!-- Section 1 -->

  <section id="main">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="list-group">
            <a href="secretary.php" class="list-group-item active"><span class="icon-list-ol"></span> STUDENTS LIST</a>
            <a href="register_student.php" class="list-group-item "><span class="icon-pencil"></span> REGISTER STUDENT</a>
            <a href="paid_student.php" class="list-group-item "><span class="icon-money"></span> PAID STUDENT</a>
            <a href="unpaid_student.php" class="list-group-item "><span class="icon-money"></span> UNPAID STUDENT</a>
            <a href="accountability.php" class="list-group-item "><span class="icon-bookmark"></span> ACCOUNTABILITY</a>
          </div>
        </div><!-- /End list group row -->

        <div class="col-md-9">
          <div class="panel panel-default">
            <div class="panel-heading" id="main-bg-color">
              <h3 class="panel-title"><center><span class="icon-list-ol"></span> SCHOOL STUDENTS LIST</center></h3>
            </div>
            <div class="panel-body">
              <p align="right"><a href="get_student_list.php" class="btn btn-primary"><i class="icon-print"></i> Print</a></p>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="datatable" style="font-size:12px;">
                    <thead>
                       <tr>
                         <th>Image</th>
                         <th>First Name</th>
                         <th>Last Name</th>
                         <th>Gender</th>
                         <th>Age</th>
                         <th>Class</th>
                         <th>Father Name</th>
                         <th>Phone Number</th>
                         <th>Action</th>
                       </tr>
                    </thead>
                   <?php
                        $query = mysql_query("SELECT * FROM student_tb  ORDER BY firstname ASC");
                        while($row = mysql_fetch_array($query))
                        {
                        echo "

                         <tr>
                           <td><img src='student_img/".$row['profile_picture']."' style='height:50px; width:50px;'></td>
                           <td>".$row['firstname']."</td>
                           <td>".$row['lastname']."</td>
                           <td>".$row['gender']."</td>
                           <td>".$row['date_of_birth']."</td>
                           <td>".$row['class']." ".$row['section']."</td>
                           <td>".$row['father_name']."</td>
                           <td>".$row['father_phone']."</td>
                           <td><center><a href=edit_student.php?id=".$row['id']."><span class='icon-edit'> Edit</span></a> | <a href=delete_student.php?id=".$row['id']."><font color='red'><span class='icon-trash'> Delete</font></span></a></center></td>
                         </tr>
                        ";
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
