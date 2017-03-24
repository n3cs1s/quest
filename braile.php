<?php
header('Content-Type: text/html; charset=utf-8');
?>
<script type="text/javascript" src="/js/jquery-3.1.1.min.js"></script>

<body>
  <div id="target">Nothing
  </div>
<form id="formWithFiles">
<input type="file" name="file">
<input type="submit" value="submit" title="submit">
</form>

<script>
$(document).ready(function (e) {
    $("#formWithFiles").on('submit',(function(e) {
        e.preventDefault();
        $.ajax({
            url: "braile.php",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                $("#target").html("Hello!");
            }           
       });
    }));
});
</script>
