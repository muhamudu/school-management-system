<?php include('../config.php'); ?>

<!DOCTYPE html>
<html>
<head>
<title>Delete teacher</title>
</head>

<body>
<?php
   $id=$_REQUEST['id'];
   $query=mysql_query("DELETE FROM teacher_posted WHERE id=$id");
   header("location:staff_post.php");
?>
</body>
</html>
