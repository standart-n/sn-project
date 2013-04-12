<?php class registration extends sn {
	
public static $response;
public static $error;
public static $valid;
public static $exp;

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
	require_once(project."/controls/registration/url.php");
	$this->registrationUrl=new registrationUrl();
	require_once(project."/controls/registration/sql.php");
	$this->registrationSql=new registrationSql();

	self::$response=array();
	self::$valid=array();
	self::$error=false;
}

function engine() {
	if (self::validate()) {
		self::$response['reg']=true;
		if (project::gentm()) {
			if (query(registrationSql::regNewUser())) {
				self::$response['add']=true;
			}
		}
	} else {
		self::$response['valid']=self::$valid;
		self::$response['reg']=false;
	}
	return self::$response;
}

function validate() {
	console::write("---");
	console::write("post data:");
	self::checkRegion(registrationUrl::$region,"region");
	self::checkTheme(registrationUrl::$theme,"theme");
	self::checkLastname(registrationUrl::$lastname,"lastname");
	self::checkFirstname(registrationUrl::$firstname,"firstname");
	self::checkPatronymic(registrationUrl::$patronymic,"patronymic");
	self::checkEmail(registrationUrl::$email,"email");
	self::checkPhone(registrationUrl::$phone,"phone");
	self::checkCompany(registrationUrl::$company,"company");
	self::checkPost(registrationUrl::$post,"post");	
	if (sizeof(self::$valid)>0) { return false; } else { return true; }
}

function checkRegion($value=null,$type="region",$exp=null,$error=true,$def="") {
	console::write($type.": ".$value);
 	if (!value) { $exp="отсутствуют данные!"; } else {
		if (($value=="") || ($value==$def)) { $exp="ничего не указано!"; } else {
			$error=false;
			self::$region=$value;
		}
	}
	if (($error) && ($exp) && ($type)) {
		self::$valid[$type]["exp"]=$exp;
		self::$valid[$type]["def"]=$def;
		self::$valid[$type]["error"]=true;		
	}
}

function checkTheme($value=null,$type="theme",$exp=null,$error=true,$def="") {
	console::write($type.": ".$value);
 	if (!value) { $exp="отсутствуют данные!"; } else {
		if (($value=="") || ($value==$def)) { $exp="ничего не указано!"; } else {
			$error=false;
			self::$theme=$value;
		}
	}
	if (($error) && ($exp) && ($type)) {
		self::$valid[$type]["exp"]=$exp;
		self::$valid[$type]["def"]=$def;
		self::$valid[$type]["error"]=true;		
	}
}


function checkLastname($value=null,$type="lastname",$exp=null,$error=true,$def="Фамилия") {
	console::write($type.": ".$value);
 	if (!value) { $exp="отсутствуют данные!"; } else {
		if (($value=="") || ($value==$def)) { $exp="ничего не указано!"; } else {
			if (strlen($value)<3) { $exp="слишком короткое значение!"; } else {
				if (strlen($value)>28) { $exp="слишком длинное значение!"; } else {						
					if (!preg_match('/^([а-яёА-ЯЁ\-\.]+)$/iu',$value,$m)) { $exp="некорректное значение!"; } else {
						$error=false;
						self::$lastname=$value;
					}
				}
			}
		}
	}
	if (($error) && ($exp) && ($type)) {
		self::$valid[$type]["exp"]=$exp;
		self::$valid[$type]["def"]=$def;
		self::$valid[$type]["error"]=true;		
	}
}

function checkFirstname($value=null,$type="firstname",$exp=null,$error=true,$def="Имя") {
	console::write($type.": ".$value);
 	if (!value) { $exp="отсутствуют данные!"; } else {
		if (($value=="") || ($value==$def)) { $exp="ничего не указано!"; } else {
			if (strlen($value)<3) { $exp="слишком короткое значение!"; } else {
				if (strlen($value)>28) { $exp="слишком длинное значение!"; } else {						
					if (!preg_match('/^([а-яёА-ЯЁ\-\.]+)$/iu',$value,$m)) { $exp="некорректное значение!"; } else {
						$error=false;
						self::$firstname=$value;
					}
				}
			}
		}
	}
	if (($error) && ($exp) && ($type)) {
		self::$valid[$type]["exp"]=$exp;
		self::$valid[$type]["def"]=$def;
		self::$valid[$type]["error"]=true;		
	}
}

