<?php
	$string = "garuda-media";
	echo $string,"<br/>";
	//MD5
	echo "MD5:".md5($string),"<br/>";
	//explode
	$strArr = explode("-",$string);
	echo "Explode:", $strArr[0], $strArr[1], "<br/>";
	//implode
	echo "implode: ", implode("@",$strArr),"<br/>";
	//substr
	echo "substr: ", substr($string,7,5),"<br/>";
	//strstr
	echo "strstr: ", strstr($string,"a"),"<br/>";
	//strpos
	$position = strpos($string , "g");
	echo "strpos: ", ($position === false) ? "Tidak Ketemu" : $position;
	echo "<br/>";
	//strtolower
	echo "strtolower: ", strtolower("GARUda-MedIa"), "<br/>";
	//strtoupper
	echo "strtoupper: ", strtoupper("GARUda-MedIa"), "<br/>";
	//str_replace
	echo "str_replace: ", str_replace("garuda","media",$string),"<br/>";
	//trim
	$string2 = ' garuda - media ';
	echo "$",$string2,"$<br/>";
	$trimmed = trim($string2);
	echo "trim:#",$trimmed,"#<br/>";
	//ltrim kiri, rtrim kanan
	$trimmLeft = ltrim($string2);
	echo "ltrim:#",$trimmLeft,"#<br/>";
	$trimmRight = rtrim($string2);
	echo "rtrim:#",$trimmRight,"#<br/>";
	//ucfirst
	echo "ucfirst: ".ucfirst('garuda-media'),"<br/>";
	//strlen
	echo "strlen: ".strlen($string);
?>