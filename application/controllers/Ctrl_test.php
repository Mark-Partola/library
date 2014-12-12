<?php

class Ctrl_test extends Ctrl_base{
	public function index($name){
		$args = func_get_args()[0];
		echo 'hello ' . $args['name'];
	}
}