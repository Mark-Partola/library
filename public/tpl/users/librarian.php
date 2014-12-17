<?=$header?>

<a href="<?=ROUTE_ROOT?>">Каталог</a>
<br><br>
<div style="margin: 20px;">
		<div style="float: left; margin-right: 20px; width: 300px;">
			<?if(!empty($user['photo'])): ?>
				<img style="width: 300px;" src="<?=ROUTE_ROOT?>/images/users/avatars/<?=$user['photo']?>" alt="">
			<?else:?>
				<img src="<?=ROUTE_ROOT?>/images/users/avatars/default.gif" alt="">
			<?endif?>
		</div>
		<div style="float:left;">
			<?//print_arr($user);?>
			<h1 style="font-size: 2em; margin: 20px 10px; color: #3379f5"><? echo "{$user['fname']} {$user['patronymic']} {$user['lname']}";?></h1>
			<div style="margin-left: 20px;">
				Телефон: <span><?=$user['phone']?></span><br><br>
				Почта: <span><?=$user['email']?></span>
			</div>
		</div>
		<div style="clear:both;"></div>
</div>

<div>
	<h1 style="font-size: 2em; margin: 20px 10px;">Книги выданные вами:</h1>
	<?foreach($myActions as $action): ?>
		<div style="float:left; margin: 10px; width: 400px;">
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
	<div style="clear:both;"></div>
</div>

<?=$footer?>