<?php class signinUrl extends signin {
	
public static $action;
public static $callback;
public static $login;
public static $password;
public static $key;

function __construct() {
	if (isset($_REQUEST["action"])) {
		self::$action=trim(strval($_REQUEST["action"]));
	}
	if (isset($_REQUEST["callback"])) {
		self::$callback=trim(strval($_REQUEST["callback"]));
	}

	if (isset($_REQUEST["login"])) {
		self::$login=trim(strval($_REQUEST["login"]));
	}
	if (isset($_REQUEST["password"])) {
		self::$password=trim(strval($_REQUEST["password"]));
	}
	if (isset($_REQUEST["key"])) {
		self::$key=trim(strval($_REQUEST["key"]));
	}
		
}


} ?>
