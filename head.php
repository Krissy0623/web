<?php
/*
1. head.php為前台每個程式都會引入的檔案
2. 所有檔案都必須執行的流程，請放到這裡
3. smarty_01
 */
session_start(); //啟用 $_SESSION,前面不可以有輸出
error_reporting(E_ALL);@ini_set('display_errors', true); //設定所有錯誤都顯示
$http = 'http://';
if (!empty($_SERVER['HTTPS'])) {
  $http = ($_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
}

#網站實體路徑(不含 /)
define('_WEB_PATH', str_replace("\\", "/", dirname(__FILE__)));
//define是常數,被定義就被定義了 ; 
#網站URL(不含 /)
define('_WEB_URL', $http . $_SERVER["HTTP_HOST"] . str_replace($_SERVER["DOCUMENT_ROOT"], "", _WEB_PATH));

#--------- WEB -----
#程式檔名(含副檔名)
$WEB['file_name'] = basename($_SERVER['PHP_SELF']); //index.php
//basename(__FILE__)head.php
#--------- WEB END -----

#
/*---- 必須引入----*/
#引入樣板引擎
require_once _WEB_PATH.'/smarty.php';
#引入資料庫設定
require_once _WEB_PATH.'/sqlConfig.php';
// #引入設定檔
require_once _WEB_PATH . '/function.php';

//判斷是否為管理員↓ 1=管理員 0=會員 空=訪客
$_SESSION['user']['kind'] = isset($_SESSION['user']['kind']) ? $_SESSION['user']['kind'] : ""; 
/*三元運算,真就將$_SESSION['user']['kind']指定給前面的$_SESSION['user']['kind'];
不真就將""指定給前面的$_SESSION['user']['kind']*/ 

/*為了cookie使用 */
if($_SESSION['user']['kind'] === ""){
  $_COOKIE['token'] = isset($_COOKIE['token']) ? $_COOKIE['token'] : "";  
  $_COOKIE['uname'] = isset($_COOKIE['uname']) ? $_COOKIE['uname'] : "";  
  //過濾
  $_COOKIE['uname'] = db_filter($_COOKIE['uname'], '');
  $_COOKIE['token'] = db_filter($_COOKIE['token'], '');

  if($_COOKIE['uname'] && $_COOKIE['token']){
    $sql="SELECT *
        FROM `users`
        WHERE `uname` = '{$_COOKIE['uname']}'
    ";
    
    $result = $db->query($sql); 
    $row = $result->fetch_assoc(); 

    if($_COOKIE['token'] === $row['token']){

      $row['uname'] = htmlspecialchars($row['uname']); //字串
      $row['uid'] = (int)$row['uid']; //整數
      $row['kind'] = (int)$row['kind'];
      $row['name'] = htmlspecialchars($row['name']);
      $row['tel'] = htmlspecialchars($row['tel']);
      $row['email'] = htmlspecialchars($row['email']);
      $row['pass'] = htmlspecialchars($row['pass']);
      $row['token'] = htmlspecialchars($row['token']);

      $_SESSION['user']['uid'] = $row['uid'];
      $_SESSION['user']['uname'] = $row['uname'];
      $_SESSION['user']['name'] = $row['name'];
      $_SESSION['user']['tel'] = $row['tel'];
      $_SESSION['user']['email'] = $row['email'];
      $_SESSION['user']['kind'] = $row['kind']; 
    }
  }    
}

#轉向用
// (3)三元運算
$_SESSION['redirect'] = isset($_SESSION['redirect']) ? $_SESSION['redirect'] : "";
$_SESSION['message'] = isset($_SESSION['message']) ? $_SESSION['message'] : "";
$_SESSION['time'] = isset($_SESSION['time']) ? $_SESSION['time'] : "";

// (2)傳到樣板去
$smarty->assign("redirect", $_SESSION['redirect']); // <{$redirect}>
$smarty->assign("message", $_SESSION['message']);
$smarty->assign("time", $_SESSION['time']);

// (1)(練習時,先打註解起來的地方,然後使用smarty->assign)
// $_SESSION['redirect'] = true; //傳進來是真就轉頁
// $_SESSION['message'] = $message;
// $_SESSION['time'] = $time;

// (4)傳完就清掉
$_SESSION['redirect'] = "";
$_SESSION['message'] = "";
$_SESSION['time'] = "";
