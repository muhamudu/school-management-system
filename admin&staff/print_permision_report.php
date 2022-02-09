<?php
    error_reporting("E_NOTICE");

    $export_file = "Permission Report.doc";
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


    $id = $_REQUEST['id'];
    $query = mysql_query("SELECT * FROM permission_tb WHERE id='$id' ");
    $fet = mysql_fetch_array($query);

    $std_query = mysql_query("SELECT * FROM student_tb WHERE id='".$fet['std_id']."' ");
    $std_fet = mysql_fetch_array($std_query);
    
?>
    <table>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th align="left">
                REPUBLIC OF RWANDA<br>
                MINISTRY OF EDUCATION<br>
                Saint Philip TVET School<br>
                P.O.Box 1692 Kigali, Rwanda<br>
                stphiliptvet012@gmail.com<br>
                +250 788 565 100
            </th>
        </tr><br><br>
        <tr>
            <th></th>
            <th></th>
            <th><center><b>STUDENT PERMISSION REPORT</b></center></th>
            <th></th>
            <th></th>
            
        </tr>

        <tr>
            <td>First Name</td>
            <td><b><?php echo $std_fet['firstname']; ?></b></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><b><?php echo $std_fet['lastname']; ?></b></td>
        </tr>
        <tr>
            <td>Class</td>
            <td><b><?php echo $fet['class']; ?></b></td>
        </tr>
        <tr>
            <td>Date Left</td>
            <td><b><?php echo $fet['date_time_left']; ?></b></td>
        </tr>
        <tr>
            <td>Returning Date</td>
            <td><b><?php echo $fet['date_time_return']; ?></b></td>
        </tr>
        <tr>
            <td>Location</td>
            <td><b><?php echo $fet['place']; ?></b></td>
        </tr>
        <tr>
            <td>Comment</td>
            <td><b><?php echo $fet['reason']; ?></b></td>
        </tr>
    </table>