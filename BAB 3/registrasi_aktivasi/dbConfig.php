<?php
	$connect = mysql_connect("localhost","root","") or die(mysql_error());
	if (!connect){ 
		echo "Gagal koneksi ke database";
		exit();
	}
	
	$selectDb = mysql_select_db("garuda_media", $connect) or die(mysql_error());
	if (!selectDb){
		echo "Gagal memilih database";
		exit();
	}
?>