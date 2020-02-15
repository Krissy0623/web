<?php
/* Smarty version 3.1.34-dev-7, created on 2020-02-15 03:30:03
  from 'D:\PHP\xampp\htdocs\web\templates\tpl\admin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e4757ab3c3706_42258203',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7143c6296ce98e6f942fbdbc92a580961854cece' => 
    array (
      0 => 'D:\\PHP\\xampp\\htdocs\\web\\templates\\tpl\\admin.tpl',
      1 => 1581733098,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e4757ab3c3706_42258203 (Smarty_Internal_Template $_smarty_tpl) {
?><h1 class="text-center mt-3">管理員樣板</h1>
<div class="container">
    <div class="row">
        <div class="col-sm-9">
        </div>
        <div class="col-sm-3">
            <div class="card" style="width: 18rem;">
                <div class="card-header">
                  管理員
                </div>
                <ul class="list-group list-group-flush">
                    <a href="index.php">
                        <li class="list-group-item">首頁</li>
                    </a>
                    <a href="index.php?op=logout" class="list-group-item">
                        <li style="list-style-type: none">登出</li>
                    </a>
                    <a href="http://localhost/adminer/adminer.php" class="list-group-item" target="_blank">
                        <li style="list-style-type: none">資料庫管理</li>
                    </a>
                    
                    <!-- 資料庫管理老師的打法
                        <li class="list-group-item">
                        <a href="http://localhost/adminer/adminer.php" class="btn-block" target="blank">資料庫管理</a></li> target="_blank"新開一個分頁
                    -->

					<!--老師範例-->
					<!-- <li class="list-group-item">
                    	<a href="index.php" class="btn-block">首頁</a>
                	</li>	
                	<li class="list-group-item">
                    	<a href="user.php?op=logout" class="btn-block">登出</a>
                	</li> -->
                </ul>
                
              </div>
        </div>
    </div>
</div><?php }
}
