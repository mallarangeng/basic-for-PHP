<?php
	require("dbConfig.php");
?>
<html>
<head>
	<title>Menampilkan Data</title>
</head>
<body>
<?php
	$result = mysql_query("SELECT * FROM address_book") or die(mysql_error());
	
?>
	<table width="400px" border="0" cellpadding="0" cellspacing="0">
		<tr style="background-color:#fd0000; color:#fff;">
			<th><th>Nama</th><th>Alamat</th><th>Telepon</th>
		</tr>
		<?php
		$i = 0;
		while ($data = mysql_fetch_array($result)){
		?>
			<tr style="background-color:#<?php echo ($i % 2 == 0)? "00c6ff" : "ffd200"; ?>">
				<td><input type="checkbox" name="checkMe" value=""></td>
				<td><?php echo $data['nama']; ?></td>
				<td><?php echo $data['alamat']; ?></td>
				<td><?php echo $data['telepon']; ?></td>
			</tr>
		<?php
			$i++;
		}
		?>
	</table>
</body>
</html>