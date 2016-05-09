<?php
  //Koneksi ke database
  $conn = mysql_connect("localhost","root","") or die(mysql_error());
  
  if ($conn) echo "Terkoneksi dengan server database<br/>";
  
  //Pilih database
  $selectDB = mysql_select_db("garuda_media") or die(mysql_error());
  if ($selectDB) echo "Database telah terpilih<br/>";
  
  /*$judul = "Garuda Media";
  $isi_berita = "Garuda media telah maluncurkan cd tutorial web programming.";
  $sqlstr = "INSERT INTO tbl_garuda_media(judul, isi_berita) VALUES('".$judul."','".$isi_berita."')";
  $result = mysql_query($sqlstr) or die(mysql_error());
  if ($result) echo "Data telah masuk<br/>";
  
  $judul = "Garuda Media Meluncurkan Tutorial Baru";
  $sqlstr = "UPDATE tbl_garuda_media SET judul='".$judul."' WHERE id=1";
  $result = mysql_query($sqlstr) or die(mysql_error());
  if ($result) echo "Data telah terupdate<br/>";
  
  $sqlstr = "DELETE FROM tbl_garuda_media WHERE id=3";
  $result = mysql_query($sqlstr) or die(mysql_error());
  if ($result) echo "Data telah terhapus<br/>";
  */
  echo "Membaca data dengan menggunakan mysql_fetch_array<br/>";
  $sqlstr = "SELECT * FROM tbl_garuda_media WHERE judul='Garuda Media'";
  $result = mysql_query($sqlstr) or die(mysql_error());
  $data=mysql_fetch_array($result);
	echo "ID:".$data[0]."<br/>";
	echo "Judul:".$data[1]."<br/>";
	echo "Isi berita:".$data['isi_berita']."<br/>";
  
  
  echo "Membaca data dengan menggunakan mysql_fetch_object<br/>";
  $sqlstr = "SELECT * FROM tbl_garuda_media";
  $result = mysql_query($sqlstr) or die(mysql_error());
  while ($data=mysql_fetch_object($result)){
	echo "ID:".$data->id."<br/>";
	echo "Judul:".$data->judul."<br/>";
	echo "Isi berita:".$data->isi_berita."<br/>";
  }
?>