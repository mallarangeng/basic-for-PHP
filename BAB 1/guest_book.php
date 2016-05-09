<html>
<head>
	<title>Aplikasi Guest Book - Garuda Media</title>
</head>
<style type="text/css">
  body, td, input{ font-style:verdana; font-size:12px; }
</style>
<body>

<?php
  if (isset($_REQUEST['simpan'])){
    $nama = $_REQUEST['nama'];
    $email = $_REQUEST['email'];
    $pesan = $_REQUEST['pesan'];

    echo "<h1>Pesan dari tamu</h1>";
    echo "Nama: $nama<br/>";
    echo "E-Mail: $email<br/>";
    echo "Pesan: $pesan<br/>";
  }
?>

<form method="get" action="<?php $_SERVER['PHP_SELF'] ?>">
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td>Nama</td>
      <td><input type="text" name="nama"/></td>
    </tr>
    <tr>
      <td>E-Mail </td>
      <td><input type="text" name="email"/></td>
    </tr>
    <tr>
      <td valign="top">Pesan</td>
      <td valign="top"><textarea rows="5" cols="35" name="pesan"></textarea></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" name="simpan" value="Simpan"/></td>
    </tr>
  </table>
</form>

</body>
</html>