<?php
include_once('system/config.php');
$cat = mysql_fetch_assoc(mysql_query("SELECT * FROM `cat` WHERE `id` = '".int($_GET['id'])."'"));
include_once('system/head.php');

if(!$cat) {
echo '<div class="title">Ошибка</div><div class="error">Такой категории нет...</div>';
include_once('system/foot.php');
exit;
}

$c_video = mysql_result(mysql_query("SELECT COUNT(*) FROM `video` WHERE `id_cat` = '".$cat['id']."'"), 0);
echo '<div class="title">'.$cat['title'].' :</div>';
nav_start($c_video, 10);
if ($c_video != 0) {
$sql_notes = mysql_query("SELECT * FROM `video` WHERE `id_cat` = '".$cat['id']."' ORDER BY `id` DESC LIMIT $start, 10");
while ($video = mysql_fetch_assoc($sql_notes)) {
echo '<div class="news">
<table><tbody><tr><td style="width:1%;vertical-align:top;">
<img class="link2" src="'.$video['src'].'"width="80">
</td><td style="vertical-align:top;"><div class="title">
<a href="/file/'.$video['id'].'"> '.$video['title'].'</a></div></br>
<div class="title"><b>Категория:</b> <a href="/cat/'.$cat['id'].'">'.$cat['title'].'</a></div>
</td></tr></tbody></table></div></div>';
}
} else { echo '<div class="error">Видео в данной категории нет!</div>'; }

view_nav('/cat.php?id='.int($_GET['id']).'');

if ($user['level'] == 1)echo '<a href="/admin/w_cat.php?act=edit&amp;id='.$cat['id'].'"class="mine"> Изменить категорию</a></div>';
if ($user['level'] == 1)echo '<a href="/admin/w_cat.php?act=del&amp;id='.$cat['id'].'"class="mine"> Удалить категорию</a></div>';

include_once('system/foot.php');
?>
