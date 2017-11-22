<?php
// настройки
$set['site'] = $_SERVER['HTTP_HOST'];
$set['onpage'] = 10;

if (isset($_COOKIE['userlogin']) and isset($_COOKIE['userpass'])) {
	$userlogin = check($_COOKIE['userlogin']);
	$userpass = check($_COOKIE['userpass']);
		
	$query = mysql_query("SELECT * FROM `users` WHERE `login` = '$userlogin' and `pass` = '$userpass' LIMIT 1");
	$user = mysql_fetch_assoc($query);
	
	if (isset($user['id'])) {
		$config['onpage'] = $user['onpage'];

		if ($user['login'] != $userlogin or $user['pass'] != $userpass) {
			setcookie('userlogin', '', time() - 86400*31);
			setcookie('userpass', '', time() - 86400*31);
		}
	}
}

function check($check){
	$check = htmlspecialchars(mysql_real_escape_string($check));
	
	$search = array('|', '\'', '$', '\\', '^', '%', '`', "\0", "\x00", "\x1A", "‮⁄⁪⁫⁬∩");
	$replace = array('&#124;', '&#39;', '&#36;', '&#92;', '&#94;', '&#37;', '&#96;', '', '', '', '');
	$msg = str_replace($search, $replace, $msg);
	
	$msg = stripslashes(trim($msg));
	return $check;
}

function generate($number){
	$arr = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','r','s','t','u','v','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','R','S','T','U','V','X','Y','Z','1','2','3','4','5','6','7','8','9','0');  
    // Генерируем пароль  
    $pass = '';  
    for($i = 0; $i < $number; $i++){
		// Вычисляем случайный индекс массива
		$index = rand(0, count($arr) - 1);
		$pass .= $arr[$index];  
    }
	return $pass;  
}

?>