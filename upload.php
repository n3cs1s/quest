<?php
$upload='';
if(isset($_FILES["file"]["name"])){
  $upload= $_FILES["file"]["name"];
  $content=file_get_contents($_FILES['file']['tmp_name']);
}
echo $content;
?>
