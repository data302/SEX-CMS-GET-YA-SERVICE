<?php
include_once('../system/config.php');
require_once '../system/in_a.php';
include_once('../system/head.php');

if ($user) {

switch ($_GET['act']) {

default:
echo '<div class="title">Создание категории</div>';
if (isset($_POST['add'])) {
$title= txt($_POST['title']);
if (empty($title)) $err .= '<div class="error">Не введено название... </div>';
if (!empty($title) && (strlen($title) < 2 || strlen($title) > 64)) $err .= '<div class="error">Неверная длина названия. Допустимо от 2 до 64 символов</div>';
if (!isset($err)) {
mysql_query("INSERT INTO `cat` SET `title` = '".$title."'");
echo '<div class="ok">Категория добавлена...</div>';
}
}
error($err);
echo '<div class="link">
<form action="?" method="post">
Название:<br/>
<input name="title" type="text"/><br/>
<input type="submit" name="add" value="Добавить"/>
</form>
</div>';
break;

case 'edit':
echo '<div class="title">Изменение категории</div>';
$cat = mysql_fetch_array(mysql_query("SELECT * FROM `cat` WHERE `id` = '".int($_GET['id'])."'"));
if(!$cat) {
echo '<div class="error">Такой категории нет...</div>';
include_once('../system/foot.php');
exit;
}
if (isset($_POST['edit'])) {
$title= txt($_POST['title']);
if (empty($title)) $err .= '<div class="error">Не введено название... </div>';
if (!empty($title) && (strlen($title) < 2 || strlen($title) > 64)) $err .= '<div class="error">Неверная длина названия. Допустимо от 2 до 64 символов</div>';
if (!isset($err)) {
mysql_query("UPDATE `cat` SET `title` = '".$title."'  WHERE `id` = '".$cat['id']."'");
echo '<div class="ok">Категория изменена...</div>';
}
}
error($err);
echo '<div class="link">
<form action="?act=edit&amp;id='.$cat['id'].'" method="post">
Название:<br/>
<input name="title" value="'.$cat['title'].'" type="text"/><br/>
<input type="submit" name="edit" value="Изменить"/>
</form>
</div>';
break;

case 'del':
echo '<div class="title">Удаление категории</div>';
$cat = mysql_fetch_array(mysql_query("SELECT * FROM `cat` WHERE `id` = '".int($_GET['id'])."'"));
if(!$cat) {
echo '<div class="error">Такой категории нет...</div>';
include_once('../system/foot.php');
exit;
}
mysql_query("DELETE FROM `cat` WHERE `id` = ' ".$cat['id']." ' ");
mysql_query("DELETE FROM `code` WHERE `id_cat` = ' ".$cat['id']." ' ");
echo '<div class="ok">Категория удалена...</div>';
break;

}
}

include_once('../system/foot.php');
?>
