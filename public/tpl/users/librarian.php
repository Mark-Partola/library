<?=$header?>

<a href="<?=ROUTE_ROOT?>">Каталог</a>

<div>
	<h1 style="font-size: 2em; margin: 20px 10px;">Книги выданные вами:</h1>
	<?foreach($myActions as $action): ?>
		<div>
			<h2><a href="<?=ROUTE_ROOT?>/book/<?=$action['id']?>"><?=$action['title']?></a></h2>
				<br>
				<p>Находится у <? echo "{$action['fname']} {$action['patronymic']} {$action['lname']}";?></p>
				<?if(!empty($action['exp'])): ?>
					<h3>Дата окончания: <? $date = date_parse($action['exp']); echo "{$date['year']}-{$date['month']}-{$date['day']} ";?></h3>
				<?else:?>
					<h3>Безлимит</h3>
				<?endif?>
				<br>
				<div>
					<img src="<?=ROUTE_ROOT.$action['image_preview']?>" alt="<?=$action['title']?>">
					<p><?=$action['author']?></p>
					<p><?=$action['pub_year']?></p>
				</div>
		</div>
	<?endforeach?>
</div>

<?=$footer?>