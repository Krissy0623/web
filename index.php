<?php
require_once 'head.php';

// print_r($_COOKIE);die(); /*如果有按記住我,此段會把cookie叫出來*/

/* 過濾變數，設定預設值 */
$op = system_CleanVars($_REQUEST, 'op', 'op_list', 'string'); /*$_REQUEST就是POS,GET,COOKIE都算*/
$sn = system_CleanVars($_REQUEST, 'sn', '', 'int');

/* 程式流程 */
switch ($op){    
    case "contact_insert" :
      $msg = contact_insert();
      redirect_header("index.php", $msg , 5000);
      exit;

    case "checkUname" : //不要讓帳號重複
      echo json_encode(checkUname());
      exit;
    
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
        $_SESSION['returnUrl'] = getCurrentUrl();
        #輪播圖
        $mainSlides = getMenus("mainSlide",true);
        $smarty->assign("mainSlides", $mainSlides);
        op_list();

        #取得商品資料(含圖;最多六個) 
        break;  
  }
   
  /*---- 將變數送至樣版----*/
  $mainMenus = getMenus("mainMenu");
  $smarty->assign("mainMenus", $mainMenus);
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
/*##########################
  AJAX 檢查帳號是否重覆
  驗證不過 => false ， 驗證通過 => true
##########################*/
function checkUname() {
  global $db;
  $uname = system_CleanVars($_REQUEST, 'uname', '', 'string');

  if(check_uname($uname)){
    return false;//帳號有人使用，驗證不過
  }
  return true;
} 

/*=======================
  檢查帳號是否有人使用
  有人使用 傳回 true
  無人使用 傳回 false
=======================*/
function check_uname($uname){
  global $db;
  $sql="SELECT count(*) as count
        FROM `users`
        WHERE `uname`='{$uname}'
  ";    
  $result = $db->query($sql) or die($db->error() . $sql);
  $row = $result->fetch_assoc();

  if($row['count'])return true;
  return false;  
}


function op_list(){
  global $db,$smarty;
  
  $sql = "SELECT a.*,b.title as kinds_title
          FROM `prods` as a
          LEFT JOIN `kinds` as b on a.kind_sn=b.sn
          WHERE a.`enable`='1'
          ORDER BY a.`date` desc
          LIMIT 6;
  ";//die($sql);

  $result = $db->query($sql) or die($db->error() . $sql);
  $rows=[];//array();
  while($row = $result->fetch_assoc()){    
    $row['sn'] = (int)$row['sn'];//分類
    $row['title'] = htmlspecialchars($row['title']);//標題 
    $row['prod'] = getFilesByKindColsnSort("prod",$row['sn']);
    $row['kinds_title'] = htmlspecialchars($row['kinds_title']);//標題
    $rows[] = $row;
  }
  $smarty->assign("prods",$rows);  
  
  news_list();
}

function contact_insert(){
  global $db;
  
  $_POST['name'] = db_filter($_POST['name'], 'name');
  $_POST['tel'] = db_filter($_POST['tel'], 'tel');
  $_POST['email'] = db_filter($_POST['email'], 'email');
  $_POST['content'] = db_filter($_POST['content'], 'content');
  $_POST['date'] = strtotime("now");
  
  $sql="INSERT INTO `contacts` 
                    (`name`, `tel`, `email`, `content`, `date`)
                    VALUES 
                    ('{$_POST['name']}', '{$_POST['tel']}', '{$_POST['email']}', '{$_POST['content']}', '{$_POST['date']}')  
  ";
  $result = $db->query($sql) or die($db->error() . $sql);
  return "我們已收到您的聯絡事項，將儘快與您聯絡！";
}


function contact_form(){
  global $smarty;
  $row['op'] = "contact_insert";
  $smarty->assign("row", $row);

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

/*=================
註冊函式(寫入資料庫)
=================*/
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
  
  #檢查帳號是否重覆
  if(check_uname($_POST['uname'])){
    redirect_header("index.php?op=reg_form","帳號已有人使用");
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

function news_list(){
  global $smarty,$db;
  
  $sql = "SELECT a.*,b.title as kinds_title
          FROM `news` as a
          LEFT JOIN `kinds` as b on a.kind_sn=b.sn
          WHERE a.`enable`='1'
          ORDER BY a.`date` desc
          LIMIT 4
  ";//die($sql);

  // #---分頁套件(原始$sql 不要設 limit)
  // include_once _WEB_PATH."/class/PageBar/PageBar.php";
  // $pageCount = 10;
  // $PageBar = getPageBar($db, $sql, $pageCount, 10);
  // $sql     = $PageBar['sql'];
  // $total   = $PageBar['total'];
  // $bar     = ($total > $pageCount) ? $PageBar['bar'] : "";
  // $smarty->assign("bar",$bar);  
  // #---分頁套件(end)

  $result = $db->query($sql) or die($db->error() . $sql);
  $rows=[];//array();
  while($row = $result->fetch_assoc()){    
    $row['sn'] = (int)$row['sn'];//分類
    $row['title'] = htmlspecialchars($row['title']);//標題
    $row['prod'] = getFilesByKindColsnSort("news",$row['sn']);  
    $row['kinds_title'] = htmlspecialchars($row['kinds_title']);//標題
    $rows[] = $row;
  }
  $smarty->assign("news",$rows);  

}