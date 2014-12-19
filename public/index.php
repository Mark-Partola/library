<?php
//$start = microtime(true);

require_once __DIR__.'/../application/Application.php';

Application::init();

//главная
Request('GET', '/','Ctrl_index');

//авторизация
Request('GET', '/login','Ctrl_user:login');
Request('GET', '/logout','Ctrl_user:logout');
Request('POST', '/login','Ctrl_user:authorize');

//страница профиля
Request('GET', '/profile','Ctrl_librarian:profile')->isRole(1);
Request('GET', '/profile','Ctrl_user:profile');

//просмотр профилей для библиотекаря
Request('GET', '/profile/{id}','Ctrl_librarian:getProfile')
->assert('id', '|^[0-9]+$|')->isRole(1);

//детальный просмотр книги
Request('GET', '/book/{id}','Ctrl_index:getBook')
->assert('id', '|^[0-9]+$|');

//подтверждение добавления
Request('GET', '/accept/{id}','Ctrl_librarian:acceptBook')
->assert('id', '|^[0-9]+$|')->isRole(1);
//добавление книги
Request('GET', '/add/{id}','Ctrl_client:addBook')
->assert('id', '|^[0-9]+$|');

//удаление книги
Request('GET', '/del/{id}','Ctrl_client:delBook')
->assert('id', '|^[0-9]+$|');


Application::run();


//cho '<br>';
//echo '<br>';
//echo '<br>';
//echo 'Время генерации страницы: '. (microtime(true) - $start);

?>
