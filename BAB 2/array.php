<?php
	//ARRAY
	//ARRAY BERINDEX
		//Index Disebutkan
	$hewan[0] = "Ayam";
	$hewan[1] = "Kambing";
	$hewan[2] = "Sapi";
	$hewan[3] = "Bebek";
	$hewan[4] = "Angsa";
	
	$i=0;
	echo "Index Disebutkan<br/>";
	foreach ($hewan as $value){
		echo $i.".".$value."<br/>";
		$i++;
	}
	
		//Index Tidak Disebutkan
	$animal[] = "Ayam";
	$animal[] = "Kambing";
	$animal[] = "Sapi";
	$animal[] = "Bebek";
	$animal[] = "Angsa";
	
	$i=0;
	echo "<br/>Index Tidak Disebutkan<br/>";
	foreach ($hewan as $value){
		echo $i.".".$value."<br/>";
		$i++;
	}
	
	//DEFINISI ARRAY
	echo "<br/>Array himpunan<br/>";
	$hewan = array("ayam","burung");
	echo $hewan[0]."<br/>";
	echo $hewan[1]."<br/>";
	
	//ARRAY ASOSIATIF
	echo "<br/>Array Asosiatif<br/>";
	$telepon["Doni"] = "0341123456";
	$telepon["Raymond"] = "0341555555";
	$telepon["Budi"] = "0341000000";
	
	foreach ($telepon as $value){
		echo $i.".".$value."<br/>";
		$i++;
	}
	
	
?>