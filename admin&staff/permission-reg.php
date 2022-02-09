
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
      <link rel="stylesheet" href="assets/datetimepicker/jquery.datetimepicker.css" />
      <!-- <link rel="stylesheet" href="../css/bootstrap.css"> -->
    <!-- <script src="../js/bootstrap.min.js"></script> -->
    <script src="../js/jquery.min.js"></script>

    <script>
        function Search() {
          var input, filter, table, tr, td, i;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          table = document.getElementById("myTable");
          tr = table.getElementsByTagName("tr");
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[3];
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
          <li class="active">HOME / </li>
        </ol>
      </div>
    </section><!-- Section 1 -->

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="dod.php" class="list-group-item"><span class="icon-home"></span> HOME</a>
              <a href="conduct_list-dod.php" class="list-group-item"><span class="icon-legal"></span> CONDUCT</a>
              <a href="pemission.php" class="list-group-item "><span class="icon-book"></span> PERMISSION</a>
              <a href="punishment.php" class="list-group-item "><span class="icon-book"></span> PUNISHMENT</a>
            </div>
          </div><!-- /End list group row -->
            
          <div class="col-md-9">
            <div class="panel panel-default">
              <div class="panel-heading" id="main-bg-color">
                <h3 class="panel-title"><center><span class="icon-legal"></span> STUDENT PERMISSION</center></h3>
              </div>

              <div class="panel-body" style="font-size:12px;">
                  <?php
                    $id = $_REQUEST['id'];

                    $sel = mysql_query("SELECT * FROM student_tb WHERE id='$id' ");
                    $fet = mysql_fetch_array($sel);
                  ?>

                  <?php   
                    if(isset($_POST['save'])){
                        $class = $_POST['class'];
                        $std_id = $fet['id'];
                        $date_time_left = $_POST['date_time_left'];
                        $date_time_return = $_POST['date_time_return'];
                        $place = $_POST['place'];
                        $reason = $_POST['reason'];

                        $c_query = mysql_query("INSERT INTO `permission_tb`(`std_id`, `class`, `date_time_left`, `date_time_return`, `place`, `reason`) VALUES ('$std_id','$class','$date_time_left','$date_time_return','$place','$reason')");

                        if($c_query){
                            echo"<div class='col-sm-12 alert alert-success'><center><span class='icon-ok'></span> Permission has Successfully Saved!!</center></div>";
                        }
                        else{
                            echo"<div class='col-sm-12 alert alert-danger'><center><span class='icon-remove'></span> Permission has failed to be Saved!!</center></div>";
                        }
                    }
                  ?>
                <form method="post" action="">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <img src="student_img/<?php echo $fet['profile_picture']; ?>" style="width: 100%;" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" value="<?php echo "".$fet['firstname']." ".$fet['lastname'].""; ?>" name="std_name" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <input type="text" value="<?php echo $fet['class']; ?>" name="class" class="form-control" readonly>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" id="datetimepicker_grey1" placeholder="Date/Time Left" name="date_time_left">
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" id="datetimepicker_grey2" placeholder="Date/Time Returned" name="date_time_return">
                            </div>

                            <div class="form-group">
                                <input type="text" placeholder="Place location" class="form-control" name="place">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                            <textarea class="form-control" name="reason">Reasons</textarea>
                            </div>
                            <button type="submit" name="save" class="btn btn-success"><i class="icon-save"></i> Save Permission</button>
                        </div>
                    <div>
                </form>
              </div><!-- ./End Panel Body -->
            </div><!-- ./End Panel Default -->

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
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
    <script>
      $('#datetimepicker_grey1').datetimepicker({theme:'grey'});
      $('#datetimepicker_grey2').datetimepicker({theme:'grey'});
    </script>

  </body>
</html>