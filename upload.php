<?php
$upload='';
$filename="";
if(isset($_FILES["file"]["name"])){
  $upload= $_FILES["file"]["name"];
  $content=nl2br(file_get_contents($_FILES['file']['tmp_name']));
  $filename=$_FILES['file']['tmp_name'];
}
//echo $content;
$content ="";
exec("lou_translate -b sk.tbl $filename",$content);
print_r($content);
?>
