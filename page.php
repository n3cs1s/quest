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
$year_get= date_format($date,"Y");

$l_date=date_create();
$local_year = date_format($l_date,"Y");

if($year_get!=$local_year){
  echo "$year_get - $local_year <br />";
  echo "This is another year dude!<br />";
  return false;
}
echo "All checked!<br />";
?>
