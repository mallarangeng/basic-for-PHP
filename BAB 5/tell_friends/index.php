<html><head>	<title>Tell Friends</title></head><body><?php		if (isset($_REQUEST['kirim'])){		$nama = $_REQUEST['nama'];		$myEmail = $_REQUEST['myEmail'];		$emailArr = $_REQUEST['email'];				for ($i=0;$i<=2;$i++){			$emailList .= $emailArr[$i].",";		}						$emailList = substr($emailList,0,strlen($emailList) - 1);				$from = "From: admin garudamedia \n";		$from .= "Reply-To: info@garudamedia.co.id \n";		$from .= "Content-type: text/html \r \n";				$subject = "Bergabung dengan garuda media.";				$emailBody = "Teman anda yang bernama $nama telah mereferensikan anda untuk bergabung dengan <a href=www.garudamedia.co.id>garuda media</a>.";				$kirim = mail($emailList, $subject, $emailBody, $from);		echo ($kirim)?"Terima kasih telah mereferensikan teman anda." : "Pengiriman gagal.";			}	?>	<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">		<table>			<tr>				<td>Nama Anda</td>				<td><input type="text" name="nama"/></td>							</tr>			<tr>				<td>Email Anda</td>				<td><input type="text" name="myEmail"/></td>							</tr>			<tr>				<td>Email Teman</td>				<td><input type="text" name="email[]"/></td>			</tr>			<tr>				<td>Email Teman</td>				<td><input type="text" name="email[]"/></td>			</tr>			<tr>				<td>Email Teman</td>				<td><input type="text" name="email[]"/></td>			</tr>			<tr>				<td colspan="2">					<input type="submit" name="kirim" value="Kirim"/>				</td>			</tr>		</table>	</form></body></html>