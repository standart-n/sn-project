<?php class registrationUrl extends registration {

public static $region;
public static $theme;
	
public static $lastname;
public static $firstname;
public static $patronymic;
public static $email;
public static $phone;
public static $company;
public static $post;

function __construct() {
	if (isset($_REQUEST["lastname"])) {
		self::$lastname=trim(strval($_REQUEST["lastname"]));
	}
	if (isset($_REQUEST["firstname"])) {
		self::$firstname=trim(strval($_REQUEST["firstname"]));
	}
	if (isset($_REQUEST["patronymic"])) {
		self::$patronymic=trim(strval($_REQUEST["patronymic"]));
	}
	if (isset($_REQUEST["email"])) {
		self::$email=trim(strval($_REQUEST["email"]));
	}
	if (isset($_REQUEST["phone"])) {
		self::$phone=trim(strval($_REQUEST["phone"]));
	}
	if (isset($_REQUEST["company"])) {
		self::$company=trim(strval($_REQUEST["company"]));
	}
	if (isset($_REQUEST["post"])) {
		self::$post=trim(strval($_REQUEST["post"]));
	}

	if (isset($_REQUEST["region"])) {
		self::$region=trim(strval($_REQUEST["region"]));
	}

	if (isset($_REQUEST["theme"])) {
		self::$theme=trim(strval($_REQUEST["theme"]));
	}

	
}


} ?>
