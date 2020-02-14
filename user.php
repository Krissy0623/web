<?php
require_once 'head.php';

/* 過濾變數，設定預設值 */
$op = system_CleanVars($_REQUEST, 'op', 'login_form', 'string'); /*$_REQUEST就是POS,GET,COOKIE都算*/
$sn = system_CleanVars($_REQUEST, 'sn', '', 'int');
 
/* 程式流程 */
switch ($op){
  case "reg_form" : //原為op_form
    $msg = reg_form(); //原為op_form
    break;
    // 以下內容改成break;
    // header("location:index.php");//注意前面不可以有輸出
    // exit;
    
  // case "reg" :
  //   $msg = reg();
  //   header("location:index.php");//注意前面不可以有輸出
  //   exit;  
  case "reg" :
    $msg = reg();
    redirect_header("index.php", '註冊成功', 3000);
    exit;  

  case "logout" :
    $msg = logout();
    //(輸入值:轉向頁面,訊息,時間)
    redirect_header("user.php", '登出成功', 3000);
    exit;  

  case "login" :
    $msg = login();
    header("location:index.php");//注意前面不可以有輸出
    exit; //跟die();是一樣的

  default: //都沒有的時候跑default的login_form
    $op = "login_form";
    login_form();
    break;  
}
 
/*---- 將變數送至樣版----*/
$smarty->assign("WEB", $WEB);
$smarty->assign("op", $op); //送去樣板就會顯示,但要下指令<{$op}>
 
/*---- 程式結尾-----*/
$smarty->display('user.tpl');
 
/*---- 函數區-----*/
/*=======================
註冊函式(寫入資料庫)
=======================*/
function reg() {
  global $db; /*要使用請global才可以使用*/
  #過濾變數 /*外來的變數一定要先過濾！！有打過濾變數,如果輸入資料有特殊字元「單引號」也可以註冊*/
  $_POST['uname'] = db_filter($_POST['uname'], '帳號');
  $_POST['pass'] = db_filter($_POST['pass'], '密碼');
  $_POST['chk_pass'] = db_filter($_POST['chk_pass'], '確認密碼');
  $_POST['name'] = db_filter($_POST['name'], '姓名');
  $_POST['tel'] = db_filter($_POST['tel'], '電話');
  $_POST['email'] = db_filter($_POST['email'], 'email',FILTER_SANITIZE_EMAIL);
  #加密處理
  if($_POST['pass'] != $_POST['chk_pass']){
    redirect_header("index.php?op=reg_form","密碼不一致");
    exit;
  }
  
  $_POST['pass']  = password_hash($_POST['pass'], PASSWORD_DEFAULT);
  $_POST['token']  = password_hash($_POST['uname'], PASSWORD_DEFAULT);

  #寫入語法
  $sql="INSERT INTO `users` (`uname`, `pass`, `name`, `tel`, `email`, `token`)
  VALUES ('{$_POST['uname']}', '{$_POST['pass']}', '{$_POST['name']}', '{$_POST['tel']}', '{$_POST['email']}', '{$_POST['token']}');";

  $db->query($sql) or die($db->error() . $sql);
  $uid = $db->insert_id;

  // print_r($uid);/*看有沒有串接*/
  // die();
}

function logout() {
  $_SESSION['admin']="";
    setcookie("name", "", time()- 3600 * 24 * 365); 
    setcookie("token", "", time()- 3600 * 24 * 365); 
}

function reg_form(){ //原為op_form
  global $smarty;
}

function login(){
  global $smarty;
  $name="admin";
  $pass="111111";
  $token="xxxxxx";

  if ($name == $_POST['name'] and $pass == $_POST['pass']){
      $_SESSION['admin'] = true;
      $_POST['remember'] = isset($_POST['remember']) ? $_POST['remember'] : "";
      
      if($_POST['remember']){
        setcookie("name", $name, time()+ 3600 * 24 * 365); 
        setcookie("token", $token, time()+ 3600 * 24 * 365); 
      }
      // header("location:index.php"); 此行註解,打下方的方法
      redirect_header("index.php", '登入成功', 3000);
  }else{
    // header("location:user.php");
    redirect_header("user.php", '登入失敗', 3000);
  }
  print_r($_POST); //也可以使用var_dump($_POST);
  die();
}
 

function login_form(){
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
//     $op = "login_form";
//     login_form();
//     break;  
// }