function checkPatronymic($value=null,$type="patronymic",$exp=null,$error=true,$def="Отчество") {
	console::write($type.": ".$value);
 	if (!value) { $exp="отсутствуют данные!"; } else {
		if (($value=="") || ($value==$def)) { $exp="ничего не указано!"; } else {
			if (strlen($value)<3) { $exp="слишком короткое значение!"; } else {
				if (strlen($value)>28) { $exp="слишком длинное значение!"; } else {						
					if (!preg_match('/^([а-яёА-ЯЁ\-\.]+)$/iu',$value,$m)) { $exp="некорректное значение!"; } else {
						$error=false;
						self::$patronymic=$value;
					}
				}
			}
		}
	}
	if (($error) && ($exp) && ($type)) {
		self::$valid[$type]["exp"]=$exp;
		self::$valid[$type]["def"]=$def;
		self::$valid[$type]["error"]=true;		
	}
}

function checkEmail($value=null,$type="email",$exp=null,$error=true,$def="E-mail адрес") {
	console::write($type.": ".$value);
 	if (!value) { $exp="отсутствуют данные!"; } else {
		if (($value=="") || ($value==$def)) { $exp="ничего не указано!"; } else {
			if (strlen($value)<3) { $exp="слишком короткое значение!"; } else {
				if (strlen($value)>28) { $exp="слишком длинное значение!"; } else {						
					if (!preg_match('/\b[\w\.-]+@[\w\.-]+\.\w{2,4}\b/i',$value,$m)) { $exp="некорректное значение!"; } else {
						$error=false;
						self::$email=$value;
					}
				}
			}
		}
	}
	if (($error) && ($exp) && ($type)) {
		self::$valid[$type]["exp"]=$exp;
		self::$valid[$type]["def"]=$def;
		self::$valid[$type]["error"]=true;		
	}
}

function checkPhone($value=null,$type="phone",$exp=null,$error=true,$def="Контактный телефон") {
	console::write($type.": ".$value);
 	if (!value) { $exp="отсутствуют данные!"; } else {
		if (($value=="") || ($value==$def)) { $exp="ничего не указано!"; } else {
			if (strlen($value)<3) { $exp="слишком короткое значение!"; } else {
				if (strlen($value)>28) { $exp="слишком длинное значение!"; } else {						
					if (!preg_match('/\+?\d{1,3}(?:\s*\(\d+\)\s*)?(?:(?:\-\d{1,3})+\d|[\d\-]{6,}|(?:\s\d{1,3})+\d)/i',$value,$m)) { $exp="некорректное значение!"; } else {
						$error=false;
						self::$phone=$value;
					}
				}
			}
		}
	}
	if (($error) && ($exp) && ($type)) {
		self::$valid[$type]["exp"]=$exp;
		self::$valid[$type]["def"]=$def;
		self::$valid[$type]["error"]=true;		
	}
}

function checkCompany($value=null,$type="company",$exp=null,$error=true,$def="Организация") {
	console::write($type.": ".$value);
 	if (!value) { $exp="отсутствуют данные!"; } else {
		if (($value=="") || ($value==$def)) { $exp="ничего не указано!"; } else {
			if (strlen($value)<3) { $exp="слишком короткое значение!"; } else {
				if (strlen($value)>28) { $exp="слишком длинное значение!"; } else {						
					if (!preg_match('/^([а-яёА-ЯЁa-zA-Z0-9\-\.\,\"\'\<\>\ ]+)$/iu',$value,$m)) { $exp="некорректное значение!"; } else {
						$error=false;
						self::$company=$value;
					}
				}
			}
		}
	}
	if (($error) && ($exp) && ($type)) {
		self::$valid[$type]["exp"]=$exp;
		self::$valid[$type]["def"]=$def;
		self::$valid[$type]["error"]=true;		
	}
}

function checkPost($value=null,$type="post",$exp=null,$error=true,$def="Должность") {
	console::write($type.": ".$value);
 	if (!value) { $exp="отсутствуют данные!"; } else {
		if (($value=="") || ($value==$def)) { $exp="ничего не указано!"; } else {
			if (strlen($value)<3) { $exp="слишком короткое значение!"; } else {
				if (strlen($value)>28) { $exp="слишком длинное значение!"; } else {						
					if (!preg_match('/^([а-яёА-ЯЁa-zA-Z0-9\-\.\,\"\'\ ]+)$/iu',$value,$m)) { $exp="некорректное значение!"; } else {
						$error=false;
						self::$post=$value;
					}
				}
			}
		}
	}
	if (($error) && ($exp) && ($type)) {
		self::$valid[$type]["exp"]=$exp;
		self::$valid[$type]["def"]=$def;
		self::$valid[$type]["error"]=true;		
	}
}

 

} ?>
