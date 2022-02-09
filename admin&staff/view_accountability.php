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
  <script>
    function Search() {
      var input, filter, table, tr, td, i;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
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
            <a href="accountability.php" class="list-group-item"><span class="icon-bookmark"></span> ACCOUNTABILITY</a>
          </div>
        </div><!-- /End list group row -->
          
        <div class="col-md-9">
          <div class="panel panel-default">
            <div class="panel-heading" id="main-bg-color">
              <h3 class="panel-title"><center><span class="icon-eye-open"></span> ACCOUNTABILITY VIEWING</center></h3>
            </div>
            <div class="panel-body">
                <!-- Search -->
                <div class="form-group" style="width:40%; float:right;">
                <div class="input-group date">
                    <div class="input-group-addon">
                    <i class="icon-search"></i>
                    </div>
                    <input type="text" onkeyup="Search()" class="form-control pull-right" placeholder="Type Student Name........." id="myInput">
                </div>
                <!-- /.input group -->
                </div><br>
                <!-- /.Search -->
                <div style="overflow-x: auto; width:100%;">
                <h4 align="center"><b>Money Paid By Students In Saint Philip</b></h4>
                    <table class="table table-striped table-bordered table-hover" id="myTable" style="font-size:12px;">
                        <thead>
                        <tr>
                            <th>N<sup>o</sup></th>
                            <th>Student Name</th>
                            <th>Class</th>
                            <th>Year</th>
                            <th>Content</th>
                            <th>Uniforms</th>
                            <th>Seater</th>
                            <th>Leam of Papers</th>
                            <th>Pratical</th>
                            <th>School Card</th>
                            <th>Trip</th>
                            <th>Bed Rent</th>
                            <th>Cleaning Materials</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <?php
                            $query = mysql_query("SELECT * FROM accountabuluty");
                            $count=0;
                            while ($row = mysql_fetch_array($query)) {
                                $sell=mysql_query("SELECT * FROM student_tb WHERE id='".$row[std_id]."'")or die(mysql_error());
                                $fe = mysql_fetch_array($sell);

                                $count++;
                                echo "
                                <tbody>
                                <tr>
                                <td>$count</td>
                                <td>".$fe['firstname']." ".$fe['lastname']."</td>
                                <td>".$row['class']."</td>
                                <td>".$row['year']."</td>
                                <td>".$row['content']."</td>
                                <td>".$row['uniform']."</td>
                                <td>".$row['sweater']."</td>
                                <td>".$row['piece_of_paper']."</td>
                                <td>".$row['practical']."</td>
                                <td>".$row['school_card']."</td>
                                <td>".$row['trip']."</td>
                                <td>".$row['bed_rent']."</td>
                                <td>".$row['cleaning_material']."</td>
                                <td><center>
                                <a href=edit_acc.php?id=".$row['id']."><span class='icon-edit'></span> Edit</a> |
                                <a href=delete_acc.php?id=".$row['id']."><font color='red'><span class='icon-trash'></span> Delete</font></a>
                                </center></td>
                                </tr>
                                </tbody>";
                                echo'
                                ';
                            }
                
                        ?>
                        <tr style="text-align:right; font-weight: bold; font-size: 18px;">
                            <th colspan="5" style="text-align:left;"><b>TOTAL</b></th>
                            <?php
                            $usum = 0;
                            $ssum = 0;
                            $psum = 0;
                            $prsum = 0;
                            $csum = 0;
                            $tsum = 0;
                            $bsum = 0;
                            $msum = 0;
                            $total_amount = 0;

                              $tquery = mysql_query("SELECT * FROM accountabuluty");
                              while($trow = mysql_fetch_array($tquery)){
                                $usum = $usum + $trow['uniform'];
                                $ssum = $ssum + $trow['sweater'];
                                $psum = $psum + $trow['piece_of_paper'];
                                $prsum = $prsum + $trow['practical'];
                                $csum = $csum + $trow['school_card'];
                                $tsum = $tsum + $trow['trip'];
                                $bsum = $bsum + $trow['bed_rent'];
                                $msum = $msum + $trow['cleaning_material'];
                                $total_amount = $usum+$ssum+$prsum+$csum+$tsum+$bsum+$msum;
                              }

                            ?>
                            <td><span class="label label-info"><?php echo "$usum"; ?> <b>Frw</b></font></td>
                            <td><span class="label label-info"><?php echo "$ssum"; ?> <b>Frw</b></font></td>
                            <td><span class="label label-primary"><?php echo "$psum"; ?> <b>Reams</b></font></td>
                            <td><span class="label label-info"><?php echo "$prsum"; ?> <b>Frw</b></font></td>
                            <td><span class="label label-info"><?php echo "$csum"; ?> <b>Frw</b></font></td>
                            <td><span class="label label-info"><?php echo "$tsum"; ?> <b>Frw</b></font></td>
                            <td><span class="label label-info"><?php echo "$bsum"; ?> <b>Frw</b></font></td>
                            <td><span class="label label-info"><?php echo "$msum"; ?> <b>Frw</b></font></td> 
                            <td></td>
                                                  
                        </tr>
                        <tr>
                            <th colspan="5"><font size="+1"><b>AMOUNT</b></font></th>
                            <td colspan="9" style="text-align:center;"><b><font size="+1"><span class="label label-success"><?php echo "$total_amount"; ?> Frw</span></font></b></td>
                        </tr>
                    </table>
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
</body>
</html>