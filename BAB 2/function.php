<?php
	function tambah($a, $b){
		$hasil = $a + $b;
		return $hasil;
	}
	
	function tambahNoReturn($a, $b){
		$hasil = $a + $b;
		echo $hasil;
	}
	
	echo "Penggunaan Fungsi dalam PHP<br/>";
	echo "Hasil penjumlahan:".tambah(5,4)."<br/>";
	echo "Hasil penjumlahan:";
	tambahNoReturn(6,7);
?>