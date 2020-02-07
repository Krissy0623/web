<?php
/* Smarty version 3.1.34-dev-7, created on 2020-02-07 02:39:05
  from 'D:\PHP\xampp\htdocs\web\templates\tpl\admin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e3cbfb946ab28_07678285',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7143c6296ce98e6f942fbdbc92a580961854cece' => 
    array (
      0 => 'D:\\PHP\\xampp\\htdocs\\web\\templates\\tpl\\admin.tpl',
      1 => 1580979697,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e3cbfb946ab28_07678285 (Smarty_Internal_Template $_smarty_tpl) {
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
                    <a href="user.php?op=logout" class="list-group-item">
                        <li style="list-style-type: none">登出</li>
                    </a>                           
                	<li class="list-group-item">Vestibulum at eros</li>
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
