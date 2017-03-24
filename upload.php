<?php
$upload='';
if(isset($_FILES["file"]["name"])){
  $upload= $_FILES["file"]["name"];
  $content=nl2br(file_get_contents($_FILES['file']['tmp_name']));
}
echo $content;
?>
