<?php
	require("dbConfig.php");
	
	if (isset($_REQUIRE['subscribe'])){
		$email = mysql_real_escape_string($_REQUEST['email']);
		$dateJoin = date('Y-m-d H:i:s');
		$sqlstr = "INSERT INTO news_subscriber(email, date_join, is_subscribtion) VALUES ('".$email."','".$dateJoin."',1)";
		$result = mysql_query($sqlstr) or die(mysql_error());
		echo ($result) ? "You're email saved successfully." : "Cannot save data.";
	}
?>
<html>
<head>
	<title>News Subscription</title>
	<script type="text/javascript">
		function validateEmailFormat(emailValue){
			var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
			if (!pattern.test(emailValue)){
				alert('Please insert correct email format.');
				return false;
			}else{
				return true;
			}
		}
	</script>
</head>
<body>
	<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
		E-Mail: <input type="text" name="email" id="email"/>
		<input type="submit" name="subscribe" value="Subscribe" onsubmit="return validateEmailFormat(document.getElementById('email').value)"/>
	</form>
</body>
</html>