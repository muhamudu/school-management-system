<?php 
    require('../config.php');
    session_start();
    if (!isset($_SESSION['user_id'])){
    header('location:index.php');
    }

    if(isset($_POST['search_report'])){
        $std_class = $_POST['class'];
        $std_name = $_POST['student_name'];
        $sch_year = $_POST['year'];

        $st_query=mysql_query("SELECT * FROM student_tb WHERE id='".$_POST['student_name']."' ");
        $fetch_student=mysql_fetch_array($st_query);

        $req_query=mysql_query("SELECT * FROM reported_marks WHERE year='$sch_year'");
        $fetch_re_marks=mysql_fetch_array($req_query);

        $class_query=mysql_query("SELECT * FROM subject_tb WHERE class='$std_class'");
        $class_row=mysql_fetch_array($class_query);

        if($std_name = $fetch_re_marks['student_id'] AND $sch_year=$fetch_re_marks['year'] AND $std_class= $class_row['class']){

            ob_start ();
?>
            <page backtop="2%" backbottom="2%" backleft="2%" backright="2%" style="font-size:12px;">
            <link rel="icon" href="../img/sch_sign.PNG" type="image">
            <link rel="stylesheet" href="../css/bootstrap.min.css">
            <!-- HEADINGS -->
                <div style="width:100%; height:30%;">
                    <img src="../img/sch_sign.PNG" style="width:13%; height:30%;">
                    <p style="margin-top:-95px; margin-left:95px;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REPUBLIC OF RWANDA<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MINISTRY OF EDUCATION<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Saint Philip Technical Secondary School<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P.O.BOX 1692 KIGALI<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;saintphiliptss1985@gmail.com<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+250 788 565 100
                    </p>
                    <img src="student_img/<?php echo $fetch_student['profile_picture']; ?>" style="width:13%; height:34%; margin-left:623px; margin-top:-99px"><br><br><br><br><br><br><br><br><br>
                    <h3 align="center"><u>PROGRESIVE SCHOOL REPORT</u></h3>

                    <p> Name Of Student<br>
                        Class <br>
                        Student Serial Number<br>
                        Date of birth<br>
                        Gender <br>
                        School Year <br>
                        School Term  
                    </p>
                    <p style="margin-top:-105px; margin-left:170px;">
                    <b><?php echo $fetch_student['firstname']." ".$fetch_student['lastname']; ?><br>
                       <?php echo $class_row['class']; ?> <br>
                       <?php echo $fetch_student['student_ID']; ?><br>
                       <?php echo $fetch_student['date_of_birth']; ?><br>
                       <?php echo $fetch_student['gender']; ?> <br>
                        <?php echo $fetch_re_marks['year']; ?> <br>
                        3rd Term  
                    </b></p>
                </div><!-- /. END HEADINGS -->

                <!-- TABLE MARKS -->
            <table style="width:132%; margin-top:-30px;" border="1">
                <tr style="text-size:1em; text-align: center;">
                    <th rowspan="2" style="width: 19%; text-align: left;">Subjects</th>
                    <th colspan="3">Maximum</th>
                    <th colspan="3">1<sup>st</sup> Term</th>
                    <th colspan="3">2<sup>nd</sup> Term</th>
                    <th colspan="3">3<sup>rd</sup> Term</th>
                    <th colspan="3">ANNUAL</th>
                    <th colspan="2">2<sup>nd</sup> Sitting</th>
                </tr>
                <tr>
                    <th>Test</th>
                    <th>Exam</th>
                    <th>Total</th>
                    <th>Test</th>
                    <th>Exam</th>
                    <th>Total</th>
                    <th>Test</th>
                    <th>Exam</th>
                    <th>Total</th>
                    <th>Test</th>
                    <th>Exam</th>
                    <th>Total</th>
                    <th>MAX</th>
                    <th>O.P</th>
                    <th rowspan="2">%</th>
                    <th>O.P</th>
                    <th>%</th>

                </tr>
            
                    <tr style="text-align: right;">
                        <td style="text-align: left;" colspan="1">Conduct</td>
                        <?php
                            $c_query = mysql_query("SELECT * FROM conduct_tb WHERE student_name='$std_name' AND year='$sch_year'");
                            $c_row = mysql_fetch_array($c_query);
                        ?>
                        <td colspan="6"><?php echo $c_row['min_conduct']; ?></td>
                        <td colspan="3">-</td>
                        <td colspan="3">-</td>
                        <td colspan="1">-</td>
                        <td colspan="1">-</td>
                        <td colspan="2">-</td>
                    </tr>

                    <tr align="left" style="width:100%;">
                        <th colspan="18">Core Subjects</th>
                    </tr>
                    <?php
                        $rq_query = mysql_query("SELECT * FROM subject_tb WHERE class='$std_class'");
                        while($disp = mysql_fetch_array($rq_query)){
                            $max_sum = $disp['test_marks'] + $disp['exam_marks'];
                    ?>
                    <tr style="text-align: right;">
                        <td style="text-align: left;"><?php echo $disp['subject']; ?></td>
                        <td><b><?php echo $disp['test_marks']; ?></b></td>
                        <td><b><?php echo $disp['exam_marks']; ?></b></td>
                        <td><b><?php echo $max_sum; ?></b></td>
                        <?php
                            $marks = mysql_query("SELECT * FROM reported_marks WHERE year='$sch_year'");
                            $m_row = mysql_fetch_array($marks);
                                $f_sum = $m_row['st_test_marks'] + $m_row['st_exam_marks'];
                        ?>
                        <td><?php echo $m_row['st_test_marks']; ?></td>
                        <td><?php echo $m_row['st_exam_marks']; ?></td>
                        <td><?php echo $f_sum; ?></td>
                        <td>28</td>
                        <td>28</td>
                        <td>60</td>
                        <td>28</td>
                        <td>28</td>
                        <td>60</td>
                        <td><b>240</b></td>
                        <td>100</td>
                        <td>90%</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                        <?php
                        }

                    ?>
                    

                    <tr align="left">
                        <th colspan="18">Non-Examinable Subjects</th>
                    </tr>

                    <tr style="text-align: right;">
                        <td style="text-align: left;">TOTAL</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>

                    <tr style="text-align: right;">
                        <td style="text-align: left;">AVERANGE</td>
                        <td style="font-weight: bold;" colspan="6">85%</td>
                        <td style="font-weight: bold;" colspan="3">78%</td>
                        <td style="font-weight: bold;" colspan="3">74%</td>
                        <td style="font-weight: bold;" colspan="3">85%</td>
                        <td style="font-weight: bold;" colspan="2">-</td>
                    </tr>

                    <tr style="text-align: right;">
                        <td style="text-align: left;">POSITION</td>
                        <td style="font-weight: bold;" colspan="6">1 / 20</td>
                        <td style="font-weight: bold;" colspan="3">5 / 20</td>
                        <td style="font-weight: bold;" colspan="3">3 / 20</td>
                        <td style="font-weight: bold;" colspan="3">4 / 20</td>
                        <td style="font-weight: bold;" colspan="2">-</td>
                    </tr>

                    <tr style="height: 40px;">
                        <td style="text-align: left;">Teacher's Signature</td>
                        <td colspan="6"></td>
                        <td colspan="3"></td>
                        <td colspan="3"></td>
                        <td colspan="3"></td>
                        <td colspan="2"></td>
                    </tr>

                    <tr style="height: 40px;">
                        <td style="text-align: left;">Parent's Signature</td>
                        <td colspan="6"></td>
                        <td colspan="3"></td>
                        <td colspan="3"></td>
                        <td colspan="3"></td>
                        <td colspan="2"></td>
                    </tr>

                    <tr >
                        <td colspan="18"><br>

                            &nbsp;<b>VERDICT OF THE JURY</b><br>

                                <p>
                                    &nbsp;&nbsp;&nbsp;Promoted<br>
                                    &nbsp;&nbsp;&nbsp;Advised to Repeat<br>
                                    &nbsp;&nbsp;&nbsp;Discontinued<br>
                                    &nbsp;&nbsp;&nbsp;Proposed to resit<br><br>

                                    &nbsp;&nbsp;&nbsp;2<sup>nd</sup> sitting, promoted<br>
                                    &nbsp;&nbsp;&nbsp;2<sup>nd</sup> sitting, advised to repeat
                                </p>

                            &nbsp;<b>OBSERVATIONS</b>

                                <p >
                                    &nbsp;&nbsp;&nbsp;1<sup>st</sup> Term<br>
                                    &nbsp;&nbsp;&nbsp;2<sup>nd</sup> Term<br>
                                    &nbsp;&nbsp;&nbsp;3<sup>rd</sup> Term<br>
                                </p>
                        </td>
                    </tr>

                
                
            </table><!-- /. END TABLE MARKS -->
            </page>
        <?php
            $content = ob_get_clean();

            require ('../html2pdf/vendor/autoload.php');

            $pdf = new HTML2PDF ('P', 'A4', 'fr', 'true', 'UTF-8');
            $pdf->writeHTML($content);
            $pdf->Output('Student List.pdf');

        }
        else{
            echo "The Data Requested is Invalid";
        }
    }
?>