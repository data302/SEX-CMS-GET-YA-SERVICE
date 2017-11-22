<?php
include_once('../system/config.php');
include_once('../system/head.php');

switch ($_GET['menu']) {
    default:
echo '<div class="title">Меню пользователя :</div>';
if ($user['id']) {
}else{
echo '<a href="/auth.php"class="mine"> Авторизация</a></div>';
}
if ($user['level'] == 1)echo'<a href="/admin/"class="mine"> Админ-панель</a></div>';
echo '<a href="/menu/index.php?menu=raznoe"class="mine"> Разное</a></div>';
if ($user['id']) {
echo '<a href="/menu/index.php?menu=pass"class="mine"> Сменить пароль</a></div>';
echo '<a href="/menu/index.php?menu=exit"class="mine"> Выход</a></div>';
}else{
}
break;

case 'raznoe':
echo '<div class="title">Разное:</div>';
echo '<a href="/menu/stat.php"class="mine"> Статистика сайта</a></div>';
echo '<a href="/menu/bb.php"class="mine"> BB коды</a></div>';
echo '<a href="/menu/agreement.php"class="mine"> Соглашение</a></div>';
echo '<a href="/menu/smiles.php"class="mine"> Смайлики</a></div>';
break;

case 'pass':
if ($_REQUEST['ok']) {
if ($_POST['pass']) {
$pass = check($_POST['pass']);
mysql_query("UPDATE `users` SET `pass` = '".md5(md5($pass))."' WHERE `id` = '$user[id]'");
header('location: /auth.php');
} else {
echo '<div class="title">Смена пароля</div>';
echo '<div class="link">Вы не заполнили поле...</div><a href="/menu/index.php?menu=pass"class="mine">Вернуться</a></div>';
include_once('../system/foot.php');
pages('/menu/index.php?menu=pass');
}
} else {
echo '<div class="title">Смена пароля</div><div class="link">
<form action="?menu=pass&amp;ok=1" method="post">
Новый пароль:<br /><input name="pass" type="password" maxlength="20" /><br />
<input name="submit" type="submit" value="Сменить" />
</form></div>';
}
break;

case 'exit':
if (!isset($users)) {
header('Location: /menu/index.php');
}

setcookie("userlogin", "", time() - 3600, '/');
setcookie("userpassword", "", time() - 3600, '/');
unset($users);
break;
}
include_once('../system/foot.php');
?>
