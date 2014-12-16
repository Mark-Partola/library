<?php
$start = microtime(true);

require_once __DIR__.'/../application/Application.php';

Application::init();


Request('GET', '/','Ctrl_index');

Request('GET', '/login','Ctrl_user:login');
Request('GET', '/logout','Ctrl_user:logout');

Request('POST', '/login','Ctrl_user:authorize');

Request('GET', '/profile','Ctrl_librarian:profile')->isRole(1);
Request('GET', '/profile','Ctrl_user:profile');

//Request('GET', '/login','Ctrl_user:login');
//Logger::all('тестовый лог', __FILE__, __LINE__);

Request('GET', '/book/{id}','Ctrl_index:getBook')
->assert('id', '|^[0-9]+$|');

Request('GET', '/test','Ctrl_index:getNew');

//Request('GET', '/shoppingNew/public/qwerty/{name}', 'Ctrl_test');

//Request('POST', '/shoppingNew/public', 'Ctrl_index:post');

/*Request('GET', '/shoppingNew/public/{name}/{id}/', 'Ctrl_index:hi')
->assert('name', '|^[a-z]+$|')
->assert('id', '|^[0-9]+$|');*/
//Logger::all('тестовый лог2', __FILE__, __LINE__);
Application::run();


echo '<br>';
echo '<br>';
echo '<br>';
echo 'Время генерации страницы: '. (microtime(true) - $start);

?>
