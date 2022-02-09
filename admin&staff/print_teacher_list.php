<?php
    error_reporting("E_NOTICE");

    $export_file = "Teacher List and Payment.xls";
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
?>
    <table border="1">
        <tr>
            <th colspan="10" align="right">
                REPUBLIC OF RWANDA<br>
                MINISTRY OF EDUCATION<br>
                Saint Philip TVET School<br>
                P.O.Box 1692 Kigali, Rwanda<br>
                stphiliptvet012@gmail.com<br>
                +250 788 565 100
            </th>
        </tr>

        <tr>
            <th colspan="10">School Teacher's List And Payment</th>
        </tr>

        <tr>
            <th>N<sup>o</sup></th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Date of birth</th>
            <th>Salary</th>
            <th>Paid Salary</th>
            <th>Balance</th>
            <th>Date Paid</th>
        </tr>
        <?php
            $num = 0;
            $tr_query = mysql_query("SELECT * FROM `teacher_payment` ");
            while($fet_teacher = mysql_fetch_array($tr_query)){
                $sel = mysql_query("SELECT * FROM teacher_tb WHERE `id`='".$fet_teacher['teacher_id']."' ");
                $fet = mysql_fetch_array($sel);
                $balance = 0;

                $balance = $fet['salary'] - $fet_teacher['paid_salary'];

                $num ++;
                echo "
                    <tr>
                        <td>".$num."</td>
                        <td>".$fet['firstname']."</td>
                        <td>".$fet['lastname']."</td>
                        <td>".$fet['email']."</td>
                        <td>".$fet['gender']."</td>
                        <td>".$fet['age']."</td>
                        <td>".$fet['salary']."</td>
                        <td>".$fet_teacher['paid_salary']."</td>
                        <td>".$balance."</td>
                        <td>".$fet_teacher['date_paid']."</td>
                    </tr>
                ";
                    
            }
        ?>
    </table>