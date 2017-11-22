<?php

ob_start();
$system = mysql_fetch_assoc(mysql_query("SELECT * FROM `system` WHERE `id` = '1'"));
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="/css/style.css"/>
<link rel="shortcut icon" href="/design/favicon.ico" type="image/x-icon"/>
<title>xxx +18 видео онлайн + скачать</title>
<meta name="description" content="'.$system['description'].'"/>
<meta name="keywords" content="'.$system['keywords'].'"/>
</head>
<body>';
echo '<div class="head"><a href="/"><img src="/css/logo.png"></a></div>';
ads_head();
 echo '<a href="/menu"class="mine">Меню пользователя</a></div>';
?>
