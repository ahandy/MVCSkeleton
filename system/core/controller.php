<?php
class Controller {
	public static $controller;

	public function __construct() {
		self::$controller =& $this;

		foreach(returnLoadedClasses() as $class => $directory) {
			$this -> $class = load_class($class, $directory);
		}
	}

	public static function returnController() {
		return self::$controller;
	}
}