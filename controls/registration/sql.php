<?php class registrationSql extends registration {
	
public static $request;

function __construct() {

}

public static function regNewUser($s="") {
	$s.="insert into oz_main_users ";
	$s.="(lastname,firstname,patronymic,email,phone,company,post,post_tm) values ";
	$s.="(";
	$s.="'".registration::$lastname."',";
	$s.="'".registration::$firstname."',";
	$s.="'".registration::$patronymic."',";
	$s.="'".registration::$email."',";
	$s.="'".registration::$phone."',";
	$s.="'".registration::$company."',";
	$s.="'".registration::$post."',";
	$s.="".project::$tm."";
	$s.=")";
	return $s;
}

} ?>
