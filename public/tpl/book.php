<?=$header?>

<div id="content">

	<h1 class="header"><?=$book['title']?></h1>
	<div id="detail_book">
		<div class="detail_image">
			<img src="<?=ROUTE_ROOT.$book['image']?>" alt="<?=$book['title']?>" width="250px">
			<button class="btn order_book" data-book-id="<?=$book['id']?>">Добавить</button>
		</div>
		<div class="detail_info">
			<div class="info"><h3>Автор: </h3><p><?=$book['author']?></p></div>
			<div class="info"><h3>Год публикации: </h3><p><?=$book['pub_year']?></p></div>
			<div class="info"><h3>Издательство: </h3><p><?=$book['publisher']?></p></div>
			<?if(isset($book['genre'])):?>
				<div class="info"><h3>Жанр: </h3><p><?=$book['genre']?></p></div>
			<?endif?>
			<div class="info"><h3>Страниц: </h3><p><?=$book['volume']?></p></div>
			<div class="info"><h3>ISBN: </h3><p><?=$book['isbn']?></p></div>
		</div>
		<div class="detail_info">
			<h1 class="header">Описание</h1>
			<p><?=$book['description']?></p>
		</div>
	</div>
	<div style="clear:both;"></div>

</div>

<?=$footer?>