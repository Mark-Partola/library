<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title><?=$title?></title>
	<link rel="shortcut icon" href="<?=ROUTE_ROOT?>/images/favicon.png">
	<link rel="stylesheet" href="<?=ROUTE_ROOT?>/css/reset.css">
	<link rel="stylesheet" href="<?=ROUTE_ROOT?>/css/main.css">
	<script type="text/javascript" src="<?=ROUTE_ROOT?>/js/jquery.js"></script>
	<script type="text/javascript" src="<?=ROUTE_ROOT?>/js/easypaginate.js"></script>
	<script type="text/javascript" src="<?=ROUTE_ROOT?>/js/common.js"></script>
	<script type="text/javascript">
		/*jQuery(function($){
			$('.galery-main ul#items').easyPaginate({
				step:4
			});
			$('.galery ul#items').easyPaginate({
				step:5
			});
			/*Тест сервера на аякс*/
			/*var req = new XMLHttpRequest();
			req.onreadystatechange = function() {
				if(req.readyState == 4) {
					console.log(req.responseText);
				}
			}
			req.open('GET', "<?=ROUTE_ROOT?>/delete.php", true);
			req.send(null);
		});*/
	</script>

</head>
<body>
	<div class="banner">
		<div class="body-wrapper">
			<a href="#"><img src="<?=ROUTE_ROOT?>/images/1000_90.jpg" alt=""></a>
		</div>
	</div>
	<div id="header">
		<div class="body-wrapper">
			<div class="top-nav">
				<a href="#">
					<img class="logo" src="<?=ROUTE_ROOT?>/images/logo.png" alt="">
				</a>
				<ul class="nav-inline">
					<li><a href="#">каталог</a></li>
					<li><a href="#">афиша</a></li>
					<li><a href="#">журнал</a></li>
					<li><a href="#">ФотоОтчеты</a></li>
				</ul>
				<a href="#">
					<img class="ad" src="<?=ROUTE_ROOT?>/images/ad.png" alt="">
				</a>
			</div>
		</div>
	</div>
	<div class="search">
		<div class="body-wrapper">
			<div class=" form-wrapper">
				<form method="POST" action="">
					<input type="search" placeholder="Введите поисковый запрос" name="search">
					<button type="submit">Найти</button>
				</form>
			</div>
			<div class="info">
				<p class="phone">+7(999)-999-00-00</p>
				<p class="phone-info">Служба заказа банкетов</p>
			</div>
			<div class="info">
				<p class="phone">+7(999)-999-00-00</p>
				<p class="phone-info">Служба заказа</p>
			</div>
		</div>
	</div>