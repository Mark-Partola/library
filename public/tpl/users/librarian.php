<?=$header?>

<div id="content">
	<div id="status_page">
			<? echo "{$user['fname']} {$user['patronymic']} {$user['lname']}";?>
	</div>

	<div id="user_info">
		<div class="profile_info">
			<?if(!empty($user['photo'])): ?>
				<img width="300" src="<?=ROUTE_ROOT?>/images/users/avatars/<?=$user['photo']?>" alt="">
			<?else:?>
				<img width="300" src="<?=ROUTE_ROOT?>/images/users/avatars/default.gif" alt="">
			<?endif?>
		</div>
		<div class="profile_info">
			<div id="user_name"><? echo "{$user['fname']} {$user['patronymic']} {$user['lname']}";?></div>
			<div style="margin-left: 20px;">
				Телефон: <span><?=$user['phone']?></span><br><br>
				Почта: <span><?=$user['email']?></span>
			</div>
		</div>
		<div class="profile_info">
			<div class="actions_libr">
				<h3 class="header_small"><a class="tabs" href="addUser">Создать нового пользователя</a></h3><br>
				<h3 class="header_small"><a class="tabs" href="addBook">Добавить новую книгу</a></h3><br>
				<h3 class="header_small"><a class="tabs" href="banUser">Заблокировать пользователя</a></h3>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>

	<div id="addUser">
		<h3 class="header"><a class="tabs" href="addUser">Создание нового пользователя</a></h3>
		<div class="form">
			<label><span>Имя * :</span> <input type="text" name="fname" placeholder="Имя" data-require="1"><span style="color:#B7303E; display:none; margin-left: 20px;">Обязательно!</span></label>
			<label><span>Фамилия * :</span> <input type="text" name="lname" placeholder="Фамилия" data-require="1"><span style="color:#B7303E; display:none; margin-left: 20px;">Обязательно!</span></label>
			<label><span>Отчество :</span> <input type="text" name="patr" placeholder="Отчество"></label>
			<label><span>Паспорт * :</span> <input type="text" name="passport" placeholder="Номер паспорта" data-require="1"><span style="color:#B7303E; display:none; margin-left: 20px;">Обязательно!</span></label>
			<label><span>E-mail * :</span> <input type="text" name="email" placeholder="Адрес электронной почты" data-require="1"><span style="color:#B7303E; display:none; margin-left: 20px;">Обязательно!</span></label>
			<label><span>Лимит :</span> <input type="text" name="limit" placeholder="Лимит книг"></label>
			<div class="buttons_book"><button class="btn create_user">Создать</button></div>
		</div>
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
	<div class="mp_books mp_books_big">
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
				<div class="buttons_book">
					<div><button class="btn libr_add_book_exp" data-book-id="<?=$book['exp_id']?>">Подтвердить</button></div>
					<div><button class="btn del_from_exp" data-book-id="<?=$book['id']?>">Отклонить</button></div>
				</div>
			</div>
		<?endforeach?>
		<div style="clear:both;"></div>
	</div>

</div>

<?=$footer?>