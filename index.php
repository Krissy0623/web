<?php
require_once 'head.php';

$smarty->assign("a0", "關於我們"); 
$smarty->assign("a1", "服務項目");
$smarty->assign("a2", "當季旅遊");
$smarty->assign("a3", "聯絡我們");   

/*---- 程式結尾-----*/
$smarty->display('theme.tpl');