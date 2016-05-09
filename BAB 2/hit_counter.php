<?php
  function cek_cookie(){
	if (empty($_COOKIE['counter'])){
		return false;
	}else{
		return true;
	}
  }
  
  function access_file_counter(){
	$namafile = "counter.txt";
	if (!file_exists($namafile)){
		$fp = fopen($namafile,"w");
		fwrite($fp,"0");
		fclose($fp);
	}
	
	$fp = fopen($namafile,"r");
	$urut = fread($fp, 5);
	fclose($fp);
	$urut++;
	$fp = fopen($namafile, "w");
	fwrite($fp, $urut);
	fclose($fp);
  }
  
  function getNumber(){
		$namafile = "counter.txt";
	  if (file_exists($namafile)){
		$fp = fopen($namafile, r);
		$urut = fread($fp, 5);
		fclose($fp);
		echo $urut;
	  }
  }
  
  if (!cek_cookie()){
	setcookie("counter","tamu", time()+7200);
	access_file_counter();
  }
  
  getNumber();
?>