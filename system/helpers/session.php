<?php
class Session {
	public function __construct() {

		register_shutdown_function('session_write_close');
		
		ini_set('session.hash_function', 'sha512');
		ini_set('session.hash_bits_per_character', 6);
		ini_set('session.use_only_cookies', 1);

		$cookieParams = session_get_cookie_params(); 
		session_set_cookie_params(get_setting('session_maxlifetime'), $cookieParams["path"], $cookieParams["domain"], get_setting('session_https'), FALSE); 
		session_name(get_setting('session_name'));
		
		session_start();

		if($this -> checkIfObsolete()) {
			$this -> clearSession();
			session_start();
		}

		else {
			if(rand(1, 100) < 6) {
				$this -> regenerateSession();
			}
		}

		$this -> security = load_class('security', 'helpers');
		$this -> encryption = load_class('encryption', 'helpers');
	}

	public function addChecks() {
		$this -> set('ip', $_SERVER['REMOTE_ADDR'], FALSE);
		$this -> set('useragent', $_SERVER['HTTP_USER_AGENT'], FALSE);
	}

	public function processChecks() {
		if($this -> get('ip', FALSE) != $_SERVER['REMOTE_ADDR'] || $this -> get('useragent', FALSE) != $_SERVER['HTTP_USER_AGENT']) {
			if(DEBUG_ALL) throw503("Session hijacking alert.");
			$this -> clearSession();
			$this -> addChecks();
			$this -> regenerateSession();
		}
	}

	public function regenerateSession() {
		if(isset($_SESSION['obsolete']) && $_SESSION['obsolete']) return;

		$_SESSION['obsolete'] = true;
		$_SESSION['expiry'] = time() + 15;

		session_regenerate_id(false);

		$new_id = session_id();
		session_write_close();

		session_id($new_id);
		session_start();

		// Now we unset the obsolete and expiration values for the session we want to keep
		unset($_SESSION['obsolete']);
		unset($_SESSION['expiry']);
	}

	public function checkIfObsolete() {
		if(isset($_SESSION['obsolete']) && (!isset($_SESSION['expiry']) || $_SESSION['expiry'] < time())) return true;
		else return false;
	}

	public function set($name, $value, $check = TRUE) {

		// add hijacking checks
		if($check) $this -> addChecks();

		// Cleaning the values
		$name = $this -> security -> cleanInput($name);
		$value = $this -> security -> cleanInput($value);
		
		// Encrypting them
		$name = $this -> encryption -> encode($name);
		$value = $this -> encryption -> encode($value);

		$_SESSION[$name] = $value;
		return true;
	}

	public function get($name, $check = TRUE) {
		// preventing hijacking
		if($check) $this -> processChecks();

		// encoding name
		$name = $this -> encryption -> encode($name);

		if(!isset($_SESSION[$name])) return NULL;

		return $this -> encryption -> decode($_SESSION[$name]);
	}

	public function clearSession() {
		$_SESSION = array();
		session_destroy();
		return true;
	}
}