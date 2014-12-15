<?=$header?>

<a href="<?=ROUTE_ROOT.'/user'?>">Страница пользователя</a>

<?print_arr($_SESSION);?>

<div>
	<?foreach($books as $book): ?>
		<div>
			<h1><a href="<?=ROUTE_ROOT?>/book/<?=$book['id']?>"><?=$book['title']?></a></h1>
				<div>
					<img src="<?=ROUTE_ROOT.$book['image_preview']?>" alt="<?=$book['title']?>">
					<p><?=$book['author']?></p>
					<p><?=$book['pub_year']?></p>
				</div>
			<a href="#"><?=$book['genre']?></a>
		</div>
	<?endforeach?>
</div>

<?=$footer?>