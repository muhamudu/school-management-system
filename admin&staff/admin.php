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
    <link rel="stylesheet" href="assets/datetimepicker/jquery.datetimepicker.css" />

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
        .card {
          width: 60%;
          height: 225px;
          margin: 5px;
          margin-left: 17%;
          border: 2px solid;
          border-color: grey;
          border-radius: 5px;
          background: #F9F9F9;
        }
        .card-header{
          font-weight: bold;
          text-align: center;
          font-size: 18px;
          font-family: "Times New Roman", Times, serif;
        }
        .card-body{
          margin:8px;
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
            <a href="admin.php" class="list-group-item active"><span class="icon-dashboard"></span> DASHBOARD</a>
            <?php
             $numrows = 0;
             $query = mysql_query("SELECT * FROM feedback");
             $numrows = mysql_num_rows($query);
            ?>
            <a href="feedback.php" class="list-group-item "><span class="icon-comment"></span> FEEDBACK<span class="badge"><?php echo "$numrows"; ?></span></a>
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
              <h3 class="panel-title"><center><span class="icon-dashboard"></span> SAINT PHILIP T.S.S DASHBOARD</center></h3>
            </div>
            <div class="panel-body">
              <?php
               $numrows = 0;
               $query = mysql_query("SELECT * FROM student_tb");
               $numrows = mysql_num_rows($query);
              ?>
                <div class="col-md-3">
                 <div class="well bg-color1">
                   <a href="student_tb.php"><h2><font color="white"><i class="icon-group"></i> <?php echo "$numrows"; ?></font></h2>
                   <h4><font color="white">STUDENTS</font></h4></a>
                 </div>
               </div>
               <?php
                 $numrows = 0;
                 $query = mysql_query("SELECT * FROM teacher_tb");
                 $numrows = mysql_num_rows($query);
               ?>

                <div class="col-md-3">
                 <div class="well bg-color2">
                   <a href="teacher_tb.php"><h2><font color="white"><i class="icon-group"></i> <?php echo "$numrows"; ?></font></h2>
                   <h4><font color="white">TEACHERS</font></h4></a>
                 </div>
               </div>
               <?php
                 $numrows = 0;
                 $query = mysql_query("SELECT * FROM non_staff");
                 $numrows = mysql_num_rows($query);
               ?>

                <div class="col-md-3">
                 <div class="well bg-color3">
                   <a href="nonstaff_tb.php"><h2><font color="white"><i class="icon-group"></i>  <?php echo "$numrows"; ?></font></h2>
                   <h4><font color="white">NON-STAFF</font></h4></a>
                 </div>
               </div>

               <?php
                 $numrows = 0;
                 $query = mysql_query("SELECT * FROM feedback");
                 $numrows = mysql_num_rows($query);
               ?>

                <div class="col-md-3">
                 <div class="well bg-color4">
                   <a href="feedback.php"><h2><font color="white"><i class="icon-comment"></i>  <?php echo "$numrows"; ?> </font></h2>
                   <h4><font color="white">FEEDBACK</font></h4></a>
                 </div>
               </div>
                
                <div class="row">
                    <div class="col-md-4">
                      <div class="well well-small" style="margin-top:30px;">
                      <div id="add-event-form">
                        <fieldset style="height:72%; overflow-y: auto;">
                          <?php
                            if(isset($_POST['submit'])){
                              $event = $_POST['event'];
                              $date = $_POST['date'];

                              $e_query = mysql_query("INSERT INTO `evnts_tb`(`event_name`, `date`) VALUES('$event','$date')");
                              if($e_query){
                                echo "<div class='col-sm-12 alert alert-success'><center>Information has been saved!!</center></div>";
                              }
                              else{
                                echo "<div class='col-sm-12 alert alert-danger'><center>An Error has occured!!</center></div>";
                              }
                            }
                          ?>
                          <form method="post" action="admin.php">
                          <legend>Add Events</legend>
                          <input name="event" style="text-align:center;" type="text" placeholder="Event title" class="form-control input-small"><br>
                          <input name="date" style="text-align:center;" type="text" placeholder="Date/Time" id="datetimepicker_dark" class="form-control input-small">
                          <br>
                          <button type="submit" name="submit" class="btn btn-block btn-success"><span class="icon-plus"></span> Add Event</button>
                        </form>
                        <?php 
                          $e_query = mysql_query("SELECT * FROM evnts_tb ORDER BY id DESC");
                          while($e_fetch_row = mysql_fetch_assoc($e_query)){
                            echo "<p class='col-sm-12 alert alert-info'>".$e_fetch_row['date']."<br>".$e_fetch_row['event_name']."<br><a href='remove_event.php?id=".$e_fetch_row['id']."' class='btn btn-danger btn-xs'><i class='icon-trash'></i> Delete</a><hr>
                            </p>";
                          }

                        ?>
                        </fieldset>
                      </div>

                      </div>
                    </div>
                    <!-- Calendar -->
                <?php
                  //Set timezone!!
                  date_default_timezone_set('South Africa Standard');

                  //Get prev & next month
                  if(isset($_GET['ym'])){
                    $ym = $_GET['ym'];
                  }
                  else{
                    //This Month
                    $ym = date('Y-m');
                  }

                  //Check format
                  $timestamp = strtotime($ym, "-01");
                  if($timestamp === false){
                    $timestamp = time();
                  }

                  //Today
                  $today = date('Y-m-d', time());

                  //For H3 title
                  $html_title = date('m / Y', $timestamp);

                  //Create prev & next month.link.....mktime(hour,minute,second,month,day,year)
                  $prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
                  $next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));

                  //Number of days in the month
                  $day_count = date('t', $timestamp);

                  // 0:Sun 1:Mon 2:Tue ...
                  $str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));

                  // Creating Calendar!!
                  $weeks = array();
                  $week = '';

                  //Add empty cell!!
                  $week = str_repeat('<td></td>', $str);

                  for($day = 1;$day <= $day_count;$day++, $str++){
                    $date = $ym.'-'.$day;
                    if($today == $date){
                      $week .= '<td class="today">'.$day;
                    }
                    else{
                      if($day==2)
                      {
                        $week .= '<td>'.$day;
                      }
                      else{
                        $week .= '<td>'.$day;
                      }
                      
                    }
                    $week .= '</td>';

                    //End of the week OR End of the Month
                    if($str % 7 == 6 || $day == $day_count){
                      if($day == $day_count){
                        //Add empty cell
                        $week .= str_repeat('<td></td>', 6 -($str % 7));
                      }
                      $weeks[] = '<tbody><tr>'.$week.'</tr></tbody>';

                      //Prepare for new week
                      $week = '';
                    }
                  }
                ?>
                    <div class="col-md-5 calendar">
                      <h3><a href="?ym=<?php echo $prev; ?>"><i class=" icon-chevron-left"></i></a> <?php echo $html_title; ?> <a href="?ym=<?php echo $next; ?>"><i class=" icon-chevron-right"></i></a></h3>
                      <table class="table table-bordered table-responsive" style="font-size:14px;">
                        <thead>
                          <tr>
                            <th>Sunday</th>
                            <th>Monday</th>
                            <th>Tuesday</th>
                            <th>Wednesday</th>
                            <th>Thursday</th>
                            <th>Friday</th>
                            <th>Saturday</th>
                          </tr>
                        </thead>

                        <?php
                          foreach($weeks as $week){
                            echo $week;
                          }
                        ?>

                      </table>
                    </div>
                  </div><!-- Calendar -->

            </div>
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

     <!-- Calendar -->
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/plugins/fullcalendar-1.6.2/fullcalendar/fullcalendar.min.js"></script>
    <script src="assets/js/calendarInit.js"></script>
    <script src="assets/datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
    <script>
      $(function () { CalendarInit(); });

      $('#datetimepicker12').datetimepicker({
	      beforeShowDay: function(date) {
          if (date.getMonth() == dateToDisable.getMonth() && date.getDate() == dateToDisable.getDate()) {
            return [true, "custom-date-style"];
          }

          return [true, ""];
	      }
      });
      $('#datetimepicker_dark').datetimepicker({theme:'grey'})
    </script>
</body>
</html>
