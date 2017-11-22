<?

include_once('../system/config.php');
include_once('../system/head.php');

$cat = mysql_result(mysql_query("SELECT COUNT(*) FROM `cat`"),0);
$video = mysql_result(mysql_query("SELECT COUNT(*) FROM `video`"),0);
$best_video  = mysql_fetch_assoc(mysql_query("SELECT * FROM `video` ORDER BY `look` DESC LIMIT 1 "));
$last_video  = mysql_fetch_assoc(mysql_query("SELECT * FROM `video` ORDER BY `id` DESC LIMIT 1 "));

echo '<div class="title">Статистика</div>
<div class="link">Категорий: '.$cat.'</div>
<div class="link">Всего видео: '.$video.'</div>
<div class="link">Последнее: </div><a href="/file/'.$last_video['id'].'"class="mine">'.$last_video['title'].'</a></div>';
echo '<div class="link">Популярное: </div><a href="/file/'.$best_video['id'].'"class="mine">'.$best_video['title'].'</a></div>';
include_once('../system/foot.php');

?>
