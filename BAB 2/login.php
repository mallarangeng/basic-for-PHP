<?php
	ob_start();
	function cekMyCookie(){
		$_SESSION['login'] = true;
		echo (isset($_COOKIE['rememberme']))?"Cookie telah aktif":"Cookie tidak aktif";
		echo $_SESSION['login'];
	}
	cekMyCookie();
?>
<html>
<head>
	<title>APLIKASI LOGIN</title>
</head>
<body>
	<?php
		
		
		if (isset($_REQUEST['signin'])){
			$email = trim($_REQUEST['email']);
			$password = trim($_REQUEST['password']);
			
			if (empty($email) or $email == 'Email...'){
				echo "Email masih kosong";
			}else{
				if (empty($password) or $password == 'Password...'){
					echo "Password masih kosong";
				}else{
					$passwordAsli = "1234";
					if ($password == $passwordAsli){
						$rememberme = $_REQUEST['rememberme'];
						if ($rememberme) setcookie('rememberme','true',time() + 7200);
						$_SESSION['login'] = true;
						echo "Login sukses<br/>";
						echo "Nilai session:".$_SESSION['login']."<br/>";
											
					}else{
						echo "Password salah";
					}
				}
			}
		}
		
	?>
	<form method="post" action="login.php">
		<input type="text" name="email" value="Email..." onblur="if (this.value=='') 
		this.value='Email...'; " onfocus="if (this.value=='Email...')this.value=''"/>
		<input type="text" name="password" value="Password..." onblur="if (this.value==''){ 
		this.value='Password...';this.type='text';} " onfocus="if (this.value=='Password...')
		this.value='';this.type='password';"/>
		<input type="checkbox" name="rememberme"/>Remember Me
		<input type="submit" value="Sign In" name="signin"/>
	</form>
</body>
</html>