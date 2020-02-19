<?php
require_once 'head.php';

#權限檢查
if(!$_SESSION['admin'])redirect_header("index.php", '您沒有權限', 3000);

/* 過濾變數，設定預設值 */
$op = system_CleanVars($_REQUEST, 'op', 'op_list', 'string'); /*$_REQUEST就是POS,GET,COOKIE都算*/
$uid = system_CleanVars($_REQUEST, 'uid', '', 'int');
 
/* 程式流程 */
switch ($op){
  case "op_update": 
    $msg = op_update($uid); 
    redirect_header("user.php", $msg, 3000);
    break;

  case "op_form": 
    $msg = op_form($uid); 
    break;
  
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
function op_update($uid=""){ //有給值就是編輯;沒有值就是新增
  global $db;
  //下方是用來過濾,變數的過濾
  $_POST['uname'] = db_filter($_POST['uname'], '帳號');
  $_POST['pass'] = db_filter($_POST['pass'], ''); //密碼可以不用寫值,因為不是必填
  $_POST['name'] = db_filter($_POST['name'], '姓名');
  $_POST['tel'] = db_filter($_POST['tel'], '電話');
  $_POST['email'] = db_filter($_POST['email'], 'email',FILTER_SANITIZE_EMAIL);
  $_POST['kind'] = db_filter($_POST['kind'], '會員狀態');
  //過濾到此↑
  $and_col = "";
  if($_POST['pass']){
    $_POST['pass']  = password_hash($_POST['pass'], PASSWORD_DEFAULT); //加密
    //假如有傳密碼,才更新密碼
    $and_col = "`pass` = '{$_POST['pass']}',";
  }
  //不管字數還是字串都要用單引號包起來
  $sql= "UPDATE `users` SET
        `uname` = '{$_POST['uname']}',
        {$and_col}  
        `name` = '{$_POST['name']}',
        `tel` = '{$_POST['tel']}',
        `email` = '{$_POST['email']}',
        `kind` = '{$_POST['kind']}'
        WHERE `uid` = '{$uid}';
  "; //die($sql);
  $db->query($sql) or die($db->error() . $sql);
  return "會員資料更新成功";
}


function op_form($uid=""){ //有給值就是編輯;沒有值就是新增
  global $smarty,$db;

  if($uid){
    $sql="SELECT *
          FROM `users`
          WHERE `uid` = '{$uid}'
    "; //die($sql);
  
    $result = $db->query($sql) or die($db->error() . $sql); /*result門票*/
    $row = $result->fetch_assoc();
    // print_r($row);die();
  }
  $row['uid'] = isset($row['uid']) ? $row['uid'] : "";
  $row['uname'] = isset($row['uname']) ? $row['uname'] : "";
  $row['name'] = isset($row['name']) ? $row['name'] : "";
  $row['tel'] = isset($row['tel']) ? $row['tel'] : "";
  $row['email'] = isset($row['email']) ? $row['email'] : "";
  $row['kind'] = isset($row['kind']) ? $row['kind'] : "0";
  $smarty->assign("row",$row);  
}

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
