<?php
include('../config.php');
if(isset($_POST['class_id']))
{
    $id=$_POST['class_id'];
    $query=mysql_query("select * from student_tb where class='$id' ")or die(mysql_error());
    echo "<option disabled selected> Select Student</option>";
    while($fetch=mysql_fetch_array($query))
    {
        echo "<option value='".$fetch['id']."' id='me'>".$fetch['firstname']." ".$fetch['lastname']."</option>";
    }

}
if(isset($_POST['class_id2']))
{
    $id=$_POST['class_id2'];
    $query=mysql_query("select * from student_tb where class='$id' ")or die(mysql_error());
    $fetch=mysql_fetch_array($query);
    $query_tech=mysql_query("select * from teacher_tb where id='".$_POST['tech']."'")or die(mysql_error());
    $fetchm=mysql_fetch_array($query_tech);
    $query1=mysql_query("select * from subject_tb where class='".$fetch['class']."' and teacher_name='".$fetchm['email']."' ")or die(mysql_error());
    $fetchv=mysql_fetch_array($query1);
    echo $fetchv['id'];

}
if(isset($_POST['subject']))
{
    $subject=$_POST['subject'];
    $query=mysql_query("select * from subject_tb where subject='$subject'")or die(mysql_error());
    while($fetch=mysql_fetch_array($query)){
        echo "<option value='".$fetch['id']."'>".$fetch['test_marks']."</option>";
    }
}
if(isset($_POST['subject3']))
{
    $subject=$_POST['subject3'];
    $query_tech=mysql_query("select * from teacher_tb where id='".$_POST['tech']."'")or die(mysql_error());
    $fetchm=mysql_fetch_array($query_tech);
    $query=mysql_query("select * from subject_tb where subject='$subject' and teacher_name='".$fetchm['email']."' ")or die(mysql_error());
    $fetch=mysql_fetch_array($query);
    echo $fetch['id'];
}
if(isset($_POST['subject2']))
{
    $subject=$_POST['subject2'];
    $query=mysql_query("select * from subject_tb where subject='$subject'")or die(mysql_error());
    while($fetch=mysql_fetch_array($query)){
        echo "<option value='".$fetch['id']."'>".$fetch['exam_marks']."</option>";
    }

}
?>
