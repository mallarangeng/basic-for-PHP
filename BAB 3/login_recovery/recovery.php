<?php
	require("dbConfig.php");
	
	function validasiData($email){
		$sqlstr = "SELECT * FROM user WHERE email = '".$email."' AND aktif=1";
		$result = mysql_query($sqlstr) or die(mysql_error());
		
		if (mysql_num_rows($result)==1)
			return true;
		else
			return false;
	}
	
	function resetPassword($email){
		$newPwd = rand(1111,9999);
		$sqlstr = "UPDATE user SET password='".md5($newPwd)."' WHERE email='".$email."'";
		$result = mysql_query($sqlstr) or die(mysql_error());
		if ($result){
			return $newPwd;
		}else{
			return "";
		}
	}
	
	function kirimPassword($email, $pwd){
		$pesan = "Password baru anda: <br/>";
		$pesan .= "<b>$pwd</b>";
		
		$header = "From: admin@localhost \n";
		$header .= "Content-type: text/html \r \n";
		
		$kirimEmail = mail($email, "Password Baru", $pesan, $header);
		
		if ($kirimEmail)
			return true;
		else
			return false;
		
	}
	
	if (isset($_REQUEST['kirim'])){
		$email = $_REQUEST['email'];
		if (validasiData($email)){
			$pwd = resetPassword($email);
			if (!empty($pwd)){
				if (kirimPassword($email, $pwd))
					echo "Password baru telah dikirim ke email anda.";
				else
					echo "Gagal mengirim password baru, silahkan anda coba beberapa saat lagi.";
			}else{
				echo "Gagal update password.";
			}
		}else{
			echo "Email tidak ditemukan.";
		}
	}
?>
<form method="get" action="<?php $_SERVER['PHP_SELF'] ?>">
	<input type="text" name="email"/><input type="submit" name="kirim" value="Kirim Password"/>
</form>