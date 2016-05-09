<?php
require("dbConfig.php");

for ($i=1; $i<=20;$i++){
	$sqlstr = "INSERT INTO address_book(nama, alamat, telepon) VALUE('Indra','Jl. ABC No. 90','234234234234')";
	$result = mysql_query($sqlstr) or die(mysql_error());
}

if ($result) "Data saved";
?>