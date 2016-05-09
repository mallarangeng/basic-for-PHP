<?php
  $to = "kasuma.yuda@gmail.com";
  $subject = "Testing email";
  $message = "hai...<b>apa kabar???</b>";
  $header = "from:admin@garudamedia.com \n";
  $header .= "Content-Type: text/html \r \n";
  $sendMail = mail($to,$subject,$message);
  
  echo ($sendMail)?"Email sukses terkirim":"Email gagal terkirim";
?>