<?php
/* Smarty version 3.1.34-dev-7, created on 2020-03-05 16:23:28
  from 'D:\PHP\xampp\htdocs\web\templates\admin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e60b700d5bd49_81603156',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '15644c69c6b1afd6a0e5590f31d425bc000679f9' => 
    array (
      0 => 'D:\\PHP\\xampp\\htdocs\\web\\templates\\admin.tpl',
      1 => 1583396592,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:tpl/redirect.tpl' => 1,
    'file:tpl/user.tpl' => 1,
    'file:tpl/prod.tpl' => 1,
    'file:tpl/kind.tpl' => 1,
    'file:tpl/menu.tpl' => 1,
    'file:tpl/slide.tpl' => 1,
    'file:tpl/contact.tpl' => 1,
  ),
),false)) {
function content_5e60b700d5bd49_81603156 (Smarty_Internal_Template $_smarty_tpl) {
?><!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['xoImgUrl']->value;?>
bootstrap/bootstrap.min.css"> <!--斷線CSS-->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> -->
    <!-- Font Awesome Icons -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['xoImgUrl']->value;?>
vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <title><?php echo $_smarty_tpl->tpl_vars['WEB']->value['web_title'];?>
</title>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['xoImgUrl']->value;?>
bootstrap/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['xoImgUrl']->value;?>
bootstrap/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['xoImgUrl']->value;?>
bootstrap/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"><?php echo '</script'; ?>
>
  
</head>
<body>
	    <?php $_smarty_tpl->_subTemplateRender("file:tpl/redirect.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <h1 class="text-center mt-3"><?php echo $_smarty_tpl->tpl_vars['WEB']->value['web_title'];?>
</h1>
    <div class="container">
        <div class="row">
            <div class="col-sm-9">

                <?php if ($_smarty_tpl->tpl_vars['WEB']->value['file_name'] == "user.php") {?>
                    <?php $_smarty_tpl->_subTemplateRender("file:tpl/user.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                <!--此處多一個商品管理的樣板-->
                <?php } elseif ($_smarty_tpl->tpl_vars['WEB']->value['file_name'] == "prod.php") {?>  
                    <?php $_smarty_tpl->_subTemplateRender("file:tpl/prod.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                <?php } elseif ($_smarty_tpl->tpl_vars['WEB']->value['file_name'] == "kind.php") {?>  
                    <?php $_smarty_tpl->_subTemplateRender("file:tpl/kind.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                <?php } elseif ($_smarty_tpl->tpl_vars['WEB']->value['file_name'] == "menu.php") {?>  
                    <?php $_smarty_tpl->_subTemplateRender("file:tpl/menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                <?php } elseif ($_smarty_tpl->tpl_vars['WEB']->value['file_name'] == "slide.php") {?>  
                    <?php $_smarty_tpl->_subTemplateRender("file:tpl/slide.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                <?php } elseif ($_smarty_tpl->tpl_vars['WEB']->value['file_name'] == "contact.php") {?>  
                    <?php $_smarty_tpl->_subTemplateRender("file:tpl/contact.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                <?php }?>

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
                        <a href="cart.php" class="list-group-item">
                            <li style="list-style-type: none">購物車</li>
                        </a>
                        <a href="user.php" class="list-group-item">
                            <li style="list-style-type: none">會員管理</li>
                        </a>
                        <a href="prod.php" class="list-group-item">
                            <li style="list-style-type: none">商品管理</li>
                        </a>
                        <a href="kind.php" class="list-group-item">
                            <li style="list-style-type: none">類別管理</li>
                        </a>
                        <a href="menu.php" class="list-group-item">
                            <li style="list-style-type: none">選單管理</li>
                        </a>
                        <a href="slide.php" class="list-group-item">
                            <li style="list-style-type: none">輪播圖管理</li>
                        </a>
                        <a href="contact.php" class="list-group-item">
                            <li style="list-style-type: none">聯絡我們管理</li>
                        </a>
                        </a>
                        <a href="http://localhost/adminer/adminer.php" class="list-group-item" target="_blank"> <!--target="_blank"新開一個分頁-->
                            <li style="list-style-type: none">資料庫管理</li>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html><?php }
}
