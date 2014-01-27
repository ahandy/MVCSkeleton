<?php
class Index extends Controller {
	public function __construct() {
		parent::__construct();
		$this -> ini = getController();
		$this -> model = loadModel('index');
		$this -> ini -> view -> load('test');

		$this -> session = load_class('session');
	}
}