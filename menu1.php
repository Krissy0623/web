<?php
/* 引入檔頭，每支程都會引入 */
require_once 'head.php';
 
if($_SESSION['user']['kind'] !== 1)redirect_header("index.php", '您沒有權限', 3000);

/* 過濾變數，設定預設值 */
$op = system_CleanVars($_REQUEST, 'op', 'op_list', 'string');
$sn = system_CleanVars($_REQUEST, 'sn', '', 'int');
$kind = system_CleanVars($_REQUEST, 'kind', 'mainMenu', 'string');
$ofsn = system_CleanVars($_REQUEST, 'ofsn', 0, 'int');


$kinds['mainMenu'] = array(
  "value" => "mainMenu",
  "title" => "主選單",
  "stop_level" => 1
);
$kinds['cartMenu'] = array(
  "value" => "cartMenu",
  "title" => "購物車選單",
  "stop_level" => 1
);
$kinds['levelMenu'] = array(
  "value" => "levelMenu",
  "title" => "多層選單",
  "stop_level" => 2
);

$smarty->assign("kinds", $kinds);

#防呆
$kind = (in_array($kind, array_keys($kinds))) ? $kind : "mainMenu";
 
/* 程式流程 */
switch ($op){
  case "op_delete" :
    $msg = op_delete($kind,$sn);
    redirect_header($_SESSION['returnUrl'], $msg, 3000);
    exit;

  case "op_insert" :
    $msg = op_insert($kind);
    redirect_header($_SESSION['returnUrl'], $msg, 3000);
    exit;

  case "op_update" :
    $msg = op_insert($kind,$sn);
    redirect_header($_SESSION['returnUrl'], $msg, 3000);
    exit;

  case "op_form" :
    $msg = op_form($kind,$sn,$ofsn,$kinds[$kind]['stop_level']);
    break;
 
  default:
    $op = "op_list";
    $_SESSION['returnUrl'] = getCurrentUrl();
    op_list($kind);
    break;  
}
/*---- 將變數送至樣版----*/
$smarty->assign("WEB", $WEB);
$smarty->assign("op", $op);
 
/*---- 程式結尾-----*/
$smarty->display('admin.tpl');
 
/*---- 函數區-----*/

function op_delete($kind,$sn){
  global $db;
  
  #檢查類別層次
  $downLevel = get_downLevel($kind,$sn);
  if($downLevel)redirect_header($_SESSION['returnUrl'], "尚有子類別，無法刪除！", 3000);

  #刪除選單資料表
  $sql="DELETE FROM `kinds`
        WHERE `sn` = '{$sn}'
  ";
  $db->query($sql) or die($db->error() . $sql);
  return "選單資料刪除成功";
}

/*===========================
  確認底下有幾層
  get_downLevel
===========================*/
function get_downLevel($kind,$sn,$downLevel=0) {
  global $db,$kinds;
  #層數
  $stop_level = $kinds[$kind]['stop_level'];

  if ($downLevel > $stop_level) {
    return $downLevel;
  }
  $level = $downLevel+1;
  $sql = "SELECT sn
          FROM `kinds`
          WHERE `ofsn`='{$sn}'
  ";//die($sql);
  $result = $db->query($sql) or die($db->error() . $sql);

  while ($row = $result->fetch_assoc()) {
    $downLevel_tmp = get_downLevel($kind,$row['sn'], $level);
    $downLevel = ($downLevel_tmp > $downLevel) ? $downLevel_tmp : $downLevel;
  }
  return $downLevel;
}

/*===========================
  用流水號 得到自己的層數
===========================*/
function get_thisLevel($kind,$sn, $level = 1) {
  global $db,$kinds;
  #層數
  $stop_level = $kinds[$kind]['stop_level'];

  if($sn=="0" and $level == "1")return "0";
  if ($level > $stop_level)return $level;

  $sql = "select ofsn
          from `kinds`
          where sn='{$sn}'"; // die($sql);

  $result = $db->query($sql) or die($db->error() . $sql);        
  list($ofsn) = $result->fetch_row();  

  if (!$ofsn) {
    return $level;
  }

  return get_thisLevel($kind,$ofsn, ++$level);
}
  
function op_insert($kind,$sn=""){
  global $db,$kinds;
  #層數
  $stop_level = $kinds[$kind]['stop_level'];						 
 
  $_POST['sn'] = db_filter($_POST['sn'], '');//流水號
  $_POST['title'] = db_filter($_POST['title'], '標題');//標題
  $_POST['kind'] = db_filter($_POST['kind'], '');//分類
  $_POST['enable'] = db_filter($_POST['enable'], '');//狀態
  $_POST['sort'] = db_filter($_POST['sort'], '');//排序
  $_POST['url'] = db_filter($_POST['url'], '');//網址
  $_POST['target'] = db_filter($_POST['target'], ''); //外連
  $_POST['ofsn'] = db_filter($_POST['ofsn'], ''); //父層

  if($sn){
    #
    $downLevel = get_downLevel($kind,$_POST['sn']);//判斷自已底下有幾層(不含自已)
    //$thisLevel = get_thisLevel($kind,$_POST['sn']);
    //$ofsn_downLevel = get_downLevel($kind,$_POST['ofsn']);//父層底下有幾層
    $ofsn_thisLevel = get_thisLevel($kind,$_POST['ofsn']);//目的自已的層數
    
    
    
    if($downLevel + $ofsn_thisLevel >= $stop_level)redirect_header($_SESSION['returnUrl'], "子類別太多，請先將子類別移動，再更新！", 3000);
    if($_POST['sn'] === $_POST['ofsn'])redirect_header($_SESSION['returnUrl'], "不能設定自己為父類別", 3000);
    
    
    $sql="UPDATE  `kinds` SET
                  `title` = '{$_POST['title']}',
                  `enable` = '{$_POST['enable']}',
                  `sort` = '{$_POST['sort']}',
                  `kind` = '{$_POST['kind']}',
                  `url` = '{$_POST['url']}',
                  `target` = '{$_POST['target']}',
                  `ofsn` = '{$_POST['ofsn']}'
                  WHERE `sn` = '{$_POST['sn']}'    
    ";
    $db->query($sql) or die($db->error() . $sql);
    $msg = "選單資料更新成功";
  }else{
    $sql="INSERT INTO `kinds` 
    (`title`, `enable`, `sort`, `kind`, `url`, `target`, `ofsn`)
    VALUES 
    ( '{$_POST['title']}', '{$_POST['enable']}', '{$_POST['sort']}', '{$_POST['kind']}', '{$_POST['url']}', '{$_POST['target']}', '{$_POST['ofsn']}')    
    "; //die($sql);
    $db->query($sql) or die($db->error() . $sql);
    $sn = $db->insert_id;
    $msg = "選單資料新增成功"; 
  }


  return $msg;

}

