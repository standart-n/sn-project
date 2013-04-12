<?php class url {
	
public static $action;
public static $callback;

function __construct() {

	self::$action="index";

	if (isset($_REQUEST["action"])) {
		self::$action=trim(strval($_REQUEST["action"]));
	}
	if (isset($_REQUEST["callback"])) {
		self::$callback=trim(strval($_REQUEST["callback"]));
	}
		
}


} ?>
