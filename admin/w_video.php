<?php
include_once('../system/config.php');
require_once '../system/in_a.php';
include_once('../system/head.php');

if ($user) {

switch ($_GET['act']) {

# Добавляем видео
default:
echo '<div class="title">Добавление видео</div>';
if (isset($_POST['add'])) {
$title = txt($_POST['title']);
$src= txt($_POST['src']);
$strana = txt($_POST['strana']);
$act= txt($_POST['act']);
$dlina = txt($_POST['dlina']);
$url = txt($_POST['url']);
$note = txt($_POST['note']);
$id_cat = txt($_POST['id_cat']);
$id_ya = txt($_POST['id_ya']);
if (empty($title)) $err .= '<div class="error">Не введено название...</div>';
if (empty($src)) $err .= '<div class="error">Не введена ссылка на скрин...</div>';
if (empty($strana)) $err .= '<div class="error">Не введена страна...</div>';
if (empty($act)) $err .= '<div class="error">Не введены актёры...</div>';
if (empty($dlina)) $err .= '<div class="error">Не введено время видео...</div>';
if (empty($url)) $err .= '<div class="error">Не введена ссылка на видео...</div>';
if (empty($note)) $err .= '<div class="error">Не введено описание...</div>';
if (empty($id_cat)) $err .= '<div class="error">Не выбрана категория...</div>';
if (empty($id_ya)) $err .= '<div class="error">Не выбрано облачное хранилище...</div>';
if (!isset($err)) {
mysql_query("INSERT INTO `video` SET `title` = '".$title ."', `src` = '".$src."', `strana` = '".$strana."', `act` = '".$act."',  `dlina` = '".$dlina."', `url` = '".$url."', `note` = '".$note."', `id_cat` = '".$id_cat."', `get-ya` = '".$id_ya."', `date` = '". time() ."'");
echo '<div class="ok">Запись добавлена</div>';
}
}
error($err);
$sql_cat = mysql_query("SELECT * FROM `cat`");
$sql_ya = mysql_query("SELECT * FROM `get-ya`");
echo '<div class="link">
<form method="POST" action="w_video.php?">
Название: <br/>
<input type="title" name="title"></br>
Ссылка на скрин: <br/>
<input type="title" name="src"></br>
Страна: <br/>
<input type="title" name="strana"></br>
Актёры: <br/>
<input type="text" name="act"></br>
Время: <br/>
<input type="title" name="dlina"></br>
Ссылка на видео:</br>
<input type="title" name="url"></br>
О видео:</br>
<textarea cols="20" name="note"></textarea><br/>
Категория:<br/>
<select name="id_cat" />';
while ($cat = mysql_fetch_assoc($sql_cat)) {
echo '<option value=" '.$cat['id'].' ">'.$cat['title'].'</option>';
}
echo '</select><br/>
Облачное хранилище:<br/>
<select name="id_ya" />';
while ($ya = mysql_fetch_assoc($sql_ya)) {
echo '<option value=" '.$ya['id'].' ">'.$ya['title'].'</option>';
}
echo '</select><br/>
<input type="submit" name="add" value="Добавить">
</form>
</div>';
break;


# Удаление видео
case 'del':
echo '<div class="title">Удаление записи</div>';
$film = mysql_fetch_array(mysql_query("SELECT * FROM `video` WHERE `id` = '".int($_GET['id'])."'"));
if(!$film) {
echo '<div class="error">Такого видео нет!</div>';
include_once('../system/foot.php');
exit;
}

mysql_query("DELETE FROM `video` WHERE `id` = ' ".$film['id']." ' ");
echo '<div class="ok">Видео удалено!</div>';
break;
}
}

include_once('../system/foot.php');
?>
