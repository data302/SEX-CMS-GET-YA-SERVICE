<?php
include_once('../system/config.php');
require_once '../system/in_a.php';
include_once('../system/head.php');

$system = mysql_fetch_assoc(mysql_query("SELECT * FROM `system` WHERE `id` = '1'"));

switch ($_GET['act']) {

default:
if (isset($_POST['save'])) {
$copy = txt($_POST['copy']);
$keywords = txt($_POST['keywords']);
$description = txt($_POST['description']);
$adv_foot = txt($_POST['adv_foot']);
mysql_query("UPDATE `system` SET `copy` = '".$copy."',`keywords` = '".$keywords."',`description` = '".$description."', WHERE `id` = '1' ");
echo '<div class="ok">Настройки сохранены</div>';
}
echo '<div class="title">Настройки сайта</div>
<div class="link">
<form method="POST" action="w_settings.php">
Копирайт:<br>
<input type="name" value="'.$system['copy'].'" name="ads_copy"><br>
Ключевые слова:<br>
<input type="name" value="'.$system['keywords'].'" name="keywords"><br>
Описание сайта:<br>
<input type="name" value="'.$system['description'].'" name="description"><br>
<input type="submit" name="save" value="Сохранить">
</form>
</div>';
break;

case 'ads':
if (isset($_POST['save'])) {
$foot = txt($_POST['foot']);
$head = txt($_POST['head']);
mysql_query("UPDATE `system` SET `ads_foot` = '".$foot."',`ads_head` = '".$head."' WHERE `id` = '1' ");
echo '<div class="title">Управление рекламой</div>';
echo '<div class="ok">Настройки сохранены</div>';
}
echo '<div class="link">
<form method="POST" action="w_settings.php?act=ads">
Реклама вверху: <br/>
<textarea rows="4" name="head">'.$system['ads_head'].'</textarea><br>
Реклама внизу: <br/>
<textarea rows="4" name="foot">'.$system['ads_foot'].'</textarea><br>
<input type="submit" name="save" value="Сохранить">
</form>
</div>';
break;

}


include_once('../system/foot.php');
?>
