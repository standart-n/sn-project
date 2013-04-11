<?php class sql extends sn {
	
function __construct() {
	
}

function gentm($s="") { $tm=time();
	$s.="insert into oz_tm ";
	$s.="(dt,d,t,year,tm) values ";
	$s.="(NOW(),NOW(),NOW(),NOW(),".$tm.")";
	return $s;
}

} ?>
