<?php
require_once 'head.php';

/* 過濾變數，設定預設值 */
$op = system_CleanVars($_REQUEST, 'op', '', 'string'); /*$_REQUEST就是POS,GET都算*/
$sn = system_CleanVars($_REQUEST, 'sn', '', 'int');
 
/* 程式流程 */
switch ($op){
  case "xxx" :
    $msg = xxx();
    header("location:index.php");//注意前面不可以有輸出
    exit;

  case "logout" :
    $msg = logout();
    header("location:index.php");//注意前面不可以有輸出
    exit;  

  case "login" :
    $msg = login();
    header("location:index.php");//注意前面不可以有輸出
    exit; //跟die();是一樣的



  default:
    $op = "op_list";
    op_list();
    break;  
}
 
/*---- 將變數送至樣版----*/
$smarty->assign("WEB", $WEB);
$smarty->assign("op", $op);
 
/*---- 程式結尾-----*/
$smarty->display('user.tpl');
 
/*---- 函數區-----*/
function logout() {
  $_SESSION['admin']="";
}

function xxx(){
  global $smarty;
 
}
function login(){
  global $smarty;
  $name="admin";
  $pass="111111";
  if ($name == $_POST['name'] and $pass == $_POST['pass']){
      $_SESSION['admin'] = true;
      header("location:index.php");
  }else{
    header("location:user.php");
  }
  print_r($_POST); //也可以使用var_dump($_POST);
  die();
}
 


function op_list(){
  global $smarty;
}

  
/* 程式流程 */
// switch ($op){
//   case "op_form" :
//     $msg = op_form();
//     break;
  
//   case "yyy" :
//     $msg = yyy();
//     header("location:index.php");
//     exit;
  
//   default:
//     $op = "op_list";
//     op_list();
//     break;  
// }
