<?php include('../config.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Delete feature</title>
</head>

<body>
<?php
   $id=$_REQUEST['id'];
   $query=mysql_query("DELETE FROM gallery_tb WHERE id=$id");
   header("location:gallery_post.php");
?>

  </p>
</div>
</body>
</html>
