<?php
	$connect = mysql_connect("localhost","root","") or die("Failure ".mysql_error());
	$selectDb = mysql_select_db("db_tester",$connect) or die("Cannot select database.".mysql_error());
?>