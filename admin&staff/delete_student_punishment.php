<?php include('../config.php'); ?>

<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Delete Punishment</title>
</head>

<body>
<?php
	 $id=$_REQUEST['id'];
	 $query=mysql_query("DELETE FROM punishment_tb WHERE id=$id");
	 ?>
	 <script type="text/javascript">
	 	alert("The Student Punishment is now deleted");
	 	document.location = 'punishment.php';
	 </script>
	 <?php
?>

  </p>
</div>
</body>
</html>
