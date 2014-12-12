<?php

class Ctrl_test extends BaseController{
	public function index($name){
		$args = func_get_args()[0];
		echo 'hello ' . $args['name'];
	}
}