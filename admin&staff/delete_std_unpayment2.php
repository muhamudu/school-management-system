<?php include('../config.php'); ?>

<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Delete student</title>
</head>

<body>
<?php 
	 $id=$_REQUEST['id']; 
	 $query=mysql_query("DELETE FROM student_fees WHERE id=$id");
	 header('location:unpaid_student2.php');	 
?>

</body>
</html>