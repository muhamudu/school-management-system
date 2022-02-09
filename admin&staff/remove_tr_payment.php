<?php include('../config.php'); ?>

<!DOCTYPE html>
<html>
<head>
<title>Delete teacher</title>
</head>

<body>
<?php
   $id=$_REQUEST['id'];
   $query=mysql_query("DELETE FROM teacher_payment WHERE id=$id");
   header("location:teacher_payment.php");
?>
</body>
</html>