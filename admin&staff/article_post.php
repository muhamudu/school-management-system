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
  <script src="ckeditor/ckeditor.js"></script>
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
                <li class="active"><a href="article_post.php">EVENT LETTER</a></li>
                <li><a href="event_result.php">EVENT RESULTS</a></li>
                <li><a href="blog_post.php">BLOG POST</a></li>
                <li><a href="cambinet_post.php">CAMBINET</a></li>
                <li><a href="gallery_post.php">GALLERY</a></li>
              </ul><br>
              <?php
              if(isset($_POST['post_message'])){
                if(!empty($_POST['message'])){
                  $message = $_POST['message'];

                  $p_query = mysql_query("INSERT INTO `babyeyi_post`(`message`) VALUES ('$message')");
                  if($p_query){
                    echo "<div class='col-sm-12 alert alert-success'><center><span class='icon-ok'></span>  Data is Successfully Posted</center></div>";
                    
                  }
                  else{
                    echo "<div class='col-sm-12 alert alert-danger'><center><span class='icon-remove'></span> Failed to Post Data</center></div>".mysql_error();
                  }
                }else{
                  echo "<div class='col-sm-12 alert alert-warning'><center><span class='icon-remove'></span> Please Fill in the Textarea!!!</center></div>";
                }
                      }
                    ?>

              <div class="row">
                <div class="col-md-12">
                  <div>
                    <form method="post" class="well" enctype="multipart/form-data" action="">
                      <div class="form-group">
                          <textarea name="message"></textarea>
                      </div>
					  
                      <script>
                        CKEDITOR.replace( 'message' );
                      </script>
                      <button type="submit" class="btn btn-primary" name="post_message">Post</button>
                    </form>
                  </div>
                </div>

                <div class="col-md-12"><br>
                  <div class="panel-group">
                    <div class="panel panel-info">
                      <div class="panel-heading">Parents Messages(Babyeyi)</div>
                      <div class="panel-body">
                        <?php
                          $d_p_query = mysql_query("SELECT * FROM babyeyi_post order by id desc limit 1");
                          while($d_p_row = mysql_fetch_array($d_p_query)){
                            echo"<p>".$d_p_row['message']."<br><br><span class='label label-warning'>".$d_p_row['time']."</span><hr></p>";
                          }
                        ?>
                      </div>
                    </div>
                  </div>
                <div>

              </div><!-- Post row -->




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
