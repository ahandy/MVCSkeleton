<?php

/*
*---------------------------------------------------------
* Making sure there was no direct access to the script
*---------------------------------------------------------
*/ 
defined('SYSTEM_PATH') OR exit('No direct access to the script is allowed');


/*
*---------------------------------------------------------
* View class that would output the file
*---------------------------------------------------------
*/ 
class View {
	public function load($view = NULL, $header = NULL, $footer = NULL) {
		if($header  === NULL) $header = get_setting('load_header');
		if($footer  === NULL) $footer = get_setting('load_footer');
		
		if($header) {
			if(!file_exists(VIEWS_PATH . get_setting('header_path'))) {
				if(DEBUG_ALL) throw503("Please make sure the view header file has a correct path in the settings.php (Current: " . VIEWS_PATH . get_setting('header_path') . ")");
			}

			require_once VIEWS_PATH . get_setting('header_path');
		}

		if(strpos($view, '.php') === FALSE && strpos($view, '.htm') === FALSE && strpos($view, '.html') === FALSE) {
			$view = $view . '.php';
		}

		if(!file_exists(VIEWS_PATH . $view)) {
			if(DEBUG_ALL) throw503("View file was not found in " . VIEWS_PATH . $view);
			echo "View file {$view} could not be fount.";
		}

		else require_once VIEWS_PATH . $view;

		if($footer) {
			if(!file_exists(VIEWS_PATH . get_setting('footer_path'))) {
				if(DEBUG_ALL) throw503("Please make sure the view footer file has a correct path in the settings.php (Current: " . VIEWS_PATH . get_setting('footer_path') . ")");
			}

			require_once VIEWS_PATH . get_setting('footer_path');
		}
	}
}