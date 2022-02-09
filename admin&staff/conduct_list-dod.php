
<?php
include('../config.php');
session_start();

if (!isset($_SESSION['user_id'])){
header('location:index.php');
}
//lOGIN USERNAME INFORMATION
$user_id=$_SESSION['user_id'];

$result=mysql_query("SELECT * FROM users_tb WHERE id='$user_id'")or die("mysql_error".mysql_error());
$row=mysql_fetch_array($result);

$email = $row['email'];
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
        <a class="navbar-brand" href="dod.php"><img src="../img/sch_sign.png" style="position:absolute; width:40px; top:07px;"> <i style="position:relative; left:45px;">St.PHILIP TVET SCHOOL</i></a>

      </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <form class="navbar-form navbar-left" method="post" action="std_card_dod.php">
            <div class="input-group">
              <input type="text" class="form-control" name="search_std" size="40" placeholder="Search">
              <div class="input-group-btn">
                <button class="btn btn-default" name="search" type="submit">
                  <i class="icon-search"></i>
                </button>
              </div>
            </div>
          </form>

          <li class="active"><a href="dod_profile.php"><font color="orange" size="+1"><b><?php echo $row['email']; ?></b></font></a></li>
          <li><a href="logout.php"><span class="icon-lock"></span> LOCK</a></li>
        </ul>
      </div>
    </div>
  </nav><br><br><br><!-- Navigation -->

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="active"><a href="dod.php">HOME</a> / CONDUCT LIST</li>
        </ol>
      </div>
    </section><!-- Section 1 -->

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="dod.php" class="list-group-item"><span class="icon-home"></span> HOME</a>
              <a href="conduct_list-dod.php" class="list-group-item active"><span class="icon-legal"></span> CONDUCT</a>
              <a href="pemission.php" class="list-group-item "><span class="icon-book"></span> PERMISSION</a>
              <a href="punishment.php" class="list-group-item "><span class="icon-book"></span> PUNISHMENT</a>
            </div>
          </div><!-- /End list group row -->
            
          <div class="col-md-9">
            <div class="panel panel-default" id="table-content">
              <div class="panel-heading" id="main-bg-color">
                <h3 class="panel-title"><center><span class="icon-list-alt"></span> STUDENT CONDUCT LIST</center></h3>
              </div>

              <div class="panel-body" style="font-size:12px;">
                <p align="right"><a href="get_std_cond_dod.php" class="btn btn-primary"><i class="icon icon-print"></i> Print</a></p>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover" id="datatable" style="font-size:12px;">
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
                            $sell=mysql_query("SELECT * FROM student_tb WHERE id='".$row['student_name']."'")or die(mysql_error());
                            $fe=mysql_fetch_array($sell);
                        echo "

                        <tr>
                            <td>$count</td>
                            <td>".$fe['firstname']."<br>".$fe['lastname']."</td>
                            <td>".$row['class']."</td>
                            <td>".$row['min_conduct']."</td>
                            <td>".$row['term']."</td>
                            <td>".$row['year']."</td>
                            <td><center><a href=edit-conduct-dod.php?id=".$row['id']."><font color='blue'><span class='icon-edit'> Edit</font></span></a> | <a href=delete-conduct-dod.php?id=".$row['id']."><font color='red'><span class='icon-trash'> Delete</font></span></a></center></td>
                        </tr>
                        ";
                        }
                    ?>

                  </table>
                </div>
              </div>
            </div><!-- ./End Table Data -->

          </div>
        </div><!-- /End row  -->
      </div><!-- /End container -->
    </section><!-- / End section 2 -->

    <!-- Footer -->
    <footer id="footer">
      <p> &copy; 2018 Copyright Designed by NDAYISHIMIYE Muhamudu</p>
      <p>School email: <a href="#">saintphiliptss@gmail.com</a></p>
    </footer><!-- /End Footer -->

    <script src="../js/bootstrap.js"></script>

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