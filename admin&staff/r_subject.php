
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

$sel_teacher = mysql_query("SELECT * FROM teacher_tb WHERE email='$username'");
$row_t = mysql_fetch_array($sel_teacher);
?>
<html>
<head>
  <title>Register Subject / Module</title>
    <link rel="icon" href="../img/sch_sign.PNG" type="image">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="../css/style.css">
    <!-- <link rel="stylesheet" href="../css/bootstrap.css"> -->
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
          td = tr[i].getElementsByTagName("td")[0];
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
        <a class="navbar-brand" href="teacher.php"><img src="../img/sch_sign.png" style="position:absolute; width:40px; top:07px;"> <i style="position:relative; left:45px;">St.PHILIP TVET SCHOOL</i></a>

      </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <form class="navbar-form navbar-left" method="post" action="std_card_teacher.php">
            <div class="input-group">
              <input type="text" class="form-control" name="search_std" size="40" placeholder="Search">
              <div class="input-group-btn">
                <button class="btn btn-default" name="search" type="submit">
                  <i class="icon-search"></i>
                </button>
              </div>
            </div>
          </form>

          <li class="active"><a href="teacher_profile.php"><font color="orange" size="+1"><b><?php echo $row['email']; ?></b></font></a></li>
          <li><a href="logout.php"><span class="icon-lock"></span> LOCK</a></li>
        </ul>
      </div>
    </div>
  </nav><br><br><br><!-- Navigation -->

  <section id="breadcrumb">
    <div class="container">
      <ol class="breadcrumb">
        <li class="active"><a href="teacher.php">HOME</a> / REGISTER SUBJECT AND MODULE / MODULE</li>
      </ol>
    </div>
  </section><!-- Section 1 -->

  <section id="main">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="list-group">
            <a href="teacher.php" class="list-group-item"><span class="icon-list-ul"></span> SUBJECTS LIST</a>
            <a href="r_subject.php" class="list-group-item active"><span class="icon-laptop"></span> REGISTER SUBJECT / MODULE</a>
            <a href="report_marks.php" class="list-group-item "><span class="icon-pencil"></span> REPORT STUDENT MARKS</a>
            <a href="view_marks.php" class="list-group-item "><span class="icon-table"></span> VIEW STUDENT MARKS</a>
            <a href="assessment_report.php" class="list-group-item"><span class="icon-book"></span> ASSESSMENT REPORT</a>
          </div>
        </div><!-- /End list group row -->
          
        <div class="col-md-9">
          <div class="panel panel-default">
            <div class="panel-heading" id="main-bg-color">
              <h3 class="panel-title"><center><span class="icon-list-ul"></span> TEACHER'S MODULES REGISTRATION</center></h3>
            </div>

            <div class="panel-body">
                <!-- Subject registartion form -->
                <?php
                   if(isset($_POST['save']))
                   {
                     $teacher_name = $username;
                     $m_code = $_POST['m_code'];
                     $c_title = $_POST['c_title'];
                     $credit = $_POST['credit'];
                     $hour = $_POST['hour'];
                     $level = $_POST['level'];

                     $query = mysql_query("INSERT INTO `module_tb`(`teacher_email`, `module_code`, `competence_title`, `credit`, `hour`, `level`) VALUES('$teacher_name','$m_code','$c_title','$credit','$hour','$level')");

                     if ($query) {
                      echo "<div class='col-sm-12 alert alert-success'><center><font color='green'><span class='icon-ok'></span>  Module is Successfully registered!!!</font></center></div>";
                     }
                     else {
                       echo "Failed Saved!".mysql_error();
                     }
                   }
                ?>
                  <form role="form" method="post" class="row" action="">
                    <div class="col-md-6">
                      <input type="hidden" class="form-control" name="teacher_name" value="<?php echo $username; ?>" disabled>
                      <div class="form-group">
                      <label >Module Code:</label>
                      <input type="text" class="form-control" name="m_code" placeholder="Module Code" required>
                    </div>
                    <div class="form-group">
                      <label for="pwd">Competence Title:</label>
                        <input type="text" name="c_title" placeholder="Competence Title" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="pwd">Credits:</label>
                        <input type="text" name="credit" placeholder="Credits" class="form-control" required>
                    </div>

                    </div>
                    
                    <div class="col-md-6">
                    <div class="form-group">
                      <label for="pwd">Hour:</label>
                        <input type="number" name="hour" placeholder="Hour" class="form-control" required>
                    </div>
                      <div class="form-group">
                      <label for="email">Level:</label>
                        <select class="form-control" name="level" required>
                           <option value="" disabled selected>Select Level</option>
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
                    <button type="submit" name="save" class="btn btn-primary btn-block"><span class="icon-save"></span>  SAVE SUBJECT</button>
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