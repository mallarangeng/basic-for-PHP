<?php
	$sum = 12 + "15";
	echo $sum;
	
	echo "<br/>";
	//Variabel Local
	$a = 5;
	function tambah(){
	
		$a = 8;
	}
	tambah();
	echo $a;
	
	//Variabel Global
	echo "<br/>";
	function kurang(){
		GLOBAL $abc;
		$abc = 25;
	}
	
	kurang();
	echo $abc;
	echo "<br/>";
	//Variabel Statis
	function hitung(){
		STATIC $x = 0;
		$x++;
		echo $x;
		echo "<br/>";
	}
	
	hitung();
	hitung();
	hitung();
	
?>