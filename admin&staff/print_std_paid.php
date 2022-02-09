<?php
    error_reporting("E_NOTICE");

    $export_file = "Paid Student List.xls";
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

    if (isset($_POST['print'])) {
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
                    <th colspan="8" rowspan="2"><?php echo $term; ?>, <?php echo $year; ?>, PAID STUDENT LIST OF <?php echo $class; ?></th>
                    
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
                    <td>Fees Paid</td>
                    <td>Balance</td>
                </tr>
        <?php

        $st_query = mysql_query("SELECT * FROM `student_fees` WHERE `year`='$year' AND `class`='$class' ");
        while($fetch_student = mysql_fetch_array($st_query)){
            $sel = mysql_query("SELECT * FROM student_tb WHERE `id`='".$fetch_student['std_id']."' ");
            $fet = mysql_fetch_array($sel);
            $balance = 0;

            if($fetch_student['status'] == 'Daycare'){
                $fees = 60000;
            }

            if($fetch_student['status'] == 'Boarding'){
                $fees = 130000;
            }

            $balance = $fees - $fetch_student['paid_fees'];

            if($fetch_student['term'] == $term){
                if($balance == 0){
                    $num ++;
                    echo "
                        <tr>
                            <td>".$num."</td>
                            <td>".$fet['firstname']."</td>
                            <td>".$fet['lastname']."</td>
                            <td>".$fet['student_ID']."</td>
                            <td>".$fet['gender']."</td>
                            <td>".$fet['date_of_birth']."</td>
                            <td>".$fetch_student['paid_fees']."</td>
                            <td>".$balance."</td>
                        </tr>
                    ";
                }
                
            }
              
        }
        ?>
            </table>

        <?php
    }
?>