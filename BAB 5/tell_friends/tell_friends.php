<?php
	if (isset($_REQUEST['submit'])){
		require_once('dbconfig.php');
		$name = $_REQUEST['nama'];
		$email = $_REQUEST['myEmail'];
		$emailAddressArr = $_REQUEST['email'];
				
		if (!ereg('^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])$',$email)){
			echo "Masukkan format email yang benar!!!";
		}
		
		for ($i=0;$i<=3;$i++){
			if (empty($emailAddressArr[$i])) continue;
			$emailAddressList .= $emailAddressArr[$i]. ",";
		}
		$emailAddressList = substr($emailAddressList,0,strlen($emailAddressList) -1 );
				
		$emailAddressList = implode(",",$emailAddressArr);
		
		//tell my friends...
		$from = "From: admin garudamedia \n";
		$from .= "Reply-To: info@garudamedia.co.id \n";
		$from .= "Content-type: text/html \r\n";
		
		$subject = "Bergabung ke garudiamedia.";
		
		$emailBody = '<p>Hai...</p>';
		$emailBody .= '<p>	Teman anda yang bernama '.$name.' telah mereferensikan anda untuk bergabung ke website kami, yaitu: <a href="http://www.garudamedia.co.id" target="_blank">garudamedia</a>.</p>';
		$emailBody .= '<p>	&nbsp;</p>';
		$emailBody .= '<p>	salam,</p>';
		$emailBody .= '<p>	&nbsp;</p>';
		$emailBody .= '<p>	garudamedia crew</p>';

		$tellThem = mail($emailAddressList, $subject, $emailBody, $from);
			
		if ($tellThem){
			echo "Terima kasih telah mereferensikan teman anda untuk bergabung di website kami";
		}else{
			echo "Maaf terjadi kesalahan saat pemrosesan data. Silahkan ulangi sekali lagi atau hubungi administrator kami.";
		}
	}
?>
<script language="javascript" type="text/javascript">
var nothing = 0;
var myEmail = '';
var myName = '';
var acceptedEmails = '';

function emailValidation(emailValue){
	//alert("parameter: " + emailValue)
	//alert(emailValue.indexOf("Email Teman "))
	if (emailValue <> ''){
		var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
		if (!pattern.test(emailValue)){
			alert('Harap masukan format E-Mail yang benar');
			return false;
		}else{
			return true;
		}
	}else{
		nothing += 1;
		return true;
	}
}

function validateTellFriends(){
	
	myName = document.getElementById('name').value;
	
	if (myName == 'Nama Anda...'){
		alert('Nama anda masih kosong.');
		return false;
		exit();
	}
	
	myEmail = document.getElementById('myEmail').value;
	
	var emailPattern = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
	if (!emailPattern.test(myEmail)){
		alert('Harap masukan format E-Mail yang benar');
		return false;
		exit();
	}
	
	emailArr  = new Array(3);
	
	emailArr = [ document.getElementById('email1').value, document.getElementById('email2').value,document.getElementById('email3').value];
	
	for (i=0; i<=3; i++){
		if (!emailValidation(emailArr[i])){ return false; exit()};
	}
	
	return true;
}
</script>
<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" onsubmit="validateTellFriends()">
<table>
	<tr>
		<td colspan="2" valign="middle">Tell Friends</td>
	</tr>
	<tr>
		<td>Nama Anda</td>
		<td><input size="30" type="text" name="nama"/></td>
	</tr>
	<tr>
		<td>Email</td>
		<td><input size="30" type="text" name="myEmail"/></td>
	</tr>
	<tr>
		<td colspan="2"><hr/></td>
	</tr>
	<tr>
		<td>Email Teman 1</td>
		<td><input size="30" name="email[]"/></td>
	</tr>
	<tr>
		<td>Email Teman 2</td>
		<td><input size="30" name="email[]"/></td>
	</tr>
	<tr>
		<td>Email Teman 3</td>
		<td><input size="30" name="email[]"/></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" name="submit" value="Kirim"/></td>
	</tr>
</table>
</form>