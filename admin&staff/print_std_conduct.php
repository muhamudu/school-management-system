<?php
    error_reporting("E_NOTICE");

    $export_file = "Student Conduct List.xls";
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

    if (isset($_POST['getdoc'])) {
        $class = $_POST['class'];
        $year = $_POST['year'];
        $term = $_POST['term'];
        $num = 0;
        
        ?>
            <table border="1">
                <tr>
                    <th rowspan="3" colspan="2"></th>
                    <th align="right" rowspan="3" colspan="6">
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
                    <th colspan="8" rowspan="2"><?php echo $term; ?>, <?php echo $year; ?> STUDENT CONDUCT LIST OF <?php echo $class; ?></th>
                    
                </tr>
            </table>

            <table border="1">
                <tr>
                    <td>N<sup>o</sup></td>
                    <td colspan="2">First Name</td>
                    <td colspan="2">Last Name</td>
                    <td>Serial N<sup>o</sup></td>
                    <td>Max-Marks</td>
                    <td>Min-Marks</td>
                </tr>
        <?php

        $st_query = mysql_query("SELECT * FROM `conduct_tb` WHERE `year`='$year' AND `class`='$class' AND `term`='$term' ");
        while($fetch_student = mysql_fetch_array($st_query)){
            $get_std = mysql_query("SELECT * FROM student_tb WHERE id='".$fetch_student['student_name']."'");
            $fet_std = mysql_fetch_array($get_std);

            $num ++;
            echo "
                <tr>
                    <td>".$num."</td>
                    <td colspan='2'>".$fet_std['firstname']."</td>
                    <td colspan='2'>".$fet_std['lastname']."</td>
                    <td>".$fet_std['student_ID']."</td>
                    <td>".$fetch_student['max_conduct']."</td>
                    <td>".$fetch_student['min_conduct']."</td>
                </tr>
            ";
        }
        ?>
            </table>

        <?php
    }
?>