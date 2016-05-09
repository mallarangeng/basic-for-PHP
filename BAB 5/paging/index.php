<?php
	require("dbConfig.php");
	
	$limit = 10;
	
	//GET total records
	$resTotal = mysql_query("SELECT COUNT(id) AS total FROM address_book") or die(mysql_error());
	$data = mysql_fetch_object($resTotal);
	$totalRec = $data->total;
	
	//GET total pages
	$totalPage = ceil($totalRec / $limit);
	
	//Set record position and current page
	$page = $_REQUEST['page'];
	if (empty($page) || $page ==0) {
		$position = 0;
		$page=1;
	}	
	else		
		$position = ($page -1 ) * $limit;
	echo "Total records : ".$totalRec."<br/>";
	echo "Total halaman : ".$totalPage."<br/>";
	echo "Halaman sekarang : ".$page."<br/><br/>";
	
	$result = mysql_query("SELECT * FROM address_book LIMIT $position, $limit") or die(mysql_error());
	
?>
	<table>
		<?php
			while ($data = mysql_fetch_object($result)){
				?>
				<tr>
					<td><?php echo $data->id;?></td>
					<td><?php echo $data->nama;?></td>
					<td><?php echo $data->alamat;?></td>
					<td><?php echo $data->telepon;?></td>
				</tr>
				<?php
			}
		?>
		<tr>
			<td colspan="4">
			<?php
				//Write first and prev navigation
				if ($page > 1){
					$prevPage = 0;
					echo '<a style="text-decoration:none;" href="?page=1"><<< First</a> ';
				}else{
					echo "<<< First ";
				}
				
				if ($page > 1){
					$prevPage = $page-1;
					echo '<a style="text-decoration:none;" href="?page='.$prevPage.'"><< Prev</a> ...';
				}else{
					echo "<< Prev ";
				}
			
				//write number navigation
				if ($page > 1){
					$beforePage = $page -1 ;
					echo '<a style="text-decoration:none;" href="?page='.$beforePage.'">'.$beforePage.'</a> ';
				}
				if ($page != 0)	echo $page;
				
				if ($page < $totalPage && $page != 0){
					$nextPage = $page + 1 ;
					echo ' <a style="text-decoration:none;" href="?page='.$nextPage.'">'.$nextPage.'</a>';
				}
				
				//write next and last navigation
				if ($page < $totalPage){
					$nextPage = $page + 1;
					echo '...<a style="text-decoration:none;" href="?page='.$nextPage.'">Next >></a>';
				}else{
					echo " Next >>";
				}
				
				//$pageDiff = $totalPage - ($page - 1);				
				//if ($pageDiff > 1){	
				if ($page < $totalPage){
					echo ' <a style="text-decoration:none;" href="?page='.$totalPage.'">Last >>></a>';
				}else{
					echo " Last >>>";
				}
			?>
			</td>
		</tr>
	</table>