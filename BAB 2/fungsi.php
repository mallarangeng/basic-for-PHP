<?php
	function tambah($a, $b){
		$hasil = $a + $b;
		return $hasil;
	}
	
	function procedureTambah($a, $b){
		$hasil = $a + $b;
		echo $hasil;
	}
	
	echo "Fungsi penambahan:".tambah(5,4)."<br/>";
	procedureTambah(6,8)
	
?>