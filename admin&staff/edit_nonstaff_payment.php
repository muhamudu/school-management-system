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
    <script>
             function Search() {
               var input, filter, table, tr, td, i;
               input = document.getElementById("myInput");
               filter = input.value.toUpperCase();
               table = document.getElementById("myTable");
               tr = table.getElementsByTagName("tr");
               for (i = 0; i < tr.length; i++) {
                 td = tr[i].getElementsByTagName("td")[1];
                 if (td) {
                   if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                     tr[i].style.display = "";
                   } else {
                     tr[i].style.display = "none";
                   }
                 }
               }
             }
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
        <li class="active"><a href="admin.php">DASHBOARD</a> /  NON-STAFF PROFILE</li>
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
            <a href="nonstaff_payment.php" class="list-group-item"><span class="icon-money"></span> NON-STAFF'S PAYMENT</a>
            <a href="report_card.php" class="list-group-item "><span class="icon-book"></span> STUDENT REPORT CARDS</a>
            <a href="unpaid_student2.php" class="list-group-item "><span class="icon-user"></span> UNPAID STUDENTS</a>

          </div>
        </div><!-- /End list group row -->

        <div class="col-md-9">
          <div class="panel panel-default">
            <div class="panel-heading" id="main-bg-color">
              <h3 class="panel-title"><center><span class="icon-group"></span> NON-STAFF PROFILE AND PAYMENT</center></h3>
            </div>
            <div class="panel-body">
              <?php
                  $id=$_REQUEST['id'];
                  $sel=mysql_query("SELECT * FROM non_staff WHERE id='$id'");

                  $row=mysql_fetch_array($sel);
                ?>

                 <?php
                    if(isset($_GET['save_update'])){
                        $id = $_GET['id'];
                        $Newduty = $_GET['Newduty'];
                        $Newage = $_GET['Newage'];
                        $Newsalary = $_GET['Newsalary'];

                        $query = mysql_query("UPDATE non_staff SET duty='$Newduty',age='$Newage',salary='$Newsalary' WHERE id='$id'");
                        if ($query) {
                          echo "<div class='col-sm-12 alert alert-success'><center><span class='icon-ok'></span> None Staff Updates has been saved in the system !!!!!!!!</center></div>";
                          echo "<meta http-equiv='refresh' content='2;url=nonstaff_payment.php'>";
                        }
                        else{
                          echo "<div class='col-sm-12 alert alert-danger'><center><span class='icon-remove'></span> Failed to save update !!!!!!!!</center></div>";
                        }
                    }
                ?>
                <form role="form" method="get" action="" class="row">
                  <div class="col-md-6">
                    <input type="hidden" name="id" class="form-control" value="<?php echo $row[0]; ?>">
                    <div class="form-group">
                      <label for="text">First Name:</label>
                      <input type="text" class="form-control" name="firstname" value="<?php echo $row[firstname]; ?>" disabled>
                    </div>
                      <div class="form-group">
                      <label for="text">Last Name:</label>
                      <input type="text" class="form-control" name="lastname" value="<?php echo $row[lastname]; ?>" disabled>
                    </div>
                    <div class="form-group">
                      <label for="pwd">Duty:</label>
                      <input type="text" name="Newduty" class="form-control" value="<?php echo $row[duty]; ?>">
                    </div>
                      <div class="form-group">
                      <label for="text">Gender:</label>
                      <input type="text" name="gender" class="form-control" value="<?php echo $row[gender]; ?>" disabled>
                    </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                      <label for="pwd">Select Age:</label>
                        <input type="text" class="form-control" name="Newage" value="<?php echo $row[age]; ?>">
                    </div>
                    <div class="form-group">
                      <label for="pwd">Salary:</label>
                      <input type="text" name="Newsalary" class="form-control" value="<?php echo $row[salary]; ?>">
                    </div>
                    <button type="submit" name="save_update" class="btn btn-danger"><span class="icon-save"></span> SAVE UPDATE</button>
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
          var date_input=$('input[name="Newage"]'); //our date input has the name "date"
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
