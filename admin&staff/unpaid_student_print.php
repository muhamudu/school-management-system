<?php
    error_reporting("E_NOTICE");
?>
<?php
    $export_file = "Unpaid students.xls";
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
    <thead>
        <tr>
            <th>N<sup>o</sup></th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Class</th>
            <th>Paid Fees</th>
            <th>Remaining Fees</th>
        </tr>
    </thead>
    <?php
        $query = mysql_query("SELECT * FROM student_tb ORDER BY firstname ASC");
        $count = 0;

        while($row = mysql_fetch_array($query))
        {

            $total_fees = 60000;
            $paid_fees = $row['school_fees'];
            $balance = $total_fees-$row['school_fees'];
            if($balance > 0)
            {
                $count++;
            echo "
            
                <tr>
                <td>$count</td>
                <td width='100'>".$row['firstname']."</td>
                <td>".$row['lastname']."</td>
                <td>".$row['class']."</td>
                <td>".$row['school_fees']."</td>
                <td>".$balance."</td>
                </tr>";
            }
        }
    ?>

</table>

