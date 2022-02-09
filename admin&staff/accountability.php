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
        <a class="navbar-brand" href="secretary.php"><img src="../img/sch_sign.png" style="position:absolute; width:40px; top:07px;"> <i style="position:relative; left:45px;">St.PHILIP TVET SCHOOL</i></a>

      </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <form class="navbar-form navbar-left" method="post" action="std_card_secretary.php">
            <div class="input-group">
              <input type="text" class="form-control" name="search_std" size="40" placeholder="Search">
              <div class="input-group-btn">
                <button class="btn btn-default" name="search" type="submit">
                  <i class="icon-search"></i>
                </button>
              </div>
            </div>
          </form>

          <li class="active"><a href="secretary_profile.php"><font color="orange" size="+1"><b><?php echo $row['email']; ?></b></font></a></li>
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
            <a href="accountability.php" class="list-group-item active"><span class="icon-bookmark"></span> ACCOUNTABILITY</a>
          </div>
        </div><!-- /End list group row -->
          
        <div class="col-md-9">
          <div class="panel panel-default">
            <div class="panel-heading" id="main-bg-color">
              <h3 class="panel-title"><center><span class="icon-bookmark"></span> ACCOUNTABILITY</center></h3>
            </div>
            <div class="panel-body">
            <p align="right">
              <a href="view_accountability.php" class="btn btn-default"><span class="icon-eye-open"></span> VIEW ACCOUNTABILITY</a></p>
            <?php
              if(isset($_POST['save_data']))
              {
                $student_id = $_POST['std_name'];
                $class = $_POST['std_class'];
                $content = $_POST['content'];
                $uniform = $_POST['uniform'];
                $year = $_POST['year'];
                $sweater = $_POST['sweater'];
                $paper = $_POST['paper'];
                $pratical = $_POST['pratical'];
                $school_card = $_POST['school_card'];
                $trip = $_POST['trip'];
                $bed_rent = $_POST['bed_rent'];
                $cleaning_material = $_POST['cleaning_material'];

                $query = mysql_query("INSERT INTO `accountabuluty`(`std_id`, `class`, `content`, `year`, `uniform`, `sweater`, `piece_of_paper`, `practical`, `school_card`, `trip`, `bed_rent`, `cleaning_material`) VALUES ('$student_id',' $class','$content','$year','$uniform',$sweater,'$paper','$pratical',$school_card ,'$trip','$bed_rent','$cleaning_material')");

                if($query)
                  {
                    echo "<div class='col-sm-12 alert alert-success'><center><span class='icon-ok'></span> Student Data was Saved in School Database</center></div>";
                    header("location:view_accountability.php");
                  }
                  else {
                    echo "<div class='col-sm-12 alert alert-danger'><center><span class='icon-remove'></span> Student Data was not been Saved in School Database</center></div>".mysql_error();
                  }
              }

            ?>
            <form class="form-inline row" action="" method="post" role="form">
                <div class="col-md-4">
                    <div class="form-group">
                    <?php
                      $sell = mysql_query("SELECT * FROM student_tb");
                      $fetch_row = mysql_fetch_assoc($sell) ;
                    ?>
                    <select class="form-control" name="std_class" id="classname" required>
                      <option value="" disabled selected>Select Class</option>
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

                    <div class="form-group"><br>
                    <select name="std_name" class="form-control pull-right" id='student_name' required>
                      <option disabled selected>Select Student</option>
                    </select>
                  </div>

                  <div class="form-group"><br>
                    <select class="form-control" name="year" required>
                      <option disabled selected>Select Year</option>
                      <?php
                        $date = date('Y');
                        $year;
                        for($year = 2014; $year <= $date; $year++){
                          echo"<option>$year</option>";
                        }
                      ?>
                    </select>
                  </div>

                    <div class="form-group"><br>
                    <select class="form-control" placeholder="Contents" name="content">
                        <option value="" disabled selected>Select Content</option>
                        <option value="Daycare">Daycare</option>
                        <option value="Boarding">Boarding</option>
                    </select>
                  </div>

                  <div class="form-group"><br>
                   <input type="number" class="form-control" placeholder="Uniforms" name="uniform">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <input type="number" class="form-control" placeholder="Sweater" name="sweater" >
                  </div>

                  <div class="form-group"><br>
                    <input type="number" class="form-control" placeholder="Pieace of papers" name="paper" >
                  </div>
                  
                  <div class="form-group"><br>
                    <input type="number" class="form-control" name="pratical" placeholder="Practical">
                  </div>

                  <div class="form-group"><br>
                    <input type="number" class="form-control" name="school_card" placeholder="School Card">
                  </div>

                  <div class="form-group"><br>
                    <input type="number" class="form-control" name="trip" placeholder="Trip">
                  </div>
                </div>

                <div class="col-md-3">
                <div class="form-group">
                    <input type="number" class="form-control" placeholder="Bed Rent" name="bed_rent" >
                  </div>

                  <div class="form-group"><br>
                    <input type="number" class="form-control" placeholder="Cleaning Materials" name="cleaning_material" >
                  </div>

                  <div class="form-group"><br>
                   <button type="submit" name="save_data" class="btn btn-primary"><span class="icon-save"></span> SAVE STUDENT</button>
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