<?php
	require("dbConfig.php");
	
	if (isset($_REQUEST['kode'])){
		$kode = $_REQUEST['kode'];
		
		$sqlstr = "SELECT * FROM user WHERE aktif = 0 AND kode_registrasi='".$kode."'";
		$result = mysql_query($sqlstr) or die(mysql_error());
		
		if ($result){
			if (mysql_num_rows($result) == 1){
				$sqlstr = "UPDATE user SET aktif=1 WHERE kode_registrasi='".$kode."'";
				$result = mysql_query($sqlstr) or die(mysql_error());
				if ($result)
					echo "Selamat!!! Account telah aktif.";
				else
					echo "Gagal aktifasi account.";
			}
		}
	}
	
?>