<?php
include "config/settings.php";
header('Content-Type: text/html; charset=utf-8');
/*

get from database $id, $quest, $answ;

*/

$connect = new mysqli($server,$user,$pass,$db);
if($connect->connect_error){
	die("Can't connect to database".$connect->connect_error);
}
$num =1;
$sql = "SELECT * FROM ".$table." WHERE id=".$num;

$result = $connect->query($sql);
$id=1;
$quest="?";
$answ="Мороз";


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $id=$row["id"];
	$quest=$row["quest"];
	$answ=$row["answ"];
    }
} else {
    echo "0 results";
}

$connect->close();

$arr=range(1,10);
$pictures=array_rand($arr,9);
$pictures[]=$id;
shuffle($pictures);

?>

<html>
<head>
<title>
Відгадай.com
</title>
<link rel="stylesheet" text="text/css" href="css/styles.css" />
<script type="text/javascript" src="/js/jquery-3.1.1.min.js"></script>
</head>
<body>
<div class="splash_img">
<div class="back-img">

<?php
while(list(,$picture) = each($pictures)){
	echo "<img src=\"/images/$picture.jpg\" />";
}
/*
<img src="/images/3.jpg" />
<img src="/images/vesna.jpg" />
<img src="/images/3.jpg" />
<img src="/images/vesna.jpg" />
<img src="/images/3.jpg" />
<img src="/images/vesna.jpg" />
<img src="/images/3.jpg" />
<img src="/images/vesna.jpg" />
<img src="/images/3.jpg" />
<img src="/images/vesna.jpg" />
*/
?>
</div>

<div class="main-img">
<h1>Відгадай.com!</h1>
<div class="main-quest">
<?php


echo $quest;


?>
</div>
</div>
</div>
<div id="res">
<h1>
<?php
	echo $answ;
	
?>
	</h1>
</div>
<div class="footer">
<div class="content">
<ul>
<li><a href="/about.php">About</a></li>
<li><a href="/contact.php">Contact</a></li>
</ul>
</div>
</div>

<script>
$("img").click(function(){
	if( $(this).attr("src") == "/images/"+<?php echo $id; ?>+".jpg" ){
		$("#res").css("background-image","url("+$(this).attr("src")+")");
		$("#res").show();
		$(".back-img").slideUp();
		$(location).attr('href',"#res");
	}
});
</script>
