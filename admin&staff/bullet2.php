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
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Progresive School Report</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="../img/sch_sign.PNG" type="image">
	<link  rel="stylesheet" type="text/css" media="screen" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />

	<link rel="stylesheet" href="print.css" />

	<style type="text/css">
		body {
			margin: 0;
			padding: 0;
			background-color: grey;
		}
	</style>

</head>
<body>
	<div class="bar">
	<?php
		if(isset($_POST['search_assessment']))
		{
			$std_class = $_POST['class2'];
			$std_name = $_POST['student_name2'];
			$sch_year = $_POST['year2'];

			$st_query=mysql_query("SELECT * FROM `student_tb` WHERE `id`='$std_name' ");
			$fetch_student=mysql_fetch_array($st_query);

			$req_query=mysql_query("SELECT * FROM `reported_modules` WHERE `year`='$sch_year' AND `std_id`='$std_name'");
			$fetch_re_marks=mysql_fetch_array($req_query);

			$class_query=mysql_query("SELECT * FROM `module_tb` WHERE `level`='$std_class'");
			$class_row=mysql_fetch_array($class_query);
			?>
			<form action="print-bullet.php" method="post">
				<input type="hidden" name="class2" value="<?php echo $std_class; ?>">
				<input type="hidden" name="student_name2" value="<?php echo $std_name; ?>">
				<input type="hidden" name="year2" value="<?php echo $sch_year; ?>">
				<button class="get" name="search_assessment" id="print"><i class="icon-cloud-download"></i></button>
			</from>
			<?php
		}
	?>
	</div>
