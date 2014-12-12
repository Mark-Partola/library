<?php

abstract class BaseController {

	/*
	* Метод генерации шаблона, 
	* подключается шаблон и передаются переменные,
	* генерируемые циклом. Ключи ассоциативного массива
	* становятся именем переменной.
	* Пример использования:
	*	$this->generateTemplate('index', 
	*			array('title' => 'заголовок', 'content' => $content));
	*/
	protected function generateTemplate($tplname, $vars = array()) {

		foreach ($vars as $key => $value) {
			$$key = $value;
		}

		ob_start();
			include 'tpl/'.$tplname.'.php';
		return ob_get_clean();

	}
}