<?php
require("../dbconfig.php");
function getLatestQuestion(){
	$result = mysql_query("SELECT MAX(id) AS maxId FROM poll_question") or die(mysql_error());
	if (mysql_num_rows($result) > 0){		
		$data = mysql_fetch_object($result);
		return $data->maxId;
	}else
		return 0;
}

//Delete Polling
if (!empty($_REQUEST['id']) && $_REQUEST['mode'] == 'delete'){

	$delQuestion = mysql_query("DELETE FROM poll_question WHERE id=".$_REQUEST['id']) or die(mysql_error());
	$delAnswer = mysql_query("DELETE FROM poll_answer WHERE question_id=".$_REQUEST['id']) or die(mysql_error());
	
	if ($delQuestion && $delAnswer)	echo "Data telah terhapus.";
	
}

//Load Edit Data Polling
if (!empty($_REQUEST['id']) && $_REQUEST['mode'] == 'edit'){
	
	$editPoll = mysql_query("SELECT Q.id, Q.poll_name, Q.question, Q.expired, A.answer, A.id AS answerId FROM poll_question Q, poll_answer A WHERE Q.id = A.question_id AND Q.id = ".$_REQUEST['id']) or die(mysql_error());
	if (mysql_num_rows($editPoll) > 0)	{
		
		while ($pollData = mysql_fetch_object($editPoll)){			
			$pollId = $pollData->id;
			$pollName = $pollData->poll_name;
			$question = $pollData->question;
			$expired = $pollData->expired;
			$answerId[] = $pollData->answerId;
			$answer[] = $pollData->answer;
		}
		$expiredArr = explode("-",$expired);
		$expired = $expiredArr[1]."/".$expiredArr[2]."/".$expiredArr[0];
	}	
}

function generateBar($max){
	$color = rand(333333,999999);
	$colorArr[0] = $color;
	for ($i=0; $i <= $max; $i++){
		while (in_array($color, $colorArr)){
			$color = rand(333333,999999);
		}
		$colorArr[$i] = $color;
	}
	
	return $colorArr;
	
}

if ($_REQUEST['save']){
	
	$pollname = mysql_real_escape_string($_REQUEST['pollname']);
	$question = mysql_real_escape_string($_REQUEST['question']);
	$answers = $_REQUEST['answer'];
	$answersId = $_REQUEST['answerId'];
	$date = date('Y-m-d H:i:s');
	
	//INSERT NEW QUESTION
	
	$expiredArr = explode("/",$_REQUEST['expiredDate']);
	$expiredDate = $expiredArr[2]."-".$expiredArr[0]."-".$expiredArr[1];
	if (!empty($_REQUEST['pollId'])){
		$sqlstr = "UPDATE poll_question SET poll_name='".$pollname."', question='".$question."' WHERE id=".$_REQUEST['pollId'];
	}else{
		$sqlstr = "INSERT INTO poll_question(poll_name, question, expired) ";
		$sqlstr .= "VALUES('".$pollname."','".$question."','".$expiredDate."')";
	}
	
	$resultQuestion = mysql_query($sqlstr) or die("Gagal menyimpan data.".mysql_error());
	
	$questionId = getLatestQuestion();
	
	
	//INSERT ANSWER
	$i=0;
	$max = count($answers) - 1;
	$colorCode = generateBar($max);
	for ($i=0;$i<=$max;$i++){
		if (!empty($_REQUEST['pollId']) && !empty($answersId[$i])){			
			$sqlstr = "UPDATE poll_answer SET answer ='".mysql_real_escape_string($answers[$i])."' WHERE question_id=".$_REQUEST['pollId']." AND id=".$answersId[$i];
		}else{
			if (empty($answers[$i])) continue;
			
			$sqlstr = "INSERT INTO poll_answer(question_id, answer, color_code) ";
			$sqlstr .= "VALUES('".$questionId."','".mysql_real_escape_string($answers[$i])."','".$colorCode[$i]."')";
		}
		
		$resultAnswer = mysql_query($sqlstr) or die("Gagal menyimpan data.".mysql_error());
		
	}
	
	if ($resultAnswer && $resultQuestion) echo "Polling baru telah tersimpan.";
	
}


?>
<html>
<head>
	<title>Polling Admin</title>
	<link rel="stylesheet" href="js/datepicker/ui.datepicker.css" type="text/css" media="screen" title="Flora (Default)" />
	<script type="text/javascript" src="js/datepicker/jquery.js"></script>
	<script type="text/javascript" src="js/datepicker/ui.datepicker.js"></script>
	<script type="text/javascript">
		if (!window.console) {
			window.console = {
				log: function() {
					alert(arguments[0]);	
				}
			}
		}

		$(window).bind("load",function(){
			$.datepicker.setDefaults($.datepicker.regional['']);
			$(".demojs").each(function () {
				
				$('.codeLink').click(function() {
					$(this).hide().siblings('pre').show();
				});
				eval($(this).html());
			});
		});
		
	</script>
