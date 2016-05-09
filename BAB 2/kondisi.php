<?php

	$a = 3;
	$b = 6;
	
	echo "Isi variabel \$a : $a<br/>";
	echo "Isi variabel \$b : $b<br/>";
	
	echo "Menggunakan If then else<br/>";
	echo "Apakah \$a > \$b?<br/>";
	
	if ($a > $b){
		echo "Benar<br/>";
	}else{
		if ($a > $b){
			echo "Benar<br/>";
		}else
			echo "Salah<br/>";
		
	}
	
	echo "Menggunakan Switch Case<br/>";
	echo "Apakah isi \$a?<br/>";
	switch ($a){
		case 3:
			echo "3";
			break;
		case 4:
			echo "4";
			break;
		case 6:
			echo "6";
			break;
	}
	
	echo "<br/>Ternary<br/>";
	echo ($a>$b)?"Ya":"Tidak";
	
	
	
?>