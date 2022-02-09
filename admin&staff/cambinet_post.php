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
    <link rel="stylesheet" href="assets/css/bootstrap-fileupload.min.css" />
    <link rel="stylesheet" href="../css/style.css">

  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.min.js"></script>

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
        <li class="active"><a href="admin.php">DASHBOARD</a> / ARTICLE POST</li>
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
          <a href="article_post.php" class="list-group-item active"><span class="icon-pencil"></span> POST ARTICLES</a>
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
              <h3 class="panel-title"><center><span class="icon-pencil"></span> POST EVENTS,ARTICLES AND OTHERS</center></h3>
            </div>
            <div class="panel-body">
              <ul class="nav nav-tabs">
                <li><a href="article_post.php">EVENT LETTER</a></li>
                <li><a href="event_result.php">EVENT RESULTS</a></li>
                <li><a href="blog_post.php">BLOG POST</a></li>
                <li class="active"><a href="cambinet_post.php">CAMBINET</a></li>
                <li><a href="gallery_post.php">GALLERY</a></li>
              </ul>

              <?php
                if(isset($_POST['cambinet_post'])){
                  $name = $_FILES['image_name']['name'];
                  $fullname = $_POST['fullname'];
                  $position = $_POST['position'];
                  $year = $_POST['year'];
                  $location = 'uploaded-img/'.basename($_FILES['image_name']['name']);

                  $post_query = mysql_query("INSERT INTO `cambinet_tb`(`st_img`, `fullname`, `position`, `year`) VALUES ('$name','$fullname','$position','$year')");

                    if(move_uploaded_file($_FILES['image_name']['tmp_name'], $location)){
                      echo "<div class='col-md-12 alert alert-success'><center><span class=' icon-cloud-upload'></span> Image has been Uploaded!!!</center></div>";
                    }
                    else {
                        echo "<div class='col-md-12 alert alert-danger'><center><span class='icon-remove'></span> An error has occurred in uploading image!!</center></div>".mysql_error();
                    }
                }

              ?>

              <div id="cambinet" class="row">
                <form method="post" action="cambinet_post.php" enctype="multipart/form-data">
                  <div class="col-md-4">
                  <div class="form-group">
                      <label>Profile Picture</label>
                      <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: 60%; height: 120px;"><img src="assets/img/demoUpload.jpg" alt="" /></div>
                        <div class="fileupload-preview fileupload-exists thumbnail" style="width: 60%; height: 120px;"></div>
                          <div>
                            <span class="btn btn-file btn-primary"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="image_name" /></span>
                            <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                          </div>
                      </div>
                  </div>

                  </div>

                  <div class="col-md-5">
                    <div class="form-group">
                      <label for="pwd">Fullname:</label>
                        <input type="text" placeholder="Enter Fullname" name="fullname" class="form-control">
                    </div>

                    <div class="form-group">
                      <label for="pwd">position:</label>
                        <input type="text" placeholder="Enter Enter Position" name="position" class="form-control">
                    </div>

                    <div class="form-group">
                      <label for="pwd">Year:</label>
                        <select name="year" class="form-control">
                            <?php 
                                for($year = date('Y'); $year >= 2000; $year--){
                                    echo "<option>$year</option>";
                                } 
                            ?>
                        </select>
                    </div>

                    <button type="submit" name="cambinet_post" class="btn btn-primary"><span class="icon-pencil"></span> POST</button>
                  </div>
                </form>

                <div class="col-md-12"><br>
                    <div class="alert alert-success">
                        <strong>
                            School Cambinet Posted 
                            <?php 
                                for($year = date('Y'); $year <= date('Y'); $year++){
                                    echo "$year";
                                } 
                            ?>
                            </strong><hr>

                        <div class='row'>
                        <?php
                          $sel = mysql_query("SELECT * FROM cambinet_tb ORDER BY id ASC ");
                          while($sel_query = mysql_fetch_array($sel) )
                          {
                             echo "

                                <div class='col-md-3'>
                                  <div class='thumbnail' style='width:100%;'>
                                  <span class='label label-success' style='position:absolute;'>".$sel_query['time']."</span>
                                  <img style='width:100%;' src='uploaded-img/".$sel_query['st_img']."' />
                                  <h5 align='center'><b>".$sel_query['fullname']."</b></h5>
                                  <h5 align='center'><b>".$sel_query['position']."</b></h5>
                                  <a href=remove_candidate.php?id=".$sel_query['id']." class='btn btn-success btn-xs btn-block'><i class='icon-trash'></i> Remove</a>
                                  </div>

                                </div>
                              ";
                          }
                        ?>

                      </div><hr>
                    </div>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div><!-- /End row  -->
    </div><!-- /End container -->
  </section><!-- / End section 2 -->
  <script src="assets/plugins/jasny/js/bootstrap-fileupload.js"></script>
    <!-- Footer -->
      <footer id="footer">
        <p> &copy; 2018 Copyright Designed by NDAYISHIMIYE Muhamudu</p>
        <p>School email: <a href="#">saintphiliptss@gmail.com</a></p>
      </footer><!-- /End Footer -->
</body>
</html>
