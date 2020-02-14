<?php
/* Smarty version 3.1.34-dev-7, created on 2020-02-14 03:43:04
  from 'D:\PHP\xampp\htdocs\web\templates\tpl\redirect.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e460938df8350_72715910',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '72b51c9e75194b903a04f10eba3c042331987385' => 
    array (
      0 => 'D:\\PHP\\xampp\\htdocs\\web\\templates\\tpl\\redirect.tpl',
      1 => 1581648026,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e460938df8350_72715910 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- 你有送轉向訊息我就送這一段 -->
<?php if ($_smarty_tpl->tpl_vars['redirect']->value) {?> 
  <!--sweetalert2-->
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['xoAppUrl']->value;?>
class/sweetalert2/sweetalert2.min.css">
  <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['xoAppUrl']->value;?>
class/sweetalert2/sweetalert2.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
>
    /*先跑完onload在跑動元素*/
    window.onload = function(){
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: "<?php echo $_smarty_tpl->tpl_vars['message']->value;?>
",
        showConfirmButton: false, //顯示不顯示確認紐
        timer: '<?php echo $_smarty_tpl->tpl_vars['time']->value;?>
' //顯示秒數後自動關閉
      })
    }
  <?php echo '</script'; ?>
>
<?php }
}
}
