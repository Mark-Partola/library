<?=$header?>

<a href="<?=ROUTE_ROOT.'/user'?>">Страница пользователя</a>

<p>ToDo: проверка на авторизацию</p>
<br>
<br>

<div>
	<form action="" method="POST">
		<label>Логин <input type="text" name="login" placeholder="Логин" required></label><br>
		<label>Пароль <input type="password" name="password" placeholder="Пароль" required></label><br>
		<label>Запомнить? <input type="checkbox" name="remember" value="1"></label><br><br>
		<input type="submit" value="Авторизоваться" name="submit">
	</form>
</div>

<?=$footer?>