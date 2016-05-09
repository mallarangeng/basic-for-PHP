<?php
	require("dbConfig.php");
	
	if (isset($_REQUEST['registrasi'])){
		$email = $_REQUEST['email'];
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];
		$passwordKonfirmasi = $_REQUEST['passwordKonfirmasi'];
		
		if ($password <> $passwordKonfirmasi){
			echo "Password tidak sama";
			exit();
		}
		
		//Simpan data
		$kodeAktivasi = md5($email);
		$sqlstr = "INSERT INTO user(username, password, email, aktif, kode_registrasi) ";
		$sqlstr .= "VALUES('".$username."','".md5($password)."','".$email."',0,'".$kodeAktivasi."')";
		
		$result = mysql_query($sqlstr) or die(mysql_error());
		
		if ($result){
			//Kirim Email Konfirmasi
			$pesan = "Untuk melakukan aktifasi silahkan klik link di bawah ini:<br/>";
			$pesan .= "<a href=http://localhost/garuda_media/bab_3/registrasi_aktivasi/aktivasi.php?kode=$kodeAktivasi>Klik di sini</a>";
			
			$header = "From: admin@localhost \n";
			$header .= "Content-type: text/html \n \r";
			
			$kirimEmail = mail($email, "Aktifasi Account", $pesan, $header);
			
			if ($kirimEmail){
				echo "Email aktifasi telah terkirim, harap diperiksa.";
			}else{
				echo "Gagal pengiriman email konfirmasi.";
			}
				
		}else{
				echo "Registrasi Gagal.";
		}		
	}
?>
<html>
	<head>
		<title>Registrasi User</title>
	</head>
<body>
	<h2>Form Registrasi</h2>
	<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
		<table>
			<tr>
				<td>Email</td>
				<td><Input type="text" name="email"/></td>
			</tr>
			<tr>
				<td>Username</td>
				<td><Input type="text" name="username"/></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><Input type="password" name="password"/></td>
			</tr>
			<tr>
				<td>Konfirmasi Password</td>
				<td><Input type="password" name="passwordKonfirmasi"/></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="registrasi" value="Daftar"/>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>