<?php

	require("dbConfig.php");
	
	$questionId = $_REQUEST['id'];
	$questionResult = mysql_query("SELECT * FROM poll_question WHERE id=".$questionId) or die(mysql_error());
	if (mysql_num_rows($questionResult) < 1) exit();
	
	$dataQuestion = mysql_fetch_object($questionResult);	
	
	//Show vote rating
	function getAnswerListing($questionId){
		$sqlstr = "SELECT ";
		$sqlstr .=	"id, answer, color_code ";
		$sqlstr .="FROM ";
		$sqlstr .=	"poll_answer ";
		$sqlstr .="WHERE ";
		$sqlstr .=	"question_id = ".$questionId;
		$sqlstr .=" ORDER BY question_id ASC ";

		$result = mysql_query($sqlstr) or die(mysql_error());
		return $result;
	}
	
	function getAnswerPoint($answerId){
		$pointResult = mysql_query("SELECT point FROM poll_answer WHERE id= ".$answerId) or die(mysql_error());
		$point = mysql_fetch_object($pointResult);
		return $point->point;
	}
	
	function countTotalVoter($questionId){
		$totalResult = mysql_query("SELECT count(question_id) AS totalVoter FROM poll_voter WHERE question_id = ".$questionId) or die(mysql_error());
		$totalVoter = mysql_fetch_object($totalResult) or die(mysql_error());
		return $totalVoter->totalVoter;
	}
	
	function generateBar($point){
		$color = rand(333333,999999);
		return '<div style="width:'.$point.'px;line-height:8px;border:1px solid #'.$color.';background-color:#'.$color.'">&nbsp;</div>';
		//return '<div style="width:50px; line-height:8px; border:1px solid #fd0000;background-color:#fd0000;>&nbsp;</div>';
	}
	
?>
<table>
	<tr>
		<td valign="top" style="text-align:left">
			<h2>Hasil Polling</h2>
			<?php
				//Load Vote Result
				$totalVoter = countTotalVoter($questionId);
				echo "Judul : ".$dataQuestion->poll_name."<br/>";
				echo "Pertanyaan : ".$dataQuestion->question."<br/>";
				echo "Total Pemilih : ".$totalVoter."<br/>";
				$answerRes = getAnswerListing($questionId);
				echo "<ul>";
				while ($answerListing = mysql_fetch_object($answerRes)){
					$pointPercent = round((getAnswerPoint($answerListing->id) / $totalVoter) * 100);
					if (empty($answerListing->answer)) continue;
					echo "<li>".$answerListing->answer." : ".$pointPercent."%".'<div style="width:'.$pointPercent.'px;line-height:8px;border:1px solid #'.$answerListing->color_code.';background-color:#'.$answerListing->color_code.'">&nbsp;</div>'."</li>";
					
				}
				echo "</ul>";
			?>
		</td>
	</tr>
</table>