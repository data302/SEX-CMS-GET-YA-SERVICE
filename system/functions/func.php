<?php
session_start();
# Онлайн
function GetUsersOnline(){
    clearstatcache();
    $SessionDir = session_save_path();
    $Timeout = 60 * 3;
    if ($Handler = scandir ($SessionDir)){
        $count = count ($Handler);
        $users = 0;

        for ($i = 2; $i < $count; $i++){
            if (time() - fileatime ($SessionDir . '/' . $Handler[$i]) < $Timeout){
                $users++;
            }
        }

        return $users;
    } else {
        return 'error';
    }
}

#Реклама вверху
function ads_head(){
$ahs = mysql_fetch_assoc(mysql_query("SELECT `ads_head` FROM `system` WHERE `id` = '1'"));
if (!empty($ahs['ads_head'])) { echo '<div class="rekl">'.out($ahs['ads_head']).'</div>'; }
}
#Реклама внизу
function ads_foot(){
$ahs = mysql_fetch_assoc(mysql_query("SELECT `ads_foot` FROM `system` WHERE `id` = '1'"));
if (!empty($ahs['ads_foot'])) { echo '<div class="rekl">'.out($ahs['ads_foot']).'</div>'; }
}

# Транслит
function trans($str) {
$tr = array(
"А"=>"a","Б"=>"b","В"=>"v","Г"=>"g",
"Д"=>"d","Е"=>"e","Ж"=>"j","З"=>"z","И"=>"i",
"Й"=>"y","К"=>"k","Л"=>"l","М"=>"m","Н"=>"n",
"О"=>"o","П"=>"p","Р"=>"r","С"=>"s","Т"=>"t",
"У"=>"u","Ф"=>"f","Х"=>"h","Ц"=>"ts","Ч"=>"ch",
"Ш"=>"sh","Щ"=>"sch","Ъ"=>"","Ы"=>"yi","Ь"=>"",
"Э"=>"e","Ю"=>"yu","Я"=>"ya","а"=>"a","б"=>"b",
"в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
"з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
"м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
"с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
"ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
"ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya",
" "=> "_", "."=> "", "/"=> "_"
);
return strtr($str,$tr);
}

# Фильтруем числа
function int($var) {
return abs(intval($var));
}

# Фильтруем текст
function txt($text) {
return trim(mysql_real_escape_string(htmlspecialchars($text, ENT_QUOTES, 'utf-8')));
}

# Выводим текст
function out($var) {
return nl2br(code(smile($var)));
}

// настройки
$set['site'] = $_SERVER['HTTP_HOST'];
$set['onpage'] = 10;

if (isset($_COOKIE['userlogin']) and isset($_COOKIE['userpass'])) {
    $userlogin = check($_COOKIE['userlogin']);
    $userpass = check($_COOKIE['userpass']);

    $query = mysql_query("SELECT * FROM `users` WHERE `login` = '$userlogin' and `pass` = '$userpass' LIMIT 1");
    $user = mysql_fetch_assoc($query);

    if (isset($user['id'])) {
        $config['onpage'] = $user['onpage'];

        if ($user['login'] != $userlogin or $user['pass'] != $userpass) {
    		setcookie('userlogin', '', time() - 86400*31);
			setcookie('userpass', '', time() - 86400*31);
		}
	}
}

function check($check){
	$check = htmlspecialchars(mysql_real_escape_string($check));

	$search = array('|', '\'', '$', '\\', '^', '%', '`', "\0", "\x00", "\x1A", "‮⁄⁪⁫⁬∩");
	$replace = array('&#124;', '&#39;', '&#36;', '&#92;', '&#94;', '&#37;', '&#96;', '', '', '', '');
	$msg = str_replace($search, $replace, $msg);

	$msg = stripslashes(trim($msg));
	return $check;
}

function generate($number){
	$arr = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','r','s','t','u','v','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','R','S','T','U','V','X','Y','Z','1','2','3','4','5','6','7','8','9','0');
    // Генерируем пароль
    $pass = '';
    for($i = 0; $i < $number; $i++){
		// Вычисляем случайный индекс массива
		$index = rand(0, count($arr) - 1);
		$pass .= $arr[$index];
    }
	return $pass;
}

# Ф-я для вывода времени
function vtime($var) {
if ($var == NULL) $var = time();
$full_time = date('d.m.Y в H:i', $var);
$date = date('d.m.Y', $var);
$time = date('H:i', $var);
if ($date == date('d.m.Y')) $full_time = date('Сегодня в H:i', $var);
if ($date == date('d.m.Y', time()-60*60*24)) $full_time = date('Вчера в H:i', $var);
return $full_time;
}

# Ф-я для показа ошибок
function error($var) {
if (!empty($var)) echo '<div class="gmenu">'. $var .'</div>';
}

