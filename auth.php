<?php
require_once 'system/config.php';
require_once 'system/head.php';

if ($user['id']) header('location: /menu');
echo '<div class="title">Авторизация</div>';
echo '<div class="link">
<form action="/login.php" method="post">
Логин:<br /><input type="text" name="login" maxlength="12"/><br />
Пароль:<br /> <input type="password" name="pass" maxlength="15"/><br />
<input type="submit" value="Войти"/></form></div>';
echo '<a href="/reg.php"class="mine"> Регистрация</a></div>';
include_once('system/foot.php');
?>
