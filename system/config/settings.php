<?php

/*
*---------------------------------------------------------
* Making sure there was no direct access to the script
*---------------------------------------------------------
*/ 
defined('SYSTEM_PATH') OR exit('No direct access to the script is allowed');


/*
*---------------------------------------------------------
* Settings file:
* You may edit the values, however please
* pay close attention to what you are editing
*---------------------------------------------------------
*/ 

// Setting the config array
$_setting = array();

// The default homepage in case nothing was passed through the URL
$_setting['index_page'] = 'index';

// The hashing salt to be used in case needed
$_setting['hash_salt'] = 'qwe123asd456';

// Chars to allow inside the URL
// Do not edit this, preferrably
$_setting['allowed_url_chars'] = 'a-z 0-9~%.:_\-';

// Automatically load the header and footer files
$_setting['load_header'] = TRUE;
$_setting['load_footer'] = TRUE;
$_setting['header_path'] = 'common/header.php';
$_setting['footer_path'] = 'common/footer.php';

// Database information start
$_setting['database_type'] = 'mysql';
$_setting['database_host'] = 'localhost';
$_setting['database_name'] = 'mvc';
$_setting['database_user'] = 'root';
$_setting['database_pass'] = '';
// Database information end


// Session information start
// The name to be used for the session and for the cookie
$_setting['session_name'] = 'MVCSESSION';
// Session max lifetime
$_setting['session_maxlifetime'] = 1440;
// HTTPS only?
$_setting['session_https'] = false;
// Session information end