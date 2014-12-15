<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title><?=$title?></title>
	<link rel="shortcut icon" href="<?=ROUTE_ROOT?>/images/favicon.png">
	<link rel="stylesheet" href="<?=ROUTE_ROOT?>/css/reset.css">
	<link rel="stylesheet" href="<?=ROUTE_ROOT?>/css/main.css">
	<script type="text/javascript" src="<?=ROUTE_ROOT?>/js/jquery.js"></script>
	<script type="text/javascript" src="<?=ROUTE_ROOT?>/js/common.js"></script>
	<script>
		$(document).ready(function(){
			$('#exit').on('click', function(){
				$.get("/library/public/logout");
			});
		});
	</script>
</head>
<body>

	<a href="<?=ROUTE_ROOT.'/logout'?>">Выход</a>
	<button id="exit">выйти</button>