<?php

require_once 'system/config.php';

if (empty($_GET['lg']) and empty($_GET['ps'])) {
	$login = check($_POST['login']);
	$pass = md5(md5(check($_POST['pass'])));
} else {
	$login = check($_GET['lg']);
	$pass = md5(md5(check($_GET['ps'])));
}

$query = mysql_query("SELECT `login` FROM `users` WHERE `login` = '$login' and `pass` = '$pass' LIMIT 1");
if (mysql_num_rows($query)) {			
	# Ставим куки (86400 = day)
	setcookie('userlogin', $login, time()+86400*365, '/');
	setcookie('userpass', $pass, time()+86400*365, '/');
			
	# Переадресовываем браузер на главную страницу
	header('location: /menu/index.php');
} else {
	# Переадресовываем браузер на страницу авторизации, если не верно
	header('location: /auth.php');
}

?>