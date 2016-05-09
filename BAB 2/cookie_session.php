<?php
	ob_start();
	session_start();
	//COOKIE
	setcookie("GARUDA_COOKIE","GARUDA",time() + 3600);
	if (isset($_COOKIE['GARUDA_COOKIE'])) echo "Cookie Initiated<br/>";
	
	//SESSION
	$_SESSION["publisher"] = "Garuda Media";
	$_SESSION["produk"] = "Tutorial Web Programming";
	
	echo "Isi session publisher: ".$_SESSION["publisher"]."<br/>";
	echo "Isi session produk: ".$_SESSION["produk"]."<br/>";
?>