<div class="container">
	<?php
	if(isset($_POST['search_assessment']))
	{
		$std_class = $_POST['class2'];
		$std_name = $_POST['student_name2'];
		$sch_year = $_POST['year2'];

		$st_query=mysql_query("SELECT * FROM `student_tb` WHERE `id`='$std_name' ");
		$fetch_student=mysql_fetch_array($st_query);

		$req_query=mysql_query("SELECT * FROM `reported_modules` WHERE `year`='$sch_year' AND `std_id`='$std_name'");
		$fetch_re_marks=mysql_fetch_array($req_query);

		$class_query=mysql_query("SELECT * FROM `module_tb` WHERE `level`='$std_class'");
		$class_row=mysql_fetch_array($class_query);



		
	?>
	
	<!-- HEADINGS -->
	<div>
		<div class="row">
			<div class="col-md-2">
				<img src="../img/sch_sign.PNG" width="130" height="130" style="margin-left: 40px;">
			</div>

			<div class="col-md-4">
				<p><b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REPUBLIC OF RWANDA<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MINISTRY OF EDUCATION<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Saint Philip TVET School<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P.O.Box 1692 Kigali, Rwanda<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;stphiliptvet012@gmail.com<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+250 788 565 100</b>
				</p>
				
			</div>

			<div class="col-md-6">
				<img src="student_img/<?php echo $fetch_student['profile_picture']; ?>" width="120" height="120" align="right">
			</div>

		</div><!-- 1st Heading Row -->
		<h3 align="center"><u>TRAINEE'S ASSESSMENT REPORT</u></h3>

		<div class="row" style="margin-left:08%; font-size: 17px;">
			<div class="col-md-3">
				<p> Name Of Student<br>
					Class <br>
					Student Serial Number<br>
					Date of birth<br> 
				</p>
			</div>

			<div class="col-md-4">
				<p>
					<b>
						<?php echo $fetch_student['firstname']." ".$fetch_student['lastname']; ?><br>
						<?php echo $class_row['level']; ?> <br>
						<?php echo $fetch_student['student_ID']; ?><br>
						<?php echo $fetch_student['date_of_birth']; ?><br> 
					</b>
				</p>
			</div>
			<div class="col-md-2">
				<p>
					Gender <br>
					School Year <br>
					School Term  <br>
					Behavior
				</p>
			</div>
			<?php
				$sel_cond = mysql_query("SELECT * FROM `conduct_tb` WHERE `student_name`='$fetch_student[id]' AND `class`='$std_class' AND `year`='$sch_year' "); 
				$fet_cond = mysql_fetch_array($sel_cond);
			?>
			<div class="col-md-2">
				<p>
					<b>
						<?php echo $fetch_student['gender']; ?> <br>
						<?php echo $fetch_re_marks['year']; ?> <br>
						Final Report <br>
						<?php echo "".$fet_cond['min_conduct']." / ".$fet_cond['max_conduct'].""; ?>
					</b>
				</p>
			</div>
		</div><!-- 2nd Heading Row -->
		
	</div><!-- /. END HEADINGS -->
	<?php
		if($std_name = $fetch_re_marks['std_id'] AND $sch_year=$fetch_re_marks['year'] AND $std_class= $class_row['level']){
	?>
				<!-- TABLE MARKS -->
			<table style="width:100%;" border="1">
				<tr style="text-size:1em; text-align: center;">
					<th rowspan="2" style="width: 3%; text-align: left;">N<sup>o</sup></th>
					<th rowspan="2" style="width: 9%; text-align: left;">Module Code</th>
					<th rowspan="2" style="width: 25%; text-align: left;">Competence Title</th>
					<th rowspan="2">Credit / Hour</th>
					<th colspan="3">Assessment</th>
					<th colspan="2">Re assessment</th>
					<th colspan="1">Comment / Observation</th>
				</tr>
                <tr>
                    <th>Credit Point</th>
					<th>Max/100</th>
                    <th>Result</th>
                    <th>Credit Point</th>
                    <th>Result</th>
                    <th>On each mode</th>
                </tr>
                <?php
					$count = 0;
					$total_credit = 0;
					$total_points = 0;
					$holder = array();
                    $r_query = mysql_query("SELECT * FROM reported_modules WHERE std_id='$std_name' AND year='$sch_year' ");
                    while($r_fet = mysql_fetch_array($r_query)){
                        $count++;
                        $m_query = mysql_query("SELECT * FROM module_tb WHERE id='".$r_fet['competence_id']."' ");
						$m_fet = mysql_fetch_array($m_query);
						
						$total_credit = $total_credit + $m_fet['credit'];
						$credit_point = $m_fet['credit'] * $r_fet['max'];
						$total_points = $total_points + $credit_point;
						$percentage = $total_points / $total_credit;
						$percentage = number_format($percentage, 2);

						$sortvalue = $count;
						$holder[$sortvalue] = $percentage;

                        $c_p = $r_fet['max'];
                        $hour_p = $m_fet['hour']/2;
                ?>
                <tr>
                    <td style="text-align: right;"><?php echo "<p>0$count</p>"; ?></td>
                    <td><?php echo "<p>".$m_fet['module_code']."</p>"; ?></td>
                    <td><?php echo "<p>".$m_fet['competence_title']."</p>"; ?></td>
                    <td style="text-align: right;"><?php echo "<p>".$m_fet['credit']."</p>";  ?></td>
                    <td style="text-align: right;"><?php echo "<p><b>".$credit_point."</b></p>"; ?></td>
					<td style="text-align: right;"><?php echo "<p><b>".$r_fet['max']."%</b></p>"; ?></td>
                    <?php
                        if($c_p<50)
                        {
                            echo "
                                <td><p align='center'>Not yet Comp</p></td>
                            ";
                        }
                        else{
                            echo "
                                <td><p align='center'>Compitent</p></td>
                            ";
                        }
                    ?>
                    <td style="text-align: right;"><?php echo "<p><b>".$r_fet['2nd_sitting_piont']."</b></p>"; ?></td>
					<td><?php echo "<p align='center'>".$r_fet['2nd_sitting_result']."</p>"; ?></td>
                    <?php
                        if($c_p<50)
                        {
                            echo "
                                <td><p align='center'>Fail</p></td>
                            ";
                        }
                        else{
                            echo "
                                <td><p align='center'>Pass</p></td>
                            ";
                        }
                    ?>
                </tr>
                <?php
					}
					ksort($holder);
                ?>
				<tr>
                    <td colspan="2"><b>Total</b></td>
					<td colspan="1"></td>
					<td style="text-align: right;" colspan="1"><?php echo "$total_credit"; ?></td>
					<td style="text-align: right;" colspan="1"><b><?php echo "$total_points"; ?></b></td>
					<td style="text-align: right;" colspan="1"></td>
					<td style="text-align: right;" colspan="1"></td>
					<td style="text-align: right;" colspan="1"></td>
					<td style="text-align: right;" colspan="1"></td>
					<td style="text-align: right;" colspan="1"></td>
				</tr>
				<tr>
					<td colspan="3"><b>Percentage</b></td>
					<td style="text-align: right;" colspan="7"><center><b><?php	echo "".$percentage."%";	?></b></center>	</td>
				</tr>

				<tr>
					<td colspan="3"><b>Position</b></td>
					
					<?php
						$numrows = 0;
						$query = mysql_query("SELECT * FROM student_tb WHERE class='$std_class' ");
						$numrows = mysql_num_rows($query);

						$sort = 0;
						$pos = mysql_query("SELECT * FROM student_tb WHERE class='$std_class' ");
						while($position = mysql_fetch_array($pos)){
							$sort = mysql_num_rows($query);
						}
					?>
					<td style="text-align: right;" colspan="7">
						<center><b>
							<?php 
								// foreach(array_keys($holder) as $keyval){
								// 	echo "$holder[$keyval]";
								// }
							?> ..... / 
							<?php echo $numrows; ?></b>
						</center></td>
				</tr>

                <tr>
                    <td colspan="10" style="height: 60px;">Feedback/Obseravtions(Class Trainer)</td>
                </tr>
				<tr>
                    <td colspan="10"><b>Name of school Manager: NYIRARUGWIRO Mariane</b></td>
                </tr>
                <tr>
                    <td colspan="8" style="height: 60px;"><b>Signature & Stamp</b></td>
					<td colspan="2"><?php $date = date("d / m / Y"); echo "<b>Date: $date</b>"; ?></td>
                </tr>
			</table><!-- /. END TABLE MARKS --><br>
	<?php
		}
		else{
			?>
				<div class="alert alert-warning">
					<center><h4><b><?php echo $fetch_student['firstname']." ".$fetch_student['lastname']; ?>'s</b> report you requested is Invalid, because the year inserted is invalid in the school Database..!!</h4></center>
				</div>
			<?php
		}
	}
	?>
 </div><!-- Container -->
</body>
<script src="../js/bootstrap.min"></script>
<script src="../js/jquery.min.js"></script>
<script src="assets/js/printThis.js"></script>

<script>
	$("#print").click(function(){
		$(".container").printThis({});
	});
</script>
</html>