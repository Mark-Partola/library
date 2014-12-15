<?=$header?>

<div>

	<h1><?=$book['title']?></h1>
	<div>
		<img src="<?=ROUTE_ROOT.$book['image_preview']?>" alt="<?=$book['title']?>">
		<p><?=$book['author']?></p>
		<p><?=$book['pub_year']?></p>
	</div>
	<a href="#"><?=$book['genre']?></a>

	<a href="<?=ROUTE_ROOT?>">Вернуться в каталог</a>

</div>

<?=$footer?>