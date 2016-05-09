<?php
	require("dbconfig.php");
	
	function uploadPicture($name){
		//Check existence file
		if((!empty($_FILES[$name])) && ($_FILES[$name]['error'] == 0)){
		  //Check filetype and size
		  $filename=basename($_FILES[$name]['name']);
		  $ext=strtolower(substr($filename,strlen($filename)-3,3));
		 
		  if (($ext=="jpg") && ($_FILES[$name]['type'] == "image/jpeg")) {
			//get new name
			$newname = 'images/'.$filename;
			  if ((move_uploaded_file($_FILES[$name]['tmp_name'],$newname))){
					return $newname;
			  } else {
					?>
						<script language="javascript" type="text/javascript">
							alert('Proses gagal. Tidak dapat memindahkan file.')
						</script>
					<?php
					exit();
			  }	
		  } else {
				?>
					<script language="javascript" type="text/javascript">
						alert('Hanya tipe file jpeg saja.')
					</script>
				<?php
				exit();
		  }
		}
	}//end process
	
	//Simpan Gambar
	if (isset($_REQUEST['save'])){
		if (empty($_FILES['uploaded_file'])){
			echo "Tidak ada file yang diupload.";
		}else{
			$title = mysql_real_escape_string($_REQUEST['title']);
			$uploadPath = uploadPicture("uploaded_file");
			
			$sqlstr = "INSERT INTO image_gallery(title, path) ";
			$sqlstr .= "VALUES('".$title."','".$uploadPath."')";
			
			$result = mysql_query($sqlstr) or die(mysql_error());
			
			echo ($result)? "Gambar telah tersimpan." : "Gagal menyimpan data.";
		}
	}
	
	$limit = 16;
	
	//Get total records
	$resTotal = mysql_query("SELECT COUNT(id) AS total FROM image_gallery") or die(mysql_error());
	$data = mysql_fetch_object($resTotal);
	$totalRec = $data->total;
	
	//Get total pages
	$totalpaging = ceil($totalRec / $limit);
		
	$paging = (!empty($_REQUEST['paging']) && $_REQUEST['paging'] != 0)? $_REQUEST['paging'] : 1 ;
	
	//Set record position
	if (empty($paging) || $paging ==0) {
		$position = 0;
		$paging=1;
	}	
	else
		$position = ($paging -1 ) * $limit;
	
	$result = mysql_query("SELECT * FROM image_gallery LIMIT $position, $limit") or die(mysql_error());
	$numRows = (mysql_num_rows($result) > $limit)? 20 : mysql_num_rows($result) ;
	if ($numRows > 0){
?>
		<link rel="stylesheet" href="style/lightbox.css" type="text/css" media="screen" />
		<script src="js/prototype.js" type="text/javascript"></script>
		<script src="js/scriptaculous.js?load=effects,builder" type="text/javascript"></script>
		<script src="js/lightbox.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/reflection.js"></script>
		<table width="500px" border="0" cellspacing="2" cellpadding="2">
			<?php
			$i = 0;
			//while ($data = mysql_fetch_object($result)){
				for ($rows = 1; $rows<=4; $rows++){
					echo "<tr>";
					for ($cols=1; $cols<=4;$cols++){
						if ($i >= $numRows) break;
						echo '<td style="text-align:center;">';
							$data = mysql_fetch_object($result);
							echo '<div style="width:100px;font-family: verdana; font-size: 11px;">',$data->title;
							echo '<a href="'.$data->path.'" rel="lightbox[roadtrip]">';
							echo '	<span style="border:0px;"><img border="0px" class="reflect" src="'.$data->path.'" width="100" height="100" alt="'.$data->title.'" /></span>';
							echo '</a></div>';							
						echo "</td>";
						$i++;
					}
					echo "</tr>";
				}
			//}
			?>
			<tr>
				<td colspan="4" style="text-align:center;">
					<?php
					if ($totalpaging > 0){
						//Write first and prev navigation
						if ($paging > 1){
							$prevpaging = 0;
							echo '<a style="text-decoration:none;" href="?page=image_gallery&paging=1"><<< First</a> ';
						}else{
							echo "<<< First ";
						}
						
						if ($paging > 1){
							$prevpaging = $paging-1;
							echo '<a style="text-decoration:none;" href="?page=image_gallery&paging='.$prevpaging.'"><< Prev</a> ...';
						}else{
							echo "<< Prev ";
						}

						//write number navigation
						if ($paging > 1){
							$beforepaging = $paging -1 ;
							echo '<a style="text-decoration:none;" href="?page=image_gallery&paging='.$beforepaging.'">'.$beforepaging.'</a> ';
						}
						if ($paging != 0)	echo $paging;
						
						if ($paging < $totalpaging && $paging != 0){
							$nextpaging = $paging + 1 ;
							echo ' <a style="text-decoration:none;" href="?page=image_gallery&paging='.$nextpaging.'">'.$nextpaging.'</a>';
						}
						
						//write next and last navigation
						if ($paging < $totalpaging){
							$nextpaging = $paging + 1;
							echo '...<a style="text-decoration:none;" href="?page=image_gallery&paging='.$nextpaging.'">Next >></a>';
						}else{
							echo " Next >>";
						}
						
						$pagingDiff = $totalpaging - ($paging - 1);				
						if ($pagingDiff > 1){					
							echo ' <a style="text-decoration:none;" href="?page=image_gallery&paging='.$totalpaging.'">Last >>></a>';
						}else{
							echo " Last >>>";
						}
					}
					?>
				</td>
			</tr>
		</table>
<?php
	}
	
?>
<br/>
<form method="post" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF']?>">
	<table width="400px" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td>Judul</td>
			<td><input type="text" name="title" value="<?php echo $imgDt->title;?>"</td>
		</tr>
		<tr>
			<td>File gambar</td>
			<td><input type="file" name="uploaded_file"/></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" name="save" value="Save"/></td>
		</tr>
	</table>
</form>