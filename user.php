<?php
require_once 'head.php';

#權限檢查
if(!$_SESSION['admin'])redirect_header("index.php", '您沒有權限', 3000);

/* 過濾變數，設定預設值 */
$op = system_CleanVars($_REQUEST, 'op', 'op_list', 'string'); /*$_REQUEST就是POS,GET,COOKIE都算*/
$sn = system_CleanVars($_REQUEST, 'sn', '', 'int');
 
/* 程式流程 */
switch ($op){
  
  // case "reg" :
  //   $msg = reg();
  //   header("location:index.php");//注意前面不可以有輸出
  //   exit;

  default: //都沒有的時候跑default的login_form
    $op = "op_list"; //login_form
    op_list();
    break;  
}
 
/*---- 將變數送至樣版----*/
$smarty->assign("WEB", $WEB);
$smarty->assign("op", $op); //送去樣板就會顯示,但要下指令<{$op}>
 
/*---- 程式結尾-----*/
$smarty->display('admin.tpl');
 
/*---- 函數區-----*/
/*=======================
註冊函式(寫入資料庫)
=======================*/
function op_list(){
  global $smarty,$db;

  $sql = "SELECT * /*選擇所有欄位*/
          FROM `users` /*從users抓 */
  "; 
  
  $result = $db->query($sql) or die($db->error() . $sql);/*result門票*/
  $rows=[]; //array();
  while($row = $result->fetch_assoc()){ /*不知道有幾筆用while;$result->fetch_row()一筆一筆去撈*;用$row去接撈出來的資料*/
    //加入資料過濾的語法
    $row['uname'] = htmlspecialchars($row['uname']); //字串
    $row['uid'] = (int)$row['uid']; //整數
    $row['kind'] = (int)$row['kind'];
    // $row['name'] = htmlspecialchars($row['name']);  
    $row['tel'] = htmlspecialchars($row['tel']);
    $row['email'] = htmlspecialchars($row['email']);
    $rows[] = $row;
  }
  $smarty->assign("rows",$rows);  
  // print_r();die();
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
