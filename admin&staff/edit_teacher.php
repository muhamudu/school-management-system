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

  <script type="text/javascript">
   $(document).ready(function(){
     $('#newclass').change(function(){
       var cl=$('#newclass').val();
       var num=Math.floor((Math.random() * 5000) + 1);
       var me=cl+num;
       $('.getcode').attr('value',me);
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
        <li class="active"><a href="admin.php">DASHBOARD</a> /  UPDATE TEACHER PROFILE</li>
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
            <a href="unpaid_student2.php" class="list-group-item "><span class="icon-user"></span> UNPAID STUDENTS</a>

          </div>
        </div><!-- /End list group row -->

        <div class="col-md-9">
          <div class="panel panel-default">
            <div class="panel-heading" id="main-bg-color">
              <h3 class="panel-title"><center><span class="icon-group"></span> UPDATE TEACHER PROFILE AND PAYMENT</center></h3>
            </div>
            <div class="panel-body">
                <?php
                  $id=$_REQUEST['id'];
                    $seltr = mysql_query("SELECT * FROM teacher_tb WHERE id='$id' ");
                    $fettr = mysql_fetch_array($seltr);

                  
                ?>

                <?php
                    if(isset($_GET['save_update'])){
                        $id = $_GET['id'];
                        $Newemail = $_GET['Newemail'];
                        $Newsalary = $_GET['Newsalary'];

                        $query = mysql_query("UPDATE teacher_tb SET `email`='$Newemail', `salary`='$Newsalary' WHERE id='$id'");
                        if ($query) {
                          echo "<div class='col-md-12 alert alert-success'><center><span class=' icon-ok'></span> Teacher Payment & Information has been Updated!!!</center></div>";
                          echo "<meta http-equiv='refresh' content='2;url=teacher_tb.php'>";
                        }
                        else{
                          echo "<div class='col-md-12 alert alert-danger'><center><span class=' icon-remove'></span> An Error has occurred in Updating Teacher,Please Wait In solving The case of Solving it!!!</center></div>";
                        }
                    }
                ?>
                <form role="form" method="get" action="" >
                <div class="row">
                  <div class="col-md-6">
                    <input type="hidden" name="id" class="form-control" value="<?php echo $fettr[0]; ?>">
                    <div class="form-group">
                      <label for="text">First Name:</label>
                      <input type="text" class="form-control" name="Newfirstname" value="<?php echo $fettr[firstname]; ?>" disabled>
                    </div>
                      <div class="form-group">
                      <label for="text">Last Name:</label>
                      <input type="text" class="form-control" name="Newlastname" value="<?php echo $fettr[lastname]; ?>" disabled>
                    </div>
                      <div class="form-group">
                      <label for="text">Gender:</label>
                      <input type="text" name="Newgender" class="form-control" value="<?php echo $fettr[gender]; ?>" disabled>
                    </div>
                      <div class="form-group">
                      <label for="pwd">Date of birth:</label>
                        <input type="text" class="form-control" name="Newage" value="<?php echo $fettr[age]; ?>" disabled>
                    </div>

                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="pwd">Qualification:</label>
                      <input type="text" name="Newqualification" class="form-control" value="<?php echo $fettr[qualification]; ?>" disabled>
                    </div>

                    <div class="form-group">
                      <label for="pwd">Teacher Email:</label>
                      <input type="text" name="Newemail" class="form-control" value="<?php echo $fettr[email]; ?>" >
                    </div>

                    <div class="form-group">
                      <label for="pwd">Salary:</label>
                      <input type="text" name="Newsalary" class="form-control" value="<?php echo $fettr[salary]; ?>" >
                    </div>
                    
                  </div>
                  
                </div>
                <center><button type="submit" name="save_update" class="btn btn-primary btn-block"><span class="icon-save"></span> SAVE UPDATE</button></center>
                </form>

            </div>
          </div>

        </div>
      </div><!-- /End row  -->
    </div><!-- /End container -->
  </section><!-- / End section 2 -->

    <!-- Footer -->
      <footer id="footer">
        <p> &copy; 2017 Copyright Designed by NDAYISHIMIYE Muhamudu</p>
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
