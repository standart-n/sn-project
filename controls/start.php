<?php class start extends sn {
	
public static $response;

function __construct() {
	self::$response=array();
	if (self::getControls()) {
		if (self::getAction()) {
			echo self::getResponseString(json_encode(self::$response));
		}
	}	
}

function getAction() {
	if (isset(url::$action)) {
		console::write("action: ".url::$action);
		self::$response=project::engine();
		return true;
	}
	return false;
}

function getControls() {
	require_once(project."/controls/project.php");
	require_once(project."/controls/url.php");
	require_once(project."/controls/sql.php");
	require_once(project."/controls/dev/console.php");
	sn::cl("project");
	sn::cl("url");
	sn::cl("sql");
	sn::cl("console");	

	return true;	
}


function getResponseString($s="") {
	if ($s) {
		console::write("---");
		console::write("response:");
		console::write($s);
		if (isset(url::$callback)) {
			return url::$callback."(".$s.");";
		} else {
			return $s;
		}
	}
	return false;
}


} ?>
