<?php include('../config.php'); ?>

<!DOCTYPE html>
<html>
<head>
<title>Delete Nonstaff</title>
</head>

<body>
<?php
   $id=$_REQUEST['id'];
   $query=mysql_query("DELETE FROM nonstaff_payment WHERE id='$id' ");
   header("location:nonstaff_payment.php");
?>
</body>
</html>