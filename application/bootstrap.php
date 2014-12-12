<?php

require_once __DIR__.'/config/config.php';
require_once __DIR__.'/config/autoload.php';

require_once __DIR__.'/Request.php';



//меняем путь в htaccess
if(!file_exists(ROUTE_ROOT.'/.htaccess')){
	$htaccess = file_get_contents(__DIR__.'/config/htaccess.txt');
	file_put_contents('.htaccess',str_replace('{{path}}', ROUTE_ROOT, $htaccess));
}
