<?php
    error_reporting("E_NOTICE");

    $export_file = "Student List.xls";
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
        $num = 0;
        
        ?>
            <table border="1">
                <tr>
                    <th rowspan="3" colspan="2"></th>
                    <th align="right" rowspan="3" colspan="7">
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
                    <th colspan="9" rowspan="2"><?php echo $year; ?> STUDENT LIST OF <?php echo $class; ?></th>
                    
                </tr>
            </table>

            <table border="1">
                <tr>
                    <td>N<sup>o</sup></td>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>Serial N<sup>o</sup></td>
                    <td>Gender</td>
                    <td>Date of birth</td>
                    <td>Father Name</td>
                    <td>Mother Name</td>
                    <td>Parent Contact</td>
                </tr>
        <?php

        $st_query = mysql_query("SELECT * FROM `student_tb` WHERE `registered_year`='$year' AND `class`='$class' ");
        while($fetch_student = mysql_fetch_array($st_query)){
            $num ++;
            echo "
                <tr>
                    <td>".$num."</td>
                    <td>".$fetch_student['firstname']."</td>
                    <td>".$fetch_student['lastname']."</td>
                    <td>".$fetch_student['student_ID']."</td>
                    <td>".$fetch_student['gender']."</td>
                    <td>".$fetch_student['date_of_birth']."</td>
                    <td>".$fetch_student['father_name']."</td>
                    <td>".$fetch_student['mother_name']."</td>
                    <td>".$fetch_student['father_phone']."/".$fetch_student['mother_phone']."</td>
                </tr>
            ";
        }
        ?>
            </table>

        <?php
    }
?>