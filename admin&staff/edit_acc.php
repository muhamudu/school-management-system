<?php
error_reporting("E_NOTICE");
?>
<?php
include('../config.php');
session_start();

if (!isset($_SESSION['user_id'])){
header('location:signup.php');
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
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.min.js"></script>

  <script type='text/javascript'>
    $(document).ready(function(){
      $('#classname').change(function(){
        var classname=$('#classname').val();
        $.ajax({
          url:"report.php",
          type:"post",
          data:"class_id="+classname,
          success:function(msg){
            $('#student_name').html(msg);
          }
        });
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
        <li class="active"><a href="secretary.php">HOME</a> / ACCOUNTABILITY</li>
      </ol>
    </div>
  </section><!-- Section 1 -->

  <section id="main">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="list-group">
            <a href="secretary.php" class="list-group-item "><span class="icon-list-ol"></span> STUDENTS LIST</a>
            <a href="register_student.php" class="list-group-item "><span class="icon-pencil"></span> REGISTER STUDENT</a>
            <a href="paid_student.php" class="list-group-item "><span class="icon-money"></span> PAID STUDENT</a>
            <a href="unpaid_student.php" class="list-group-item "><span class="icon-money"></span> UNPAID STUDENT</a>
            <a href="accountability.php" class="list-group-item"><span class="icon-bookmark"></span> ACCOUNTABILITY</a>
          </div>
        </div><!-- /End list group row -->
          
        <div class="col-md-9">
          <div class="panel panel-default">
            <div class="panel-heading" id="main-bg-color">
              <h3 class="panel-title"><center><span class="icon-bookmark"></span> EDIT ACCOUNTABILITY</center></h3>
            </div>
            <div class="panel-body">
            <?php
                  $id=$_REQUEST['id'];
                  $sel=mysql_query("SELECT * FROM accountabuluty WHERE id='$id'");

                  $row=mysql_fetch_array($sel);
                ?>
                <?php
                 if(isset($_GET['save_updates']))
                 {
                   $id = $_GET['id'];
                   $Newuniform = $_GET['Newuniform'];
                   $Newsweater = $_GET['Newsweater'];
                   $Newpaper = $_GET['Newpaper'];
                   $Newpratical = $_GET['Newpratical'];
                   $Newschool_card = $_GET['Newschool_card'];
                   $Newtrip = $_GET['Newtrip'];
                   $Newbed_rent = $_GET['Newbed_rent'];
                   $Newcleaning_material = $_GET['Newcleaning_material'];

                   $query = mysql_query("UPDATE `accountabuluty` SET `uniform`='$Newuniform',`sweater`='$Newsweater',`piece_of_paper`='$Newpaper',`practical`='$Newpratical',`school_card`='$Newschool_card',`trip`='$Newtrip',`bed_rent`='$Newbed_rent',`cleaning_material`='$Newcleaning_material' WHERE id='$id'");

                   if ($query) {
                    echo "<div class='col-sm-12 alert alert-success'><center><span class='icon-ok'></span> Data are Successfully Updated!!!!!!!!</center></div>";
                    echo "<meta http-equiv='refresh' content='2;url=view_accountability.php'>";
                   }
                   else {
                     echo "<div class='col-sm-12 alert alert-danger'><center><span class='icon-remove'></span> Data failed to be Updated!!!!!!!!</center></div>";
                   }
                 }

              ?>
               <form role="form" method="GET" action="" class="row">
                <div class="col-md-3">
                    <?php
                      $sell=mysql_query("SELECT * from student_tb where id='".$row[std_id]."'")or die(mysql_error());
                      $fe=mysql_fetch_array($sell);
                    ?>

                  <input type="hidden" name="id" class="form-control" value="<?php echo $row[0]; ?>">
                  <div class="thumbnail">
                    <img src="<?php echo 'student_img/'.$fe['profile_picture']; ?>" style="height:28%; width:100%;" alt="" />
                  </div>

                    <div class="form-group">
                      <label for="text">Student Names:</label>
                      <input type="text" class="form-control" name="" value="<?php echo $fe[firstname].' '.$fe[lastname];  ?>" disabled>
                    </div>

                  </div>

                  <div class="col-md-3">
                  <div class="form-group">
                      <label for="text">Class:</label>
                      <input type="text" class="form-control" name="" value="<?php echo $row['class']; ?>" disabled>
                    </div>

                  <div class="form-group">
                      <label for="text">Content:</label>
                      <input type="text" class="form-control" name="" value="<?php echo $row[content]; ?>" disabled>
                    </div>

                    <div class="form-group">
                      <label for="text">Year:</label>
                     <input type="text" class="form-control" name="" value="<?php echo $row[year]; ?>" disabled>
                    </div>

                    <div class="form-group">
                      <label for="text">Unifrom:</label>
                      <input type="text" class="form-control" name="Newuniform" value="<?php echo $row['uniform']; ?> Frw">
                    </div>
                  </div>

                  <div class="col-md-3">
                  <div class="form-group">
                      <label for="text">Sweater:</label>
                      <input type="text" class="form-control" name="Newsweater" value="<?php echo $row[sweater]; ?> Frw">
                    </div>

                  <div class="form-group">
                      <label for="text">Leam Of Papers:</label>
                    <input type="text" class="form-control" name="Newpaper" value="<?php echo $row[piece_of_paper]; ?> Piece">
                  </div>

                  <div class="form-group">
                      <label for="text">Practical:</label>
                    <input type="text" class="form-control" name="Newpratical" value="<?php echo $row[practical]; ?> Frw">
                  </div>

                  <div class="form-group">
                      <label for="text">School Card:</label>
                    <input type="text" class="form-control" name="Newschool_card" value="<?php echo $row[school_card]; ?> Frw">
                  </div>
                  </div>

                  <div class="col-md-3">
                  <div class="form-group">
                      <label for="text">Trip:</label>
                    <input type="text" class="form-control" name="Newtrip" value="<?php echo $row[trip]; ?> Frw">
                  </div>

                  <div class="form-group">
                      <label for="text">Bed Rent:</label>
                    <input type="text" class="form-control" name="Newbed_rent" value="<?php echo $row[bed_rent]; ?> Frw">
                  </div>

                  <div class="form-group">
                      <label for="text">Cleaning Material:</label>
                    <input type="text" class="form-control" name="Newcleaning_material" value="<?php echo $row[cleaning_material]; ?> Frw">
                  </div>

                  <div class="form-group"><br>
                    <button type="submit" name="save_updates" class="btn btn-success btn-block"><span class="icon-save"></span> SAVE UPDATE</button>
                    </div>
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
</html>