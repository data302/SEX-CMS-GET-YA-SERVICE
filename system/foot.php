<?php

$system =  mysql_fetch_assoc(mysql_query("SELECT * FROM `system` WHERE `id` = '1'"));
if ($_SERVER['PHP_SELF'] != '/index.php') {
echo '<a href="/"class="mine">На главную</a>';
}
ads_foot();

echo '<div class="title"> '.$system['copy'].'<span class="cnt2">Online: ' . GetUsersOnline() .'</span></div></body>
</html>';

?>