</head>
<body>
	<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
		<table style="font: 11px verdana;">
			<tr>
				<td>Judul polling : </td>
				<td>
					<input type="text" name="pollname" size="25" value="<?php echo $pollName;?>"/>
					<input type="hidden" name="pollId" value="<?php echo $pollId;?>"/>
				</td>
			</tr>
			<tr>
				<td>Pertanyaan : </td>
				<td><input type="text" name="question" size="40" value="<?php echo $question;?>"/></td>
			</tr>
			<tr>
				<td>Berakhir pada : </td>
				<td>
					<input type="text" name="expiredDate" id="expiredDate" size="10" value="<?php echo $expired;?>"/>
					<script type="text/jsdemo" charset="utf-8" class="demojs">
					$('#expiredDate').datepicker({showOn: 'both', showOtherMonths: true, 
						showWeeks: true, firstDay: 1, changeFirstDay: false,
						buttonImageOnly: true, buttonImage: 'js/datepicker/calendar.gif'});	
					</script>
				</td>
			</tr>
			<tr>
				<td valign="top">
					Jawaban:
				</td>
				<td>
					1.&nbsp;&nbsp;<input type="text" name="answer[]" value="<?php echo $answer[0];?>"/>
					<input type="hidden" name="answerId[]" value="<?php echo $answerId[0];?>"/><br/>
					2.&nbsp;&nbsp;<input type="text" name="answer[]" value="<?php echo $answer[1];?>"/>
					<input type="hidden" name="answerId[]" value="<?php echo $answerId[1];?>"/><br/>
					3.&nbsp;&nbsp;<input type="text" name="answer[]" value="<?php echo $answer[2];?>"/>
					<input type="hidden" name="answerId[]" value="<?php echo $answerId[2];?>"/><br/>
					4.&nbsp;&nbsp;<input type="text" name="answer[]" value="<?php echo $answer[3];?>"/>
					<input type="hidden" name="answerId[]" value="<?php echo $answerId[3];?>"/><br/>
					5.&nbsp;&nbsp;<input type="text" name="answer[]" value="<?php echo $answer[4];?>"/>
					<input type="hidden" name="answerId[]" value="<?php echo $answerId[4];?>"/><br/>
					6.&nbsp;&nbsp;<input type="text" name="answer[]" value="<?php echo $answer[5];?>"/>
					<input type="hidden" name="answerId[]" value="<?php echo $answerId[5];?>"/><br/>
					7.&nbsp;&nbsp;<input type="text" name="answer[]" value="<?php echo $answer[6];?>"/>
					<input type="hidden" name="answerId[]" value="<?php echo $answerId[6];?>"/><br/>
					8.&nbsp;&nbsp;<input type="text" name="answer[]" value="<?php echo $answer[7];?>"/>
					<input type="hidden" name="answerId[]" value="<?php echo $answerId[7];?>"/><br/>
					9.&nbsp;&nbsp;<input type="text" name="answer[]" value="<?php echo $answer[8];?>"/>
					<input type="hidden" name="answerId[]" value="<?php echo $answerId[8];?>"/><br/>
					10.&nbsp;<input type="text" name="answer[]" value="<?php echo $answer[9];?>"/>
					<input type="hidden" name="answerId[]" value="<?php echo $answerId[9];?>"/><br/>
					11.&nbsp;<input type="text" name="answer[]" value="<?php echo $answer[10];?>"/>
					<input type="hidden" name="answerId[]" value="<?php echo $answerId[10];?>"/><br/>
					12.&nbsp;<input type="text" name="answer[]" value="<?php echo $answer[11];?>"/>
					<input type="hidden" name="answerId[]" value="<?php echo $answerId[11];?>"/><br/>
					13.&nbsp;<input type="text" name="answer[]" value="<?php echo $answer[12];?>"/>
					<input type="hidden" name="answerId[]" value="<?php echo $answerId[12];?>"/><br/>
					14.&nbsp;<input type="text" name="answer[]" value="<?php echo $answer[13];?>"/>
					<input type="hidden" name="answerId[]" value="<?php echo $answerId[13];?>"/><br/>
					15.&nbsp;<input type="text" name="answer[]" value="<?php echo $answer[14];?>"/>
					<input type="hidden" name="answerId[]" value="<?php echo $answerId[14];?>"/><br/>
				</td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" name="save" value="Save"/></td>
			</tr>
		</table>
	</form>
	
	<h2>Daftar Polling</h2>
	<table border="0" cellpadding="0" cellspacing="2" style="font: 11px verdana;">		
		<tr style="background-color: #fd0000; color: #fff;">
			<th>Judul Polling</th><th>Pertanyaan</th><th>Berakhir</th><th>Action</th>
		</tr>
		<?php
		$sqlResult = mysql_query("SELECT * FROM poll_question");
		if (mysql_num_rows($sqlResult)>0){
			while($data = mysql_fetch_object($sqlResult)){
				?>
				<tr>
					<td><?php echo $data->poll_name; ?></td>
					<td><?php echo $data->question; ?></td>
					<td><?php echo $data->expired; ?></td>
					<td>
						<a href="?id=<?php echo $data->id; ?>&mode=delete">Hapus</a> | 
						<a href="?id=<?php echo $data->id; ?>&mode=edit">Edit</a>
					</td>
				</tr>
				<?php
			}
		}else{
		?>
		<tr>
			<td colspan="4">Tidak ada polling</td>
		</tr>
		<?php
		}
		?>
	</table>	
</body>
</html>