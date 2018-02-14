<?php
 $to = "hok14@pitt.edu";
 $subject = "Hi!";
 $body = "Hi,\n\nHow are you?";
  $from = "test";
 if (mail($to, $subject, $body,"From:".$from)) {
  echo("<p>Email successfully sent!</p>");
  } else {
  echo("<p>Email delivery failed…</p>");
  }
?>
