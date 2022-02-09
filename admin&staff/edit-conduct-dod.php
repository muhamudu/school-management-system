
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
      <!-- <link rel="stylesheet" href="../css/bootstrap.css"> -->
    <!-- <script src="../js/bootstrap.min.js"></script> -->
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
                <h3 class="panel-title"><center><span class="icon-legal"></span> STUDENT CONDUCT</center></h3>
              </div>

              <div class="panel-body" style="font-size:12px;">
                  <?php
                    $id = $_REQUEST['id'];
                    $sel = mysql_query("SELECT * FROM conduct_tb WHERE id='$id' ");
                    $fet = mysql_fetch_array($sel);

                    $get = mysql_query("SELECT * FROM student_tb WHERE id='".$fet['student_name']."' ");
                    $fet_data = mysql_fetch_array($get);
                  ?>

                  <?php   
                    if(isset($_GET['update'])){
                        $id = $_GET['id'];
                        $Newterm = $_GET['Newterm'];
                        $Newyear = $_GET['Newyear'];
                        $Newmin = $_GET['Newmin_marks'];

                        $c_query = mysql_query("UPDATE `conduct_tb` SET `term`='$Newterm',`year`='$Newyear',`min_conduct`='$Newmin' WHERE id='$id' ");

                        if($c_query){
                            echo"<div class='col-sm-12 alert alert-success'><center><span class='icon-ok'></span> Conduct has Successfully Updated!!</center></div>";
                        }
                        else{
                            echo"<div class='col-sm-12 alert alert-danger'><center><span class='icon-remove'></span> Conduct has failed to be Updated!!</center></div>";
                        }
                    }
                  ?>
                <form method="get" action="">
                    <div class="row">
                        <div class="col-md-4">
                          <input type="hidden" name="id" value="<?php echo $fet[0]; ?>">
                            <div class="thumbnail">
                                <img src="student_img/<?php echo $fet_data['profile_picture']; ?>" style="width: 100%;" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" value="<?php echo "".$fet_data['firstname']." ".$fet_data['lastname'].""; ?>" name="std_name" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <input type="text" value="<?php echo $fet['class']; ?>" name="class" class="form-control" disabled>
                            </div>

                            <div class="form-group">
                                <select class="form-control" name="Newyear">
                                    <option value="<?php echo $fet['year']; ?>" readonly selected><?php echo $fet['year']; ?></option>
                                    <?php 
                                    $year;
                                    for($year = 2015; $year<= date('Y'); $year++){
                                        echo"<option value='$year'>$year</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <select class="form-control" name="Newterm">
                                    <option value="<?php echo $fet['term']; ?>" readonly selected><?php echo $fet['term']; ?></option>
                                    <option value="1st term">1st Term</option>
                                    <option value="2nd term">2nd Term</option>
                                    <option value="3rd term">3rd Term</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                              <input type="text" value="<?php echo $fet['max_conduct']; ?>" name="class" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                            <input type="number" class="form-control" value="<?php echo $fet['min_conduct']; ?>" name="Newmin_marks">
                            </div>
                            <button  name="update" class="btn btn-primary btn-block"><i class="icon-save"></i> Upadate Conduct</button>
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

  </body>
</html>