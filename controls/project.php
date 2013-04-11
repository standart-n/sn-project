<?php class project extends sn {

public static $tm;
public static $error;
public static $line_ms;

function __construct() {
	session_start();
}

public static function engine() {

	require_once(project."/controls/signin/signin.php");
	sn::cl("signin");

	switch(url::$action) {
		case "registration":
			require_once(project."/controls/registration/registration.php");
			sn::cl("registration");
			return self::registration();
		break;
	}
	return false;
}

public static function registration($j=array()) {
	$j['registration']=registration::engine();
	$j['tm']=time();
	return $j;
}


public static function gentm() {
	if (query(sql::gentm())) {
		self::$tm=mysql_insert_id();
		if (self::$tm>0) {
			return true;
		}
	}
	return false;
}

} ?>
