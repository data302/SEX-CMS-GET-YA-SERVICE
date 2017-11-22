<?php
include_once('../system/config.php');
require_once '../system/in_a.php';
include_once('../system/head.php');

if ($user) {
echo '<div class="title">Управление сайтом</div>
<a href="/admin/w_cat.php"class="mine">Добавить категорию</a></div>
<a href="/admin/w_video.php"class="mine">Добавить видео</a></div>
<div class="title">Настройки сайта</div>
<a href="/admin/w_settings.php?act=ads"class="mine">Управление рекламой</a></div>
<a href="/admin/w_settings.php"class="mine">Настройки сайта</a></div>';
}

include_once('../system/foot.php');
?>