/*===========================
  用sn取得選單檔資料
===========================*/
function getKindsBySn($sn){
  global $db;
  $sql="SELECT *
        FROM `kinds`
        WHERE `sn` = '{$sn}'
  ";//die($sql);
  
  $result = $db->query($sql) or die($db->error() . $sql);
  $row = $result->fetch_assoc();
  return $row;

}

/*================================
  用kind 取得數量的最大值
================================*/
function getKindMaxSortByKind($kind,$ofsn=0){
  global $db;
  $sql = "SELECT count(*)+1 as count
          FROM `kinds`
          WHERE `kind`='{$kind}' and `ofsn`='{$ofsn}'
  ";//die($sql);

  $result = $db->query($sql) or die($db->error() . $sql);
  $row = $result->fetch_assoc();
  return $row['count'];
}

function get_ofsn_option($kind,$ofsn=0,$level=1){
  global $db,$kinds;
  #層數
  $stop_level = $kinds[$kind]['stop_level'];
  
  #結束條件
  if($level+1 > $stop_level)return;

  #下層
  $next_level = $level++;


  $sql = "SELECT *
					FROM `kinds`
					WHERE `kind`='{$kind}' and `ofsn`='{$ofsn}'
					ORDER BY `sort`
  ";//die($sql);
  $result = $db->query($sql) or die($db->error() . $sql);
  $rows=[];//array();
  while($row = $result->fetch_assoc()){ 
    $sn = (int)$row['sn'];//分類
		$title = htmlspecialchars($row['title']);//標題
		
		$sub = get_ofsn_option($kind,$sn,$next_level);
		$rows[] = [
			'sn' => $sn,
			'title' => $title,
			'sub' => $sub
		];
  }
  return $rows;
}

function op_form($kind, $sn="", $ofsn=0, $stop_level=1){
  global $smarty,$db;

  if($sn){
    $row = getKindsBySn($sn);
    $row['op'] = "op_update";
  }else{
    $row['op'] = "op_insert";
  }

  $row['sn'] = isset($row['sn']) ? $row['sn'] : "";
  $row['kind'] = isset($row['kind']) ? $row['kind'] : $kind;
  $row['title'] = isset($row['title']) ? $row['title'] : "";
  $row['enable'] = isset($row['enable']) ? $row['enable'] : "1";
  $row['url'] = isset($row['url']) ? $row['url'] : "";
  $row['target'] = isset($row['target']) ? $row['target'] : "0";
  $row['sort'] = isset($row['sort']) ? $row['sort'] : getKindMaxSortByKind($kind,$ofsn);
  
  $row['ofsn'] = isset($row['ofsn']) ? $row['ofsn'] : $ofsn;//父層
	$row['ofsn_option'] = get_ofsn_option($kind);//父層選項
	// print_r($row['ofsn_option']);die();
  

  $smarty->assign("row",$row);
  $smarty->assign("stop_level",$stop_level); 
}

function get_kinds($kind,$ofsn=0,$level=1){
  global $db,$kinds;
  #層數
  $stop_level = $kinds[$kind]['stop_level'];

  #結束條件
  if($level > $stop_level)return;
  $next_level = $level++;
  
  $sql = "SELECT *
          FROM `kinds`
          WHERE `kind`='{$kind}' and `ofsn`='{$ofsn}'
          ORDER BY `sort`
  ";//die($sql);
  $result = $db->query($sql) or die($db->error() . $sql);
  $rows=[];//array();
  while($row = $result->fetch_assoc()){ 
    $sn = (int)$row['sn'];//分類
    $ofsn = (int)$row['ofsn'];//分類
    $title = htmlspecialchars($row['title']);//標題
    $enable = (int)$row['enable'];//狀態 
    $url = htmlspecialchars($row['url']);//網址
    $target = (int)$row['target'];//外連 
   
    $sub = get_kinds($kind,$sn,$next_level);
    
    $rows[] = [
			'sn' => $sn,
			'ofsn' => $ofsn,
			'title' => $title,
			'enable' => $enable,
			'url' => $url,
			'target' => $target,
			'sub' => $sub
    ];
  }
  return $rows;
}

function op_list($kind){
	global $smarty,$db,$kinds;
	#層數
	$stop_level = $kinds[$kind]['stop_level'];
	#資料
  $rows = get_kinds($kind,0);
  
  $smarty->assign("rows",$rows);
  $smarty->assign("kind",$kind); 
  $smarty->assign("stop_level",$stop_level);  

}
