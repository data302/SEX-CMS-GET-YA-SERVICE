<?php
require_once 'system/config.php';
require_once 'system/head.php';

if ($user['id']) header('location: ./');

switch ($_GET['act']) {
    default:

$ref = mt_rand(10000, 1000000);
$_SESSION['captcha'] = mt_rand(100, 999);
		echo '<div class="title">Регистрация</div><div class="link">
		<form action="?act=do" method="post">
		Логин [12]:<br /><input name="login" type="text" maxlength="12" /><br />
		Пароль [16]:<br /><input name="pass" type="password" maxlength="20" /><br />
		E-Mail [25]:<br /><input name="email" type="text" maxlength="30" /><br />
		<input type="submit" value="Регистрация"/>
		</form>
		</div>';
		include_once('system/foot.php');
	break;

	case 'do':
		$login = check($_POST['login']);
		$pass = check($_POST['pass']);
		$email = check($_POST['email']);

	# проверяем, введен ли логин
			if (empty($_POST['login'])) {
			echo '<div class="title">Регистрация</div><div class="error">Вы не ввели логин...<br />';
			echo '<a href="?">Назад</a></div>';
			include_once('system/foot.php');
            break;
			}


		# проверяем, не сущестует ли пользователя с таким именем
		$query = mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `login` = '$login'");
		if (mysql_result($query, 0) > 0) {
			echo '<div class="title">Регистрация</div><div class="error">Выбраный вами логин, уже используется...<br />';
			echo '<a href="?">Назад</a></div>';
			include_once('system/foot.php');
            break;
		}
		# проверка логина
		if (!preg_match('|^[a-z0-9\-]+$|i', $login)) {
			echo '<div class="title">Регистрация</div><div class="error">Логин должен содержать, только буквы Латинского алфавита и цифры...<br />';
			echo '<a href="?">Назад</a></div>';
			include_once('system/foot.php');
            break;
		}
		# проверяем длину логина
		if (strlen($login) < 3 or strlen($login) > 12) {
			echo '<div class="title">Регистрация</div><div class="error">Логин должен содержать минимум 3 или максимум 12 символов...<br />';
			echo '<a href="?">Назад</a></div>';
			include_once('system/foot.php');
            break;
		}
			# проверяем, введен ли пароль
			if (empty($_POST['pass'])) {
			echo '<div class="title">Регистрация</div><div class="error">Вы не ввели пароль...<br />';
			echo '<a href="?">Назад</a></div>';
			include_once('system/foot.php');
            break;
			}
		# проверяем длину пароля
		if (strlen($pass) < 3 or strlen($pass) > 16) {
			echo '<div class="title">Регистрация</div><div class="error">Пароль должен содержать минимум 3 или максимум 16 символов...<br />';
			echo '<a href="?">Назад</a></div>';
			include_once('system/foot.php');
            break;
		}
			# проверяем, введен ли E-Mail
			if (empty($_POST['email'])) {
			echo '<div class="title">Регистрация</div><div class="error">Вы не ввели E-Mail...<br />';
			echo '<a href="?">Назад</a></div>';
			include_once('system/foot.php');
            break;
			}
		# проверяем e-mail;
		if (!preg_match('/[0-9a-z_\-]+@[0-9a-z_\-^\.]+\.[a-z]{2,6}/i', $email)) {
           	echo '<div class="title">Регистрация</div><div class="error">E-Mail введён не верно...<br />';
			echo '<a href="?">Назад</a></div>';
			include_once('system/foot.php');
            break;
        }
		mysql_query("INSERT INTO `users` SET `login` = '$login', `pass` = '".md5(md5($pass))."', `email` = '$email', `regtime` = '".time()."'");

		echo '<div class="title">Регистрация</div><div class="link">
		Ваш Логин: <b>'.$login.'</b><br />
		Ваш Пароль: <b>'.$pass.'</b><br />
		Ваш E-Mail: <b>'.$email.'</b></div>
		<a href="login.php?lg='.$login.'&amp;ps='.$pass.'"class="mine">Войти</a></div>';
        include_once('system/foot.php');

	break;

}

?>
