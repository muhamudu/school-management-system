<?php
   // define database related variables
   $conn = mysql_connect("localhost","root","");

   if(!$conn)
   {
     die("could not connect to database");
   }

    $dbname = mysql_select_db("saint_philip") or die("could not select db");

?>
