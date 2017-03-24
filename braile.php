<?php
header('Content-Type: text/html; charset=utf-8');
?>
<script type="text/javascript" src="/js/jquery-3.1.1.min.js"></script>

<body>
<form id="formWithFiles" method="POST" enctype="multipart/form-data">
<input type="file" name="file">
<input type="submit" value="submit" title="submit">
</form>

<script>
$.ajax({
  url: 'destination.txt', 
  type: 'POST',
  data: new FormData($('#formWithFiles')[0]), // The form with the file inputs.
  processData: false                          // Using FormData, no need to process data.
}).done(function(){
  console.log("Success: Files sent!");
}).fail(function(){
  console.log("An error occurred, the files couldn't be sent!");
});
</script>
