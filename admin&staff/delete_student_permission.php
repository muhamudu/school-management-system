<?php include('../config.php'); ?>

<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Delete Permission</title>
</head>

<body>
<?php
	 $id=$_REQUEST['id'];
	 $query=mysql_query("DELETE FROM permission_tb WHERE id=$id");
	 ?>
	 <script type="text/javascript">
	 	alert("The Student Permission is now deleted");
	 	document.location = 'pemission.php';
	 </script>
	 <?php
?>

  </p>
</div>
</body>
</html>
