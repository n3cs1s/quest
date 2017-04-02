<?php
$id=$_GET['id'];
$tm_stmp=$_GET['tm_stmp'];
if(!$id||!$tm_stmp){
  echo "Error requesting page!<br />";
  return false;
 }
$date=date_create();
date_timestamp_set($date,$tm_stmp);
$year_get= date_format($date,"Y");

$l_date=date_create();
$local_year = date_format($l_date,"Y");

if($year_get!=$local_year){
  //echo "$year_get - $local_year <br />";
  echo "Error requesting this page!<br />";
  return false;
}
if(!is_numeric($id)){
  echo "Unknown type!<br />";
  return false;
}
include "config/settings.php";


$connect = new mysqli($server,$user,$pass,$db);
if($connect->connect_error){
	die("Can't connect to database".$connect->connect_error);
}
$connect->query("SET character_set_results=utf8");
$result=$connect->query("SELECT * FROM ".$table." WHERE id=".$id.";");

if($result->num_rows > 0){
  $row=$result->fetch_row();

  $id=$row[0];
  $quest=$row[1];
  $answ=$row[2];
}else{
  $id=0;
  $quest="Потрібна загадка не знайдена!";
  $answ="";
}
$connect->close();

$arr=range(1,36);
$pictures=array_rand($arr,6);
$pictures[]=$id;
shuffle($pictures);


header('Content-Type: text/html; charset=utf-8');

?>
<meta charset="UTF-8">
  <meta name="description" content="ВідгадайКо - <?php echo $quest; ?>">
  <meta name="keywords" content="загадки, ребуси, головоломки, сервіс загадок, Відгадайко">
  <meta name="author" content="Pavlo Stepanovych">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
ВідгадайКо: <?php echo mb_substr($quest,0,30)."..."; ?>
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
<h1>ВідгадайКо</h1>
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
		 - Джей Джей Абрамс - "Загадка — каталізатор уяви."<br />
		 - Джон Фаулз - "... в будь-якій загадці прихована енергія. І той хто шукає відповідь, цією енергією живиться"<br />
		 - Едгар Аллан По. Золотий жук - "Жоден людьський розум не в змозі вигадати таку головоломку, яку інша людина, наділена певною кмітливістю та правильно її застосовуючи, була б не в змозі розгадати."<br />
		<br />Саме відгадуючи загадки людина вчиться виходити за рамки звичайного контексту логічного мислення, розвиваються творчість та уява.
		<br />Відгадуйте та розвивайтесь разом із нами!<br />
	</div>
	<div>
		<center>Проект створено за підтримки:</center> <br />
		<a href="http://pmu.in.ua/">Педагогічного музею України"</a> | <a href="https://www.facebook.com/%D0%9F%D0%B5%D0%B4%D0%B0%D0%B3%D0%BE%D0%B3%D1%96%D1%87%D0%BD%D0%B8%D0%B9-%D0%BC%D1%83%D0%B7%D0%B5%D0%B9-%D0%A3%D0%BA%D1%80%D0%B0%D1%97%D0%BD%D0%B8-100969013399655/?pnref=story">Педагогічний музей України</a><br />
		<a href="https://folk.in.ua/">Соціальної мережі "ФОЛК"</a>
	</div>
</div>
<div id="contact">
	<h1>Контакти</h1>
	<span>тел. 0967612308<br />
		емейл:pavel.primavera@gmail.com<br />
		twitter:<a href="https://twitter.com/vidgadai_com">ВідгадайКо</a><br />
		folk:<a href="https://folk.in.ua/profile/vidgad">ВідгадайКо</a><br />
		facebook:<a href="http://fb.me/VidgadaiKo">ВідгадайКо</a></span>
</div>

<div class="footer">
<div class="content">
<ul>
	<li><a href="/">Головна</a></li>
	<li><a href="#about" onclick="$('#about').show();">Про нас</a></li>
<li><a href="#contact" onclick="$('#contact').show();">Контакти</a></li>
<li>Ваш результат: <span id="score"></span></li>
	<li><a href="" style="display:button;" onclick="Cookies.remove('got_it',{path:'/'});Cookies.remove('score',{path:'/'});location.reload();">Скинути результати!</a></li>
	<li><a href="/page.php?id=<?php echo $id; ?>&tm_stmp=<?php echo time(); ?>">Поділитись загадкою</a></li>
</ul>
</div>
</div>

	
<script>
$(function(){
	var scr=Cookies.get('score');
	if(!scr)scr=0;
	Cookies.set('score',scr);
	$('#score').text(scr);
});
$("img").click(function(){
	if( $(this).attr("src") == "/images/"+<?php echo $id; ?>+".jpg" ){
		$("#res").css("background-image","url("+$(this).attr("src")+")");
		$("#res").show();
		$(".back-img").slideUp();
		
		var scr=Cookies.get('score');
		var get=Cookies.get("got_it");
		if(get) {
			var get_it=$.parseJSON(get);//JSON.parse(Cookies.get('got_it'));
		}else{
			var get_it=[];
		}
		get_it.push(<?php echo $id; ?>);
		console.log(get_it);
		
		
		var arr_got=JSON.stringify(get_it);
		Cookies.set('got_it',arr_got);
		
		scr++;
		Cookies.set('score', scr);
		
		
		$('#score').text(scr);
		$(location).attr('href',"#res");
	}
});
</script>
