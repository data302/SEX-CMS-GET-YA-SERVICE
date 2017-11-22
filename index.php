<?php
include_once('system/config.php');
include_once('system/head.php');


$c_cat = mysql_result(mysql_query("SELECT COUNT(*) FROM `cat` "), 0);
echo '<div class="title">Категории:</div>';
nav_start($c_cat, 3);
if ($c_cat != 0) {
$sql_cat = mysql_query("SELECT * FROM `cat` ORDER BY `id` DESC LIMIT $start, 25");
while ($cat = mysql_fetch_assoc($sql_cat)) {
$films = mysql_result(mysql_query("SELECT COUNT(*) FROM `video` WHERE `id_cat` = '".$cat['id']."' "), 0);
echo '<a href="/cat/'.$cat['id'].'"class="mine"> '.$cat['title'].' <ul class="cnt">'.$films.'</ul></a>';
}
} else { echo '<div class="error">На данном сайте нет ни одной категории...</div>'; }
$c_film = mysql_result(mysql_query("SELECT COUNT(*) FROM `video` "), 0);
echo '<div class="title">Новинки :</div>';
nav_start($c_film, 25);
if ($c_film != 0) {
$sql_film = mysql_query("SELECT * FROM `video` ORDER BY `id` DESC LIMIT $start, 3");
while ($video = mysql_fetch_assoc($sql_film)) {
$films = mysql_result(mysql_query("SELECT COUNT(*) FROM `video` WHERE `id` = '".$video['id']."' "), 0);
$cat = mysql_fetch_assoc(mysql_query("SELECT * FROM `cat` WHERE `id` = '".$video['id_cat']."'"));
echo '<div class="news">
<table><tbody><tr><td style="width:1%;vertical-align:top;">
<img class="link2" src="'.$video['src'].'"width="80">
</td><td style="vertical-align:top;"><div class="title">
<a href="/file/'.$video['id'].'"> '.$video['title'].'</a></div></br>
<div class="title"><b>Категория:</b> <a href="/cat/'.$cat['id'].'">'.$cat['title'].'</a></div>
</td></tr></tbody></table></div></div>';
}
} else { echo '<div class="error">На данном сайте нет ни одного видео...</div>'; }

include_once('system/foot.php');
?>
