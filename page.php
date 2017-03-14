<?php
$id=$_GET['id'];
$tm_stmp=$_GET['tm_stmp'];
if(!$id||!$tm_stmp){
  echo "cannot get id or tm!<br />";
  return false;
 }
 echo "$id<br />";
$date=date_create();
date_timestamp_set($date,$tm_stmp);
echo date_format($date,"U = Y-m-d H:i:s");
?>
