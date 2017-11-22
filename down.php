<?php
include_once('system/config.php');
$video = mysql_fetch_assoc(mysql_query("SELECT * FROM `video` WHERE `id` = '".int($_GET['id'])."'"));


if($video['get-ya']==1){
/* MEDIAFIRE */
echo '<a href="http://get-ya.mxis.ru/players/embed_mediafire.php?media='.$video['url'].'&name='.$video['title'].'&poster='.$video['src'].'"class="mine">Скачать: '.$video['title'].'</a>';
}
if($video['get-ya']==2){
/* ЯНДЕКС.ДИСК */
echo '<a href="http://get-ya.mxis.ru/players/embed_yandex.php?url='.$video['url'].'&name='.$video['title'].'&poster='.$video['src'].'"class="mine">Скачать: '.$video['title'].'</a>';
}
if($video['get-ya']==3){
/* GOOGLE DRIVE */
echo '<a href="http://get-ya.mxis.ru/players/embed_google.php?url2='.$video['url'].'&name='.$video['title'].'&poster='.$video['src'].'"class="mine">Скачать: '.$video['title'].'</a>';
}

if ($user['level'] == 1)echo '<a href="/admin/w_video.php?act=del&amp;id='.$video['id'].'"class="mine"> Удалить видео</a>';

?>
