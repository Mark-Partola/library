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
				<img width="300" src="<?=ROUTE_ROOT?>/images/users/avatars/default.gif" alt="">
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

	<h1 class="header">Выданные книги</h1>
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
				<p class="where_book">Находится у <? echo "{$book['fname']} {$book['patronymic']} {$book['lname']}";?></p>
			</div>
		<?endforeach?>
		<div style="clear:both;"></div>
	</div>

	<h1 class="header">Ожидающие выдачи</h1>
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
						<p class="where_book">Ожидает <? echo "{$book['fname']} {$book['lname']}";?></p>
					</div>
				</a>
				<label>Имеется <input type="checkbox" name="have"></label>
				<label>Лимит <input type="checkbox" name="limit"></label>
				<button class="btn libr_add_book_exp" data-book-id="<?=$book['exp_id']?>">Подтвердить</button>
			</div>
		<?endforeach?>
		<div style="clear:both;"></div>
	</div>

</div>

<?=$footer?>