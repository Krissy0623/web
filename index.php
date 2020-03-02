<?php
require_once 'head.php';

// print_r($_COOKIE);die(); /*如果有按記住我,此段會把cookie叫出來*/

/* 過濾變數，設定預設值 */
$op = system_CleanVars($_REQUEST, 'op', 'op_list', 'string'); /*$_REQUEST就是POS,GET,COOKIE都算*/
$sn = system_CleanVars($_REQUEST, 'sn', '', 'int');

/* 程式流程 */
switch ($op){    
    case "reg" :
      $msg = reg();
      redirect_header("index.php", '註冊成功', 3000);
      exit; 

    case "logout" :
        $msg = logout();
        //(輸入值:轉向頁面,訊息,時間)
        redirect_header("index.php", '登出成功', 3000);
        exit;

    case "login" :
        $msg = login();
        header("location:index.php");//注意前面不可以有輸出
        exit; //跟die();是一樣的

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
  
    default: 
        $op = "op_list";
        $mainSlides = getMenus("mainSlide",true);
        $smarty->assign("mainSlides", $mainSlides);
        break;  
  }
   
  /*---- 將變數送至樣版----*/
  $mainMenus = getMenus("mainMenu");
  $smarty->assign("mainMenus", $mainMenus,true);
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
function getMenus($kind,$pic=false){
  global $smarty,$db;
  
  $sql = "SELECT *
          FROM `kinds`
          WHERE `kind`='{$kind}'
          ORDER BY `sort`
  ";//die($sql);

  $result = $db->query($sql) or die($db->error() . $sql);
  $rows=[];//array();
  while($row = $result->fetch_assoc()){    
    $row['sn'] = (int)$row['sn'];//分類
    $row['title'] = htmlspecialchars($row['title']);//標題
    $row['enable'] = (int)$row['enable'];//狀態 
    $row['url'] = htmlspecialchars($row['url']);//網址
    $row['target'] = (int)$row['target'];//外連
    $row['pic'] = ($pic == true) ? getFilesByKindColsnSort($kind,$row['sn']) :""; //圖片連結
    $rows[] = $row;
  } 
  return $rows;
}

function contact_form(){

}
function ok(){

}
function login_form(){

}
function reg_form(){

}
function login(){
  global $db;
  //資料庫的過濾方式↓ 註冊時有使用過此過濾法;'帳號'、'密碼'有填,所以一定要輸入不然會跳錯
  $_POST['uname'] = db_filter($_POST['uname'], '帳號');
  $_POST['pass'] = db_filter($_POST['pass'], '密碼');
  //到adminer/adminer.php「取得語法」,到user表裡→到uname=隨便選擇一筆查詢copy下來,如下
  $sql="SELECT *
        FROM `users`
        WHERE `uname` = '{$_POST['uname']}'
  ";
  //$result把資料送去執行,撈出來之後,再用變數$row去接他
  $result = $db->query($sql) or die($db->error() . $sql); //resul執行
  $row = $result->fetch_assoc() or redirect_header("index.php?op=login_form", '帳號輸入錯誤', 3000); //用來接
  
  //字串與整數的過濾
  $row['uname'] = htmlspecialchars($row['uname']); //字串
  $row['uid'] = (int)$row['uid']; //整數
  $row['kind'] = (int)$row['kind'];
  $row['name'] = htmlspecialchars($row['name']);
  $row['tel'] = htmlspecialchars($row['tel']);
  $row['email'] = htmlspecialchars($row['email']);
  $row['pass'] = htmlspecialchars($row['pass']); //user.php的op_list有做過,但這兩個要自己加進來-1
  $row['token'] = htmlspecialchars($row['token']); //-2

  if (password_verify($_POST['pass'], $row['pass'])){ //帳號輸入進來的,跟裡面撈到的值(前者為明碼,後者為加密過的碼)
    /*---驗證登入成功就顯示為1---
    echo $_POST['pass']. "<br>";
    echo $row['pass']. "<br>";
    die("1");
    -------------------------*/
    //登入成功
    $_SESSION['user']['uid'] = $row['uid'];
    $_SESSION['user']['uname'] = $row['uname'];
    $_SESSION['user']['name'] = $row['name'];
    $_SESSION['user']['tel'] = $row['tel'];
    $_SESSION['user']['email'] = $row['email'];
    $_SESSION['user']['kind'] = $row['kind']; 

    //三元運算,變數存在就指過去左邊,變數不存在就指過去左邊  
    $_POST['remember'] = isset($_POST['remember']) ? $_POST['remember'] : "";
      
    if($_POST['remember']){
      setcookie("uname", $row['uname'], time()+ 3600 * 24 * 365); 
      setcookie("token", $row['token'], time()+ 3600 * 24 * 365); 
    }
    redirect_header("index.php", '登入成功', 3000);
    // header("location:index.php"); 此行註解,打下方的方法
  }else{    
    /*---驗證登入失敗就顯示為0---
    echo $_POST['pass']. "<br>";
    echo $row['pass']. "<br>";
    die("0");
    -------------------------*/    
    $_SESSION['user']['uid'] = "";
    $_SESSION['user']['uname'] = "";
    $_SESSION['user']['name'] = "";
    $_SESSION['user']['tel'] = "";
    $_SESSION['user']['email'] = "";
    $_SESSION['user']['kind'] = "";

    redirect_header("index.php?op=login_form", '登入失敗', 3000);
  }
  // print_r($_POST);die(); 也可以使用var_dump($_POST);
  
}

function logout(){    
  $_SESSION['user']['uid'] = "";
  $_SESSION['user']['uname'] = "";
  $_SESSION['user']['name'] = "";
  $_SESSION['user']['tel'] = "";
  $_SESSION['user']['email'] = "";
  $_SESSION['user']['kind'] = "";

  setcookie("uname", "", time()- 3600 * 24 * 365); 
  setcookie("token", "", time()- 3600 * 24 * 365);
  // print_r($_SESSION);die(); 
  }

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