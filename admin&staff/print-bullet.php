<?php
    error_reporting("E_NOTICE");
?>
<?php
    $export_file = "Student-report.xls";
    ob_end_clean();
    ini_set('zlib.output_compression','Off');

    header('Pragma: public');
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");                  // Date in the past   
    header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
    header('Cache-Control: no-store, no-cache, must-revalidate');     // HTTP/1.1
    header('Cache-Control: pre-check=0, post-check=0, max-age=0');    // HTTP/1.1
    header ("Pragma: no-cache");
    header("Expires: 0");
    header('Content-Transfer-Encoding: none');
    header('Content-Type: application/vnd.ms-word;');                 // This should work for IE & Opera
    header("Content-type: application/x-msword");                    // This should work for the rest
    header('Content-Disposition: attachment; filename="'.basename($export_file).'"');

    include('../config.php');
    session_start();

    if (!isset($_SESSION['user_id'])){
    header('location:index.php');
    }

    // STUDENT ASSESSIMENT REPORT
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

        $sel_cond = mysql_query("SELECT * FROM `conduct_tb` WHERE `student_name`='$fetch_student[id]' AND `class`='$std_class' AND `year`='$sch_year' "); 
        $fet_cond = mysql_fetch_array($sel_cond);

        //TABLE
        ?>
            <table border="1">
                <tr>
                    <th rowspan="3" colspan="2"></th>
                    <th align="right" rowspan="3" colspan="8">
                        REPUBLIC OF RWANDA<br>
                        MINISTRY OF EDUCATION<br>
                        Saint Philip TVET School<br>
                        P.O.Box 1692 Kigali, Rwanda<br>
                        stphiliptvet012@gmail.com<br>
                        +250 788 565 100
                    </th>
                </tr>
            </table>

            <table border="1">
                <tr>
                    <th colspan="10">TRAINEE'S ASSESSMENT REPORT</th>
                    
                </tr>

                <tr>
                    <td></td>
                    <td colspan="2">Name of student</td>
                    <th colspan="3" align="left"><?php echo $fetch_student['firstname']." ".$fetch_student['lastname']; ?></th>
                    <td colspan="2">Gender</td>
                    <th colspan="2" align="left"><?php echo $fetch_student['gender']; ?></th>
                </tr>

                <tr>
                    <td></td>
                    <td colspan="2">Class</td>
                    <th colspan="3" align="left"><?php echo $class_row['level']; ?></th>
                    <td colspan="2">School year</td>
                    <th colspan="2" align="left"><?php echo $fetch_re_marks['year']; ?></th>
                </tr>

                <tr>
                    <td></td>
                    <td colspan="2">Student serial number</td>
                    <th colspan="3" align="left"><?php echo $fetch_student['student_ID']; ?></th>
                    <td colspan="2">School term</td>
                    <th colspan="2" align="left">Final Term</th>
                </tr>

                <tr>
                    <td></td>
                    <td colspan="2">Date of birth</td>
                    <th colspan="3" align="left"><?php echo $fetch_student['date_of_birth']; ?></th>
                    <td colspan="2">Conduct</td>
                    <th colspan="2" align="left"><?php echo "".$fet_cond['min_conduct']." / ".$fet_cond['max_conduct'].""; ?></th>
                </tr>
 
                <!-- Student Marks & Modulus -->
                <tr>
                    <th rowspan="2">N<sup>o</sup></th>
                    <th rowspan="2">Module Code</th>
                    <th rowspan="2">Competence Title</th>
                    <th rowspan="2">Credit / Hour</th>
                    <th colspan="3">Assessiment</th>
                    <th colspan="2">Re-Assessiment</th>
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
							?>... / 
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
            </table>
        <?php
    } 
?>

