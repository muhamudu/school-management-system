<?php
    error_reporting("E_NOTICE");

    $export_file = "Nonestaff List and Payment.xls";
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
            <th colspan="9" align="right">
                REPUBLIC OF RWANDA<br>
                MINISTRY OF EDUCATION<br>
                Saint Philip TVET School<br>
                P.O.Box 1692 Kigali, Rwanda<br>
                stphiliptvet012@gmail.com<br>
                +250 788 565 100
            </th>
        </tr>

        <tr>
            <th colspan="9">School Nonstaff's List And Payment</th>
        </tr>

        <tr>
            <th>N<sup>o</sup></th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Duty</th>
            <th>Age</th>
            <th>Salary</th>
            <th>Date Paid</th>
            <th>Paid Salary</th>
            <th>Remaining Salary</th>
        </tr>
        <?php
            $query = mysql_query("SELECT * FROM nonstaff_payment");
            $count = 0;

            while($row = mysql_fetch_array($query))
            {
                $get = mysql_query("SELECT * FROM non_staff WHERE id='".$row['nonstaff_id']."' ");
                $fet = mysql_fetch_array($get);

                $count ++;
                $remain_salary = $fet['salary'] - $row['paid_salary'];

            echo "
                <tr>
                <td>".$count."</td>
                <td>".$fet['firstname']."</td>
                <td>".$fet['lastname']."</td>
                <td>".$fet['duty']."</td>
                <td>".$fet['age']."</td>
                <td><font size='+1'><b><span class='label label-info'>".$fet['salary']." Frw</b></font></td>
                <td>".$row['date_paid']."</td>
                <td><font size='+1'><b><span class='label label-success'>".$row['paid_salary']." Frw</b></font></td>
                <td><font size='+1'><b><span class='label label-danger'>".$remain_salary." Frw</b></font></td>
                </tr>
            ";
            }
        ?>
    </table>