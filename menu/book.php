<?php

include_once('../system/config.php');
session_start();
include_once('../system/head.php');

switch ($_GET['book']) {
	default:

if (isset($_POST['add'])) {
$name = txt($_POST['name']);
$text = txt($_POST['text']);
if (empty($name)) $err .= 'Не введено имя<br />';
if (!empty($name) && (strlen($name) < 3 || strlen($name) > 32)) $err .= 'Неверная длина имени. Допустимо от 3 до 32 символов<br />';
if (empty($text)) $err .= 'Не введён текст<br />';
if (!empty($text) && (strlen($text) < 3 || strlen($text) > 600)) $err .= 'Неверная длина сообщения. Допустимо от 3 до 600 символов<br />';
if (!isset($err)) {
mysql_query("INSERT INTO `book` SET `name` = '".$name."', `text` = '". $text."', `date` = '". time() ."' ");
header('Location: ?'); 
}
}

echo '<div class="titl">Гостевая :</div>';

error($err);

nav_start($c_comm, 10);
if ($c_comm != 0) {
while ($comm = mysql_fetch_assoc($sql_comm)) {
echo '<div class="gmenu">';
echo '<b>'.$comm['name'].'</b> ('.vtime($comm['date']).')<br/>'.out($comm['text']).' ';
echo '</div>';
}
} else { echo '<div class="gmenu">Сообщений нет...</div>'; }
echo '<div class="gmenu"><img src="/img/mail.png"><a href="/menu/book.php?book=add"> Написать сообщение</a></div>';
view_nav('?');
break;
case 'add':
echo '<div class="titl">Написать сообщение</div>
<div class="gmenu">
<form method="POST" action="?">
Ваше имя:<br/>
<input type="text" name="name" /><br />
Сообщение:</br>
<textarea cols="20" name="text"></textarea><br/>
<input type="submit" name="add" value="Добавить">
</form>
</div>';
break;
}
include_once('../system/foot.php');

?>