function highlight($php) {
$php = strtr($php, array ('<br />' => '','\\' => 'slash'));
$php = html_entity_decode(trim($php), ENT_QUOTES, 'UTF-8');
$php = substr($php, 0, 2) != "" ? $php = "<?php\n" . $php . "\n?>": $php;
$php = highlight_string(stripslashes($php), true);
$php = strtr($php, array ('slash' => '&#92;',':' => '&#58;','[' => '&#91;'));
return '<div class="code">' . $php . '</div>';
}

# Смайлы
function smile($text){
$text = strtr($text, array(
':angel:'=>'<img src="/img/smiles/1.png" alt=""/>',
':('=>'<img src="/img/smiles/2.png" alt=""/>',
':cool:'=>'<img src="/img/smiles/3.png" alt=""/>',
':D'=>'<img src="/img/smiles/4.png" alt=""/>',
':hm:'=>'<img src="/img/smiles/5.png" alt=""/>',
':omg:'=>'<img src="/img/smiles/6.png" alt=""/>'));
return $text;
}

# BB-code
$home = 'http://'. $_SERVER['HTTP_HOST'] .'';
function code($var){
$var = preg_replace('#\[php\](.+?)\[\/php\]#e', 'highlight_code("\1")', $var);
//$var  = preg_replace('#\[code\](.*?)\[/code\]#ie', 'highlight("\1")', $var);
$var = preg_replace('#\[b\](.*?)\[/b\]#si', '<b>\1</b>', $var);
$var = preg_replace('#\[i\](.*?)\[/i\]#si', '<i>\1</i>', $var);
$var = preg_replace('#\[u\](.*?)\[/u\]#si', '<u>\1</u>', $var);
$var = preg_replace('#\[s\](.*?)\[/s\]#si', '<s>\1</s>', $var);
$var = preg_replace('#\[red\](.*?)\[/red\]#si', '<span style="color:red">\1</span>', $var);
$var = preg_replace('#\[green\](.*?)\[/green\]#si', '<span style="color:green">\1</span>', $var);
$var = preg_replace('#\[blue\](.*?)\[/blue\]#si', '<span style="color:blue">\1</span>', $var);
$var = preg_replace( "#\[center\](.+?)\[/center\]#is", "<center>\\1</center>", $var);
$var = preg_replace('#\[url\=(http\://.+)\](.+)\[/url\]#i','<a href="\1">\2</a>',$var);
$var = preg_replace( "~\\[img\](.+?)\[/img\]~", "<a href=\"\\1\"><img src=\"".$home."/system/resize.php?image=\\1\" alt=\"Картинка\" /></a>", $var);
$var = preg_replace( "#(^|[\n ])([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $var);
$var = preg_replace( "#(^|[\n ])((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $var);
$var = preg_replace( array ('#\[code\](.*?)\[\/code\]#se'), array ("''.highlight('$1').''"), str_replace("]\n", "]", $var));
return $var;
}

# Навигация
function page($k_page = 1) {
$page = 1;
if (isset($_GET['page'])) {
if ($_GET['page'] == 'end') $page = intval($k_page);
else if (is_numeric($_GET['page'])) $page = intval($_GET['page']);
}
if ($page < 1) $page = 1;
if ($page > $k_page) $page = $k_page;
return $page;
}
function k_page ($k_post = 0, $k_p_str = 10) {
if ($k_post != 0) {
$v_pages = ceil($k_post / $k_p_str);
return $v_pages;
}
else return 1;
}
function str($link = '?', $k_page = 1, $page = 1) {
if ($page < 1) $page = 1;
echo '<div class="title">Страницы:  ';
if ($page != 1) echo '<a href="'. $link .'page=1"class="mine"></a> ';
if ($page != 1) echo '<a href="'. $link .'page=1"class="mine">1</a>';
else echo '1';
for ($ot=-3; $ot<=3; $ot++)
{
if ($page + $ot > 1 && $page + $ot < $k_page)
{
if ($ot == -3 && $page + $ot > 2) echo ' ... ';
if ($ot != 0) echo ' <a href="'. $link .'page='. ($page + $ot) .'"class="mine">'. ($page + $ot) .'</a>';
else echo ' '. ($page + $ot) .'';
if ($ot == 3 && $page + $ot < $k_page - 1) echo '  ...  ';
}
}
if ($page != $k_page) echo ' <a href="'. $link .'page=end"class="mine">'. $k_page .'</a>';
else if ($k_page > 1) echo ' '. $k_page .'';
if ($page!=$k_page) echo ' <a href="'. $link .'page=end"class="mine"></a>';
echo '</div>';
}
function nav_start($var, $limit) {
global $k_page, $page, $start;
$k_page = k_page($var, $limit);
$page = page($k_page);
$start = $limit * $page - $limit;
}
function view_nav($link = '?') {
global $k_page, $page;
if ($k_page > 1) str($link, $k_page, $page);
}

?>
