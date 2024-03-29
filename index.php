<?php

/*
* --------------------------------------------------------
* MVC Design Pattern Skeleton Code by Andy Abi Haidar
* --------------------------------------------------------
----------------------------------------------------------
The goal behind this skeleton code is to give you guys 
some freedom as to what to load, when to load it, and why
to load it. I tried to make this as global and as useful
as I can, and I would really appreciate any notes or
comments that you might have so that I can make this as
better as it can be.

Notice: The structure was heavily influenced by the
structure followed by Code Igniter.
----------------------------------------------------------
*/


/*
*---------------------------------------------------------
* Development mode toggle
*---------------------------------------------------------
*
* Set this to 1 if you want PHP to
* parse out all the errors that occur
* including notices and warnings plus
* all the runtime errors or notices that occur
* as well as all the sql queries
* 
* Set this to 2 to only receive PHP errors
*
* Set this to 3 only if the website
* is preferrably online and thus you don't
* want people to view the paths and errors
*/

define('MODE', 1);

switch(MODE) {
	case 1:
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
		define('DEBUG_ALL', TRUE);
	break;
	case 2:
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
		define('DEBUG_ALL', FALSE);
	case 3:
		error_reporting(0);
		define('DEBUG_ALL', FALSE);
	break;
}

// Setting the default timezone to Beirut
date_default_timezone_set('Asia/Beirut');


// Path to the system file that contains 
// all the necessary mvc files
$system = 'system';

// Path to the application folder that
// contains all the necessary web files
$web = 'web';

// Config folder name that contains
// all the necessary libraries to start
$config = 'config';

// Core folder that contains all
// the core functions and whatnot
$core = 'core';

// Controller folder for the web
// controllers
$controllers = 'pilots';

// Views folder for the web views
$views = 'views';

// Models folder for the web models
$models = 'models';

// Looping through the directories to check
// if they are indeed directories and if they
// exist
foreach(array($system, $web, $system . '/' . $config, $system . '/' . $core, $web . '/' . $controllers, $web . '/' . $views, $web . '/' . $models) as $path) {
	if(!is_dir($path)) {
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
        echo "The {$path} folder could not be found. Please create/rename to the folder correctly, or update its value in " . pathinfo(__FILE__, PATHINFO_BASENAME);
 		exit();        
	}
}

/*
*---------------------------------------------------------
* Now that everything is loading fine, we can start
* defining all the correct paths for later use
*---------------------------------------------------------
*/ 

// Using "/" as a default directory separator
define('DS', '/');

// Checking if https or not
$http = (isset($_SERVER['HTTPS'])) ? 'https' : 'http';

// Defining the root path
//
// Also replacing the Windows directory seperator
// with the default one as to avoid confusion
define('ABSOLUTE_ROOT_PATH', str_replace('\\', DS, dirname(__FILE__)) . DS);

// Getting the current URL
define('HTTP_PATH', "{$http}://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}");

// Get website URL
define('HTTP', "{$http}://{$_SERVER['HTTP_HOST']}/" . basename(__DIR__) . DS);

// Defining the system path
define('SYSTEM_PATH', ABSOLUTE_ROOT_PATH . $system . DS);

// Defining the web path
define('WEB_PATH', ABSOLUTE_ROOT_PATH . $web . DS);

// Defining the config path
define('CONFIG_PATH', ABSOLUTE_ROOT_PATH . $system . DS . $config . DS);

// Defining the core path
define('CORE_PATH', ABSOLUTE_ROOT_PATH . $system . DS . $core . DS);

// Defining the core folder name
define('CORE_FOLDER', $core);

// Defining the controllers folder name
define('CONTROLLERS_PATH', $web . DS . $controllers . DS);

// Defining the views folder name
define('VIEWS_PATH', $web . DS . $views . DS);

// Defining the models folder name
define('MODELS_PATH', $web . DS . $models . DS);

/*
*---------------------------------------------------------
* Everything is set up properly, time to load the jetpack
*---------------------------------------------------------
*/ 
if(!file_exists(SYSTEM_PATH . 'jetpack.php')) {
	header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo "The jetpack.php file was not found in " . SYSTEM_PATH . "";
	exit();  		
}

else {
	require_once SYSTEM_PATH . 'jetpack.php';
}