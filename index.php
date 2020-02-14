<?php
require_once 'head.php';

// print_r($_COOKIE);die(); /*如果有按記住我,此段會把cookie叫出來*/

/* 過濾變數，設定預設值 */
$op = system_CleanVars($_REQUEST, 'op', 'op_list', 'string'); /*$_REQUEST就是POS,GET,COOKIE都算*/
$sn = system_CleanVars($_REQUEST, 'sn', '', 'int');

/* 程式流程 */
switch ($op){
    case "contact_form" : 
        $msg = contact_form(); 
        break;

    case "ok" : 
        $msg = ok(); 
        break;

    case "login_form" : 
        $msg = login_form(); 
        break;
    //做這邊
    case "reg_form" : 
        $msg = reg_form(); 
        break;

    case "reg" :
        $msg = reg();
        header("location:index.php");//注意前面不可以有輸出
        exit;  
  
    default: 
        $op = "op_list";
        break;  
  }
   
  /*---- 將變數送至樣版----*/
  $smarty->assign("WEB", $WEB);
  $smarty->assign("op", $op); //送去樣板就會顯示,但要下指令<{$op}>
   
$smarty->assign("a0", "關於我們"); 
$smarty->assign("a1", "服務項目");
$smarty->assign("a2", "產品目錄");
$smarty->assign("a3", "聯絡資訊");
$smarty->assign("a4", "聯絡我們");

/*---- 程式結尾-----*/
$smarty->display('theme.tpl');

// ----函式區-------
function contact_form(){

}
function ok(){

}
function login_form(){

}
function reg_form(){

}
