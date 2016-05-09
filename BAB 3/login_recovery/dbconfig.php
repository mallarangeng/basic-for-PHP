<?php
	$connect = mysql_connect("localhost","root","") or die(mysql_error());
	if (!$connect){ echo "Unable connect to database server"; exit(); }
	$selectDB = mysql_select_db("garuda_media",$connect) or die(mysql_error());
	if (!$selectDB){ echo "Unable select database"; exit(); }
?>