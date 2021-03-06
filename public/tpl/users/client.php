<?=$header?>

<div id="content">

	<div id="status_page">
		<? echo "{$user['fname']} {$user['patronymic']} {$user['lname']}";?>
	</div>

	<div id="user_info">
		<div id="profile_info">
			<?if(!empty($user['photo'])): ?>
				<img width="300" src="<?=ROUTE_ROOT?>/images/users/avatars/<?=$user['photo']?>" alt="">
			<?else:?>
				<img src="<?=ROUTE_ROOT?>/images/users/avatars/default.gif" alt="">
			<?endif?>
		</div>
		<div>
			<div id="user_name"><? echo "{$user['fname']} {$user['patronymic']} {$user['lname']}";?></div>
			<div style="margin-left: 20px;">
				Телефон: <span><?=$user['phone']?></span><br><br>
				Почта: <span><?=$user['email']?></span>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>

	<h1 class="header">Книги на руках</h1>
	<div class="mp_books">
		<?foreach($books as $book): ?>
			<div class="book">
				<a href="<?=ROUTE_ROOT?>/book/<?=$book['id']?>" class="link_book">
					<h1 class="book_title"><?=$book['title']?></h1>
					<div class="book_info">
						<img src="<?=ROUTE_ROOT.$book['image_preview']?>" alt="<?=$book['title']?>" width="120px">
						<div>
							<p><?=$book['author']?></p>
							<p><?=$book['pub_year']?></p>
						</div>
					</div>
				</a>
				<div class="limit_date">
					<?if(!empty($book['exp'])): ?>
						<h3>Дата окончания: <? $date = date_parse($book['exp']); echo "{$date['year']}-{$date['month']}-{$date['day']} ";?></h3>
					<?else:?>
						<h3>Безлимит</h3>
					<?endif?>
				</div>
			</div>
		<?endforeach?>
		<div style="clear:both;"></div>
	</div>

	<?if(!empty($expBooks)):?>
		<h1 class="header header_exp">Ожидают оформления</h1>
	<?endif?>
	<div class="mp_books">
		<?foreach($expBooks as $book): ?>
			<div class="book">
				<a href="<?=ROUTE_ROOT?>/book/<?=$book['id']?>" class="link_book">
					<h1 class="book_title"><?=$book['title']?></h1>
					<div class="book_info">
						<img src="<?=ROUTE_ROOT.$book['image_preview']?>" alt="<?=$book['title']?>" width="120px">
						<div>
							<p><?=$book['author']?></p>
							<p><?=$book['pub_year']?></p>
						</div>
					</div>
				</a>
				<button class="btn del_from_exp" data-book-id="<?=$book['id']?>">Убрать из ожидаемых</button>
			</div>
		<?endforeach?>
		<div style="clear:both;"></div>
	</div>
</div>
<?=$footer?>