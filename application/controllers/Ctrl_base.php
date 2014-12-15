<?php

abstract class Ctrl_base {

	protected $template;

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

	protected function getTemplate($title=SITE_NAME, $params=null, $header='header', $footer='footer'){

		$header = $this->generateTemplate('header', array('title' => $title));
		$footer = $this->generateTemplate('footer');
		$this->template = $this->generateTemplate('index', array('header' => $header, 'footer' => $footer, key($params) => $params[key($params)]));

		return $this->template;
	}
}