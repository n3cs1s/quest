<?php
$id=$_GET['id'];
$tm_stmp=$_GET['tm_stmp'];
if(!$id||!$tm_stmp){
  echo "cannot get id or tm!<br />";
  return false;
 }
 echo "$id<br />";
?>
