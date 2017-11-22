<?php
include_once('system/config.php');
$video = mysql_fetch_assoc(mysql_query("SELECT * FROM `video` WHERE `id` = '".int($_GET['id'])."'"));
include_once('system/head.php');

if(!$video) {
echo '<div class="title">Ошибка</div><div class="error">Такой записи нет...</div>';
include_once('./system/foot.php');
exit;
}

$cat = mysql_fetch_assoc(mysql_query("SELECT * FROM `cat` WHERE `id` = '".$video['id_cat']."'"));
mysql_query("UPDATE `video` SET  `look` = `look`+1 WHERE `id` = ' ".int($_GET['id'])." ' ");
echo '<div class="title">'.$video['title'].'</div>
<div class="link2"><center><img src="'.$video['src'].'"width="200"></a></center></div>
<div class="link2"><b>Название:</b> '.$video['title'].'</b>
<b>Страна:</b> '.$video['strana'].'<br>
<b>Актёры:</b> '.$video['act'].'<br>
<b>Категория:</b> '.$cat['title'].'<br>
<b>Время:</b> '.$video['dlina'].'<br>
<b>О видео:</b> '.out($video['note']).'<br>
</div>
<div class="title">Статистика :</div>
<div class="link">Просмотров: '.$video['look'].'</div>
<div class="link">Добавлен: '.vtime($video['date']).'</div>
<div class="link">Категория: <a href="/cat/'.$cat['id'].'"><font color="#000000">'.$cat['title'].'</font>
</a></div>';

if($video['get-ya']==1){
/* MEDIAFIRE */
echo '<div class="video"><iframe class="embed-responsive-item" src="http://get-ya.mxis.ru/players/embed_mediafire.php?media='.$video['url'].'&name='.$video['title'].'&poster='.$video['src'].'" height="315" width="560" frameborder="0" scrolling="no" frameborder="0" allowfullscreen></iframe></div>';
}
if($video['get-ya']==2){
/* ЯНДЕКС.ДИСК */
echo '<div class="video"><iframe class="embed-responsive-item" src="http://get-ya.mxis.ru/players/embed_yandex.php?url='.$video['url'].'&name='.$video['title'].'&poster='.$video['src'].'" height="315" width="560" frameborder="0" scrolling="no" frameborder="0" allowfullscreen></iframe></div>';
}
if($video['get-ya']==3){
/* GOOGLE DRIVE */
echo '<div class="video"><iframe class="embed-responsive-item" src="http://get-ya.mxis.ru/players/embed_google.php?url='.$video['url'].'&name='.$video['title'].'" height="315" width="560" frameborder="0" scrolling="no" frameborder="0" allowfullscreen></iframe></div>';
}




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
echo '<a href="http://get-ya.mxis.ru/players/embed_google.php?url='.$video['url'].'&name='.$video['title'].'&poster='.$video['src'].'"class="mine">Скачать: '.$video['title'].'</a>';
}

if ($user['level'] == 1)echo '<a href="/admin/w_video.php?act=del&amp;id='.$video['id'].'"class="mine"> Удалить видео</a>';

include_once('system/foot.php');
?>
