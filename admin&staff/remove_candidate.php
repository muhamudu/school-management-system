<?php include('../config.php'); ?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Delete teacher</title>
</head>

<body>
<?php
   $id=$_REQUEST['id'];
   $query=mysql_query("DELETE FROM cambinet_tb WHERE id=$id");
   header("location:cambinet_post.php");
?>

  </p>
</div>
</body>
</html>
