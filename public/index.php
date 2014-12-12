<?php

require_once  __DIR__.'/../application/Application.php';
require_once  __DIR__.'/../application/Request.php';

define('APP_ROOT', '/library/public');

function __autoload($classname) {
	//Ctrl или Base
	if($classname[0] == 'C' || $classname[0] == 'B'){
		require_once '../application/controllers/' . $classname .'.php';
	} else
		require_once '../application/models/' . $classname .'.php';
}

Application::init();

Request('GET', APP_ROOT            ,'Ctrl_index');
Request('GET', APP_ROOT.'/q'       ,'Ctrl_index');
Request('GET', APP_ROOT.'/errors'  ,'Ctrl_index:err');
Request('GET', APP_ROOT.'/test'    ,'Ctrl_index:getNew');

//Request('GET', '/shoppingNew/public/qwerty/{name}', 'Ctrl_test');

//Request('POST', '/shoppingNew/public', 'Ctrl_index:post');

/*Request('GET', '/shoppingNew/public/{name}/{id}/', 'Ctrl_index:hi')
->assert('name', '|^[a-z]+$|')
->assert('id', '|^[0-9]+$|');*/

Application::run();


?>
