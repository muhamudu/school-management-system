<?php include('../config.php'); ?>

<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Delete Conduct</title>
</head>

<body>
<?php
	 $id=$_REQUEST['id'];
	 $query=mysql_query("DELETE FROM conduct_tb WHERE id=$id");
	 ?>
	 <script type="text/javascript">
	 	alert("The Student conduct is now deleted");
	 	document.location = 'conduct_list-dod.php';
	 </script>
	 <?php
?>

  </p>
</div>
</body>
</html>
