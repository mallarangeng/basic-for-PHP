<?php
	session_start();
	echo (session_destroy()) ? "Deleted<br/>" : "Not Deleted<br/>";
	
	echo "Isi session publisher: ".$_SESSION["publisher"]."<br/>";
	echo "Isi session produk: ".$_SESSION["produk"]."<br/>";
?>