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
    <link rel="stylesheet" href="../css/style.css">
    <!-- Calendar -->
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="assets/plugins/fullcalendar-1.6.2/fullcalendar/fullcalendar.css" />
    <link rel="stylesheet" href="assets/css/calendar.css" />

  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.min.js"></script>
     <style type="text/css">
        body{
          background: url(../img/bg.jpg);
        }
        .well a{
          text-decoration: none;
        }
        .calendar {
          font-family: 'Noto Sans', sans-serif;
          margin-top:0px;
        }
        th {
          height: 30px;
          text-align: center;
          font-weight: 700;
        }
        td{
          height: 70px;
        }
        .today{
          background-color: orange;
        }
        th:nth-of-type(7),td:nth-of-type(7){
          color: blue;
        }
        th:nth-of-type(1),td:nth-of-type(1){
          color: red;
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
        <li class="active">DASHBOARD / </li>
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
            <a href="feedback.php" class="list-group-item active"><span class="icon-comment"></span> FEEDBACK<span class="badge"><?php echo "$numrows"; ?></span></a>
            <a href="article_post.php" class="list-group-item"><span class="icon-pencil"></span> POST ARTICLES</a>
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
              <h3 class="panel-title"><center><span class="icon-comment"></span> VISITORS FEEDBACK OR COMMENTS</center></h3>
            </div>
            <div class="panel-body">
              <div class="alert alert-success" style="height: 54%; overflow-y: scroll;">
                <strong>PARENTS & VISITORS & STUDENTS FEEDBACK</strong><hr>
                <?php
                  $feedback_query = mysql_query("SELECT * FROM feedback ORDER BY time DESC");
                  while ($feedback_row = mysql_fetch_array($feedback_query)) {
                    echo "<font size='+1'><span class='label label-primary'>USERNAME  : ".$feedback_row['name'].", EMAIL  : ".$feedback_row['email']." <br><br>PHONE  : ".$feedback_row['phone']." </font></span><br><br>
                    <p>".$feedback_row['message']."</p>
                    <i class='label label-success'>".$feedback_row['time']."</i> <a href='remove_feedback.php?id=".$feedback_row['id']."' class='btn btn-danger btn-xs'><i class='icon-trash'></i> Delete</a><hr>
                    ";

                  }
                ?>
              </div>

            </div>
          </div>

            </div>
          </div>

        </div>
  </section><!-- / End section 2 -->

    <!-- Footer -->
      <footer id="footer">
        <p> &copy; 2018 Copyright Designed by NDAYISHIMIYE Muhamudu</p>
        <p>School email: <a href="#">saintphiliptss@gmail.com</a></p>
      </footer><!-- /End Footer -->
</body>
</html>
