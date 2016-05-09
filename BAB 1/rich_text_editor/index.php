<html>
<head>
  <title>Rich Text Editor</title>
  <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
  <link href="ckeditor/content.css" rel="stylesheet" type="text/css"/>

</head>
<body>
<?php
  if (isset($_REQUEST['ok'])){
	$judul = $_REQUEST['judul'];
	$content = $_REQUEST['news'];
	echo "Judul:<b>$judul</b><br/>";
	echo "Isi berita:<br/>$content<br/>";
  }
?>
<h1>Input Berita</h1>
<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
<table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td>Judul</td>
	<td><input type="text" name="judul" size="50"/></td>
</tr>
<tr>
	<td valign="top">Isi Berita</td>
	<td>
		<textarea cols="80" id="news" name="news" rows="10"></textarea>
				<script type="text/javascript">
					var editor = CKEDITOR.replace('news');
				</script>
	</td>
</tr>
<tr>
	<td colspan="2">
		<input type="submit" value="Simpan" name="ok"/>
	</td>
</tr>
</table>
</form>
</body>
</html>