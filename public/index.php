<?php
$start = microtime(true);

require_once __DIR__.'/../application/Application.php';

Application::init();


Request('GET', '/','Ctrl_index');
Logger::all('тестовый лог', __FILE__, __LINE__);
Request('GET', '/q','Ctrl_index');
Request('GET', '/errors','Ctrl_index:err');
Request('GET', '/test','Ctrl_index:getNew');

//Request('GET', '/shoppingNew/public/qwerty/{name}', 'Ctrl_test');

//Request('POST', '/shoppingNew/public', 'Ctrl_index:post');

/*Request('GET', '/shoppingNew/public/{name}/{id}/', 'Ctrl_index:hi')
->assert('name', '|^[a-z]+$|')
->assert('id', '|^[0-9]+$|');*/
Logger::all('тестовый лог2', __FILE__, __LINE__);
Application::run();


echo '<br>';
echo '<br>';
echo '<br>';
echo 'Время работы: '. (microtime(true) - $start);

?>
