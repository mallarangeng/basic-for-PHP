<?php

  echo "<h1>Perulangan</h1><hr/>";

  //FOR
  echo "<b>Bentuk FOR</b><br/>";
  for ($i=1;$i<=10;$i++){
	echo "$i ";
  }

  //WHILE
  echo "<br/><b>Bentuk WHILE</b><br/>";
  $j=1;
  while ($j <= 5){
	echo "$j ";
	$j++;
  }

  //DO WHILE
  echo "<br/><b>Bentuk DO WHILE</b><br/>";
  $k=1;
  Do{
    echo "$k ";
    $k++;
  }while($k <= 5);

  //FOREACH hanya pada array
  
  echo "<br/><b>Bentuk FOREACH</b><br/>";
  $notelp["Anna"] = "0341123456";
  $notelp["Budi"] = "03121354893";
  $notelp["Johan"] = "021435645779";
  foreach($notelp as $value){
    echo "$value <br/>";
  }

  //CONTINUE
  echo "<b>Penggunaan CONTINUE dalam perulangan</b><br/>";
  for ($i=1;$i<=5;$i++){
    if ($i == 2)
	  continue;
	echo "$i ";
  }
?>