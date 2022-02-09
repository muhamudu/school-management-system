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
        <li class="active"><a href="admin.php">DASHBOARD</a> / UNPAID STUDENT</li>
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
              <h3 class="panel-title"><center><span class="icon-user"></span> UNPAID STUDENT</center></h3>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="datatable" style="font-size:12px;">
                    <thead>
                       <tr>
                         <th>N<sup>o</sup></th>
                         <th>First Name</th>
                         <th>Last Name</th>
                         <th>Serial N<sup>o</sup></th>
                         <th>Paid Fees</th>
                         <th>Balance</th>
                         <th>School Term</th>
                         <th>Year</th>
                         <th>Class</th>
                         <th>Status</th>
                         <th>Action</th>
                       </tr>
                    </thead>
                   <?php
                        $query = mysql_query("SELECT * FROM student_fees");
                        $count = 0;

                        while($row = mysql_fetch_array($query))
                        {
                          $sel = mysql_query("SELECT * FROM student_tb WHERE id='".$row['std_id']."' ");
                          $fet = mysql_fetch_array($sel);

                          if($row['status'] == 'Daycare'){
                            $fees = 60000;
                          }
              
                          if($row['status'] == 'Boarding'){
                              $fees = 130000;
                          }
                          $balance = $fees - $row['paid_fees'];

                          if($balance > 0){
                            $count++;
                            echo "
                            
                              <tr>
                                <td>$count</td>
                                <td>".$fet['firstname']."</td>
                                <td>".$fet['lastname']."</td>
                                <td>".$fet['student_ID']."</td>
                                <td>".$row['paid_fees']."</td>
                                <td>".$balance."</td>
                                <td>".$row['term']."</td>
                                <td>".$row['year']."</td>
                                <td>".$row['class']."</td>
                                <td>".$row['status']."</td>
                                <td><center><a href=edit_std_payment2.php?id=".$row['id']."><span class='icon-edit'> Edit</span></a> |
                                <a href=delete_std_unpayment2.php?id=".$row['id']."><font color='red'><span class='icon-trash'> Delete</span></font></a></center></td>
                              </tr>
                            ";
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
