<?php include('../config.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Delete feedback</title>
</head>

<body>
<?php
   $id=$_REQUEST['id'];
   $query=mysql_query("DELETE FROM feedback WHERE id=$id");
   header("location:feedback.php");
?>

  </p>
</div>
</body>
</html>
