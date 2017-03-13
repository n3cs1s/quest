<?php
include "config/settings.php";
/*

get from database $id, $quest, $answ;

*/

$connect = new mysqli($server,$user,$pass,$db);
if($connect->connect_error){
	die("Can't connect to database".$connect->connect_error);
}

$connect->query("SET character_set_results=utf8");

$count=$connect->query("SELECT COUNT(*) FROM ".$table);

//$field_count =$count["field_count"]; 
//Вибирає останню додану загадкку, для вибору випадкової - створити $arr_fields=range(1,$field_count), потім $num=array_rand($array_fileds,1);

$num=1;
while($cnt = mysqli_fetch_row($count)) {
        $field_count= $cnt[0];
    }
$arr_fields=range(1,$field_count);

$num_arr=$arr_fields[mt_rand(0, count($arr_fields) - 1)];
$num=$num_arr;

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

$arr=range(1,$field_count);
$pictures=array_rand($arr,6);
$pictures[]=$id;
shuffle($pictures);

header('Content-Type: text/html; charset=utf-8');

?>

<title>
Відгадай.com
</title>
<link rel="stylesheet" text="text/css" href="css/new.styles.css" />
<script type="text/javascript" src="/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="/js/js.cookie-2.1.3.min.js"></script>

</head>
<body>
<div class="splash_img">
<div class="back-img">

<?php
	$i=0;
while(list(,$picture) = each($pictures)){
	$i++;
	echo "<img src=\"/images/$picture.jpg\" style='order:$i' />";
}

?>
<div class="main-img">
<h1>Відгадай.com!</h1>
<div class="main-quest">

	
<?php


echo $quest;


?>
</div>
</div>
</div>
	</div>

<div id="res">
<h1>
<?php
	echo "Правильно: ".$answ."!";
	
?>
	</h1>
	<input type="button" onclick="$(location).attr('href', 'http://відгадай.com/')" value="Хочу ще!" />
</div>

<div id="about">
	<h1>Про нас</h1>
	<div>Загадка - безцінний інструмент розвитку мислення, як для дітей так і для дорослих.<br /> 
		Саме відгадуючи загадки людина вчиться виходити за рамки звичайного контексту логічного мислення, розвиваються творчість та уява.
		<br />
		Відгадуйте та розвивайтесь разом із нами!<br /><br />
	</div>
	<div>
		Проект створено за підтримки <a href="http://pmu.in.ua/">Педагогічного музею України"</a> та <br />
		компанії <a href="https://folk.in.ua/">"ФОЛК"</a>
	</div>
</div>
<div id="contact">
	<h1>Контакти</h1>
	<h3>тел. 0967612308<br />
		емейл:pavel.primavera[@]gmail.com</h3>
</div>

<div class="footer">
<div class="content">
<ul>
	<li><a href="/">Головна</a></li>
	<li><a href="#about" onclick="$('.back-img').slideUp();$('#about').show();">Про нас</a></li>
<li><a href="#contact" onclick="$('.back-img').slideUp();$('#contact').show();">Контакти</a></li>
	<li>Ваш результат: <span id="score"></span></li>
</ul>
</div>
</div>

	
<script>
$(function(){
	var scr=Cookies.get('score');
	if(scr=="NaN")scr=0;
	Cookies.set(scr);
	$('#score').text(scr);
	console.log(scr);
});
$("img").click(function(){
	if( $(this).attr("src") == "/images/"+<?php echo $id; ?>+".jpg" ){
		$("#res").css("background-image","url("+$(this).attr("src")+")");
		$("#res").show();
		$(".back-img").slideUp();
		
		var scr=Cookies.get('score');
		if(scr=="NaN")scr=0;
		scr++;
		Cookies.set('score', scr);
		console.log("scr = "+scr+";");
		$('#score').text(scr);
		$(location).attr('href',"#res");
	}
});
</script>
