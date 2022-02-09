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
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="assets/css/bootstrap-fileupload.min.css" />
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
        .panel-body {
          overflow:auto;
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
        <li class="active"><a href="admin.php">DASHBOARD</a> / UPDATE STUDENT</li>
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
              <h3 class="panel-title"><center><span class="icon-list-alt"></span> UPDATE STUDENT</center></h3>
            </div>

            <div class="panel-body">
              <?php
                  $id=$_REQUEST['id'];
                  $sel=mysql_query("SELECT * FROM student_tb WHERE id='$id'");

                  $row=mysql_fetch_array($sel);
                ?>
                 <?php
                  // Upload Image
                  if(isset($_POST['upload'])){
                    $id = $_POST['id'];
                    $profile_image = $_FILES['profile_image']['name'];
                    $location = 'student_img/'.basename($_FILES['profile_image']['name']);

                    $query = mysql_query("UPDATE `student_tb` SET `profile_picture`='$profile_image' WHERE id='$id'");

                    if(move_uploaded_file($_FILES['profile_image']['tmp_name'], $location)){
                      echo "<div class='col-md-12 alert alert-success'><center><span class=' icon-cloud-upload'></span> Student Image has been updated in the system!!!</center></div>";
                      echo "<meta http-equiv='refresh' content='2;url=student_tb.php'>";
                    }
                    else {
                        echo "<div class='col-md-12 alert alert-danger'><center><span class='icon-remove'></span> Student Image was not updated,Its too large!!!</center></d>".mysql_error();
                    }
                  }
                  // Upadte Data
                  if(isset($_POST['save_update'])){
                      $id = $_POST['id'];
                      $Newfirstname = $_POST['Newfirstname'];
                      $Newlastname = $_POST['Newlastname'];
                      $Newclass = $_POST['Newclass'];
                      $Newstudent_id = $_POST['Newstudent_id'];
                      $Newstatus = $_POST['Newstatus'];
                      $Newcard_number = $_POST['Newcard_number'];
                      $Newprovince = $_POST['Newprovince'];
                      $Newdistrict = $_POST['Newdistrict'];
                      $Newsector = $_POST['Newsector'];

                      $query = mysql_query("UPDATE `student_tb` SET `firstname`='$Newfirstname',`lastname`='$Newlastname',`student_ID`='$Newstudent_id',`student_card_number`='$Newcard_number',`class`='$Newclass',`status`='$Newstatus',`province`='$Newprovince',`district`='$Newdistrict',`sector`='$Newsector' WHERE id='$id'");

                      if($query){
                        echo "<div class='col-md-12 alert alert-success'><center><span class=' icon-cloud-upload'></span> Student information has been updated in the system!!!</center></div>";
                        echo "<meta http-equiv='refresh' content='0;url=student_tb.php'>";
                      }
                      else {
                          echo "<div class='col-md-12 alert alert-danger'><center><span class='icon-remove'></span> Student information was not updated in the system!!!</center></div>".mysql_error();
                      }
                  }
              ?>
              <div class="row">
              <form action="" method="post" role="form" enctype="multipart/form-data">
                <div class="col-md-4">
                <input type="hidden" name="id" class="form-control" value="<?php echo $row[0]; ?>">
                <div class="form-group">
                    <label>Profile Picture</label>
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo 'student_img/'.$row['profile_picture']; ?>" alt="" /></div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-file btn-primary"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" value="<?php echo 'student_img/'.$row['profile_picture']; ?>" name="profile_image" /></span> 
                                <button type="submit" name="upload" class="btn btn-success fileupload-exists">Update Now</button>
                            </div>
                        </div>
                  </div>
              </form>
              <form class="form-inline" action="" method="post" role="form">
                <input type="hidden" name="id" class="form-control" value="<?php echo $row[0]; ?>">
                  <div class="form-group">
                    <label for="name">First Name:</label><br>
                    <input type="text" class="form-control" name="Newfirstname" value="<?php echo $row[firstname]; ?>">
                  </div>

                    <div class="form-group">
                    <label for="name">Last Name:</label><br>
                    <input type="text" class="form-control" name="Newlastname" value="<?php echo $row[lastname]; ?>">
                  </div>

                  <div class="form-group">
                    <label for="name">Select Class:</label><br>
                    <select class="form-control" name="Newclass" id='newclass'>
                          <option value="<?php echo $row['class']; ?>"  selected><?php echo $row['class']; ?></option>
                          <option value="L3ACC">L3 ACC</option>
                            <option value="L3CST">L3 CST</option>
                            <option value="L3SFTD">L3 SFTD</option>
                            <option value="L3TOUR">L3 TOUR</option>
                            <option value="L3F&B">L3 F&B</option>
                            <option value="L3C.A">L3 C.A</option>
                            <option value="L4ACC">L4 ACC</option>
                            <option value="L4CST">L4 CST</option>
                            <option value="L4SFTD">L4 SFTD</option>
                            <option value="L4TOUR">L4 TOUR</option>
                            <option value="L4F&B">L4 F&B</option>
                            <option value="L4C.A">L4 C.A</option>
                            <option value="L5ACC">L5 ACC</option>
                            <option value="L5CST">L5 CST</option>
                            <option value="L5SFTD">L5 SFTD</option>
                            <option value="L5TOUR">L5 TOUR</option>
                            <option value="L5F&B">L5 F&B</option>
                            <option value="L5C.A">L5 C.A</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="name">Student ID:</label><br>
                    <input type="text" class="form-control getcode" name="Newstudent_id" value="<?php echo $row[student_ID]; ?>" >
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="name">Gender:</label><br>
                    <input type="text" class="form-control" value="<?php echo $row[gender]; ?>" readonly>
                  </div>

                  <div class="form-group">
                    <label for="name">Date of birth:</label><br>
                    <input type="text" class="form-control" value="<?php echo $row[date_of_birth]; ?>" readonly>
                  </div>

                  <div class="form-group"><br>
                    <label for="name">Year Registered:</label><br>
                    <input class="form-control" value="<?php echo $row[registered_year]; ?>" readonly>
                  </div>

                  <div class="form-group">
                    <label for="name">Father Name:</label><br>
                    <input class="form-control" value="<?php echo $row[father_name]; ?>"  readonly>
                  </div>

                  <div class="form-group">
                    <label for="name">Father Contact:</label><br>
                    <input class="form-control" value="<?php echo $row[father_phone]; ?>" readonly>
                  </div>

                   <div class="form-group">
                    <label for="name">Mother name:</label><br>
                    <input class="form-control" value="<?php echo $row[mother_name]; ?>" readonly>
                  </div>

                 </div>

                  <div class="col-md-4">
                  <div class="form-group">
                    <label for="name">Mother Contact:</label><br>
                    <input class="form-control" value="<?php echo $row[mother_phone]; ?>" readonly>
                  </div>

                  <div class="form-group">
                    <label for="name">Status:</label><br>
                    <select class="form-control" name="Newstatus" value="<?php echo $row[status]; ?>">
                      <option value="<?php echo $row[status]; ?>" readonly  selected><?php echo $row[status]; ?></option>
                      <option value="Active">Acitve</option>
                      <option value="Expelled">Expelled</option>
                      <option value="Left school">Left school</option>
                      <option value="Dead">Dead</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="name">Indentification Card Number:</label><br>
                    <input class="form-control" name="Newcard_number" value="<?php echo $row[student_card_number]; ?>">
                  </div>

                  <div class="form-group">
                    <label for="name">Province:</label><br>
                    <select class="form-control" name="Newprovince">
                      <option value="<?php echo $row[province]; ?>" readonly selected><?php echo $row[province]; ?></option>
                      <option value="Kigali City">Kigali City</option>
                      <option value="North Province">North Province</option>
                      <option value="East Province">East Province</option>
                      <option value="West Province">West Province</option>
                      <option value="South Province">South Province</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="name">District:</label><br>
                    <input class="form-control" name="Newdistrict" value="<?php echo $row[district]; ?>">
                  </div>

                  <div class="form-group">
                    <label for="name">Sector:</label><br>
                    <input class="form-control" name="Newsector" value="<?php echo $row[sector]; ?>">
                  </div>



                  <div class="form-group"><br>
                   <button type="submit" name="save_update" class="btn btn-primary"><span class="icon-save"></span> UPDATE STUDENT</button>
                  </div>
                 </div>
                </form>
              </div>


            </div>
          </div>

        </div>
      </div><!-- /End row  -->
    </div><!-- /End container -->
  </section><!-- / End section 2 -->

    <!-- Footer -->
      <footer id="footer">
        <p> &copy; 2017 Copyright Designed by Saint Philip T.S.S</p>
        <p>School email: <a href="#">saintphiliptss@gmail.com</a></p>
      </footer><!-- /End Footer -->
      <script src="assets/plugins/jasny/js/bootstrap-fileupload.js"></script>
</body>
</html>
