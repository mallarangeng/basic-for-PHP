<?php
	require("dbConfig.php");
	
	$questionResult = mysql_query("SELECT * FROM poll_question WHERE expired >= NOW()") or die(mysql_error());
	if (mysql_num_rows($questionResult) < 1) exit();
	
	$dataQuestion = mysql_fetch_object($questionResult);

	$questionId = $dataQuestion->id;
	$answerResult = mysql_query("SELECT * FROM poll_answer WHERE question_id=".$questionId) or die(mysql_error());

	if (mysql_num_rows($answerResult) < 1) exit();
	
	//Check for existence IP address
	function checkIP($questionId){
		$sqlstr = "SELECT ip FROM poll_voter WHERE ip = '".$_SERVER['REMOTE_ADDR']."' AND question_id =".$questionId;
		$checkResult = mysql_query($sqlstr) or die(mysql_error());
		if (mysql_num_rows($checkResult) > 0)
			return true;
		else
			return false;			
	}
	
	//Get answer latest point
	function answerLatestPoint($answerId){
		$sqlstr = "SELECT point FROM poll_answer WHERE id=".$answerId;
		
		$latestPoint = mysql_query($sqlstr) or die(mysql_error());
		$data = mysql_fetch_object($latestPoint);
		return $data->point;
	}
	
	//Update rating
	function updateRating($answerId){
		$latestPoint = answerLatestPoint($answerId) + 1;
		$newRating = mysql_query("UPDATE poll_answer SET point = ".$latestPoint." WHERE id=".$answerId) or die(mysql_error());
		if ($newRating)
			return true;
		else
			return false;			
	}
	
	//Mark this voter
	function markIp($questionId, $answerId){
		$markIp = "INSERT INTO poll_voter(question_id, answer_id, ip, date) ";
		$markIp .= "VALUES(".$questionId.",".$answerId.",'".$_SERVER['REMOTE_ADDR']."','".date('Y-m-d')."')";
		
		$markIpResult = mysql_query($markIp) or die(mysql_error());
		if ($markIpResult)
			return true;
		else
			return false;	
	}
	
	//Vote!!!!
	if (isset($_REQUEST['vote'])){
		$questionId = $_REQUEST['questionId'];
		$choosenAnswer = $_REQUEST['answer'];
	
		if (checkIP($questionId)){
			echo "Anda telah ikut dalam polling ini.";
		}else{
			if (updateRating($choosenAnswer)){
				if (markIp($questionId, $choosenAnswer))
					echo "Terimakasih atas partisipasi anda.";
				else
					echo "Maaf tidak dapat memproses polling. Silahkan datang kembali.";
			}else{
				echo 'Maaf, tidak dapat memproses polling. Silahkan datang kembali.';
			}
		}
		
	}
?>
<html>
<head>
	<title>Voting Please</title>
</head>
<body>
<table>
	<tr>
		<td valign="top" style="text-align:left">
			<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
				Judul : <?php echo $dataQuestion->poll_name; ?><br/>
				Pertanyaan : <?php echo $dataQuestion->question; ?><br/>
				<input type="hidden" name="questionId" value="<?php echo $dataQuestion->id; ?>"/>
				<?php
				while ($dataAnswer = mysql_fetch_object($answerResult)){
					if (empty($dataAnswer->answer)) continue;
					?>
					<input type="radio" name="answer" value="<?php echo $dataAnswer->id; ?>"/>
					<?php echo $dataAnswer->answer; ?><br/>
				<?php
				}
				?>
				<input type="submit" name="vote" value="Vote!!!"/> | <a href="voting_result.php?id=<?php echo $questionId; ?>">Lihat hasil</a>
			</form>
		</td>
	</tr>
</table>
</body>
</html>