<?php
error_reporting("E_NOTICE");
?>
<?php
include('../config.php');
session_start();

if (!isset($_SESSION['user_id'])){
header('location:signup.php');
}
//lOGIN USERNAME INFORMATION
$user_id=$_SESSION['user_id'];

$result=mysql_query("select * from users_tb where id='$user_id'")or die("mysql_error".mysql_error());
$row=mysql_fetch_array($result);

$username = $row['username'];
?>
<html>
    <head>
        <title>Print View</title>
        <style>
            .tb {
                position: absolute;
                left: 30%;
                top: 10%;
            }
        </style>
    </head>
    
    <body>
        <div class="tb">
            <a title="print screen" alt="print screen" onclick="window.print();" target="_blank" style="cursor: pointer;" ><img align="right" src="../img/Printer.png"></a>
            <table class="table table-striped table-bordered table-hover" id="myTable" style="font-size:12px;">
                    <thead>
                       <tr>
                         <th>N<sup>o</sup></th>
                         <th>First Name</th>
                         <th>Last Name</th>
                         <th>Class</th>
                         <th>Serial N<sup>o</sup></th>
                         <th>Fees /Frw</th>
                         <th>Status</th>
                         <th>Parent Name</th>
                         <th>Contact</th>
                         <th>Action</th>
                       </tr>
                    </thead>
                   <?php
                        $query = mysql_query("SELECT * FROM student_tb");
                        $count = 0;

                        while($row = mysql_fetch_array($query))
                        {
                              $count++;
                            echo "
                            <tbody>
                             <tr>
                               <td>$count</td>
                               <td>".$row['firstname']."</td>
                               <td>".$row['lastname']."</td>
                               <td>".$row['class']."</td>
                               <td>".$row['student_ID']."</td>
                               <td>".$row['school_fees']."</td>
                               <td>".$row['status']."</td>
                               <td>".$row['father_name']."</td>
                               <td>".$row['father_phone']."</td>
                               <td><center><a href=edit_student.php?id=".$row['id']."><span class='icon-edit'> Edit</span></a> |
                               <a href=delete_student.php?id=".$row['id']."><font color='red'><span class='icon-trash'> Delete</span></font></a></center></td>
                             </tr>
                            </tbody>";
                        }
                    ?>

               </table>
        </div>
        
    </body>
</html>