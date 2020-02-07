<?php
/* Smarty version 3.1.34-dev-7, created on 2020-02-07 07:09:11
  from 'D:\PHP\xampp\htdocs\web\templates\tpl\reg_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e3cff07c3f577_07843654',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cdfaf6cd8aa3765f8c0c1be5ad5db943508a9463' => 
    array (
      0 => 'D:\\PHP\\xampp\\htdocs\\web\\templates\\tpl\\reg_form.tpl',
      1 => 1581048080,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e3cff07c3f577_07843654 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container mt-5">
    <h1 class="text-center">註冊表單</h1>
    
    <form action="user.php" method="post" id="myForm" class="mb-2" enctype="multipart/form-data">
    <!--傳檔案就是要加enctype="multipart/form-data"(規定)-->
    <!-- <div class="row"> -->
    <div display:flex>         
        <!--帳號-->              
        <div class="col-sm-6, col-md-4">
          <div class="form-group">
            <label>帳號<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="uname" id="uname" value="" required>
          </div>
        </div>         
        <!--密碼-->              
        <div class="col-sm-6, col-md-4">
          <div class="form-group">
            <label>密碼<span class="text-danger">*</span></label>
            <input type="password" class="form-control" name="pass" id="pass" value="" required>
          </div>
        </div>         
        <!--確認密碼-->              
        <div class="col-sm-6, col-md-4">
          <div class="form-group">
            <label>確認密碼<span class="text-danger">*</span class="text-danger"></label>
            <input type="password" class="form-control" name="chk_pass" id="chk_pass" value="" required>
          </div>
        </div>         
        <!--姓名-->              
        <div class="col-sm-6, col-md-4">
          <div class="form-group">
            <label>姓名<span class="text-danger">*</span class="text-danger"></label>
            <input type="text" class="form-control" name="name" id="name" value="" required>
          </div>
        </div>         
        <!--電話-->              
        <div class="col-sm-6, col-md-4">
          <div class="form-group">
            <label>電話<span class="text-danger">*</span class="text-danger"></label>
            <input type="text" class="form-control" name="tel" id="tel" value="" required>
          </div>
        </div>             
        <!--信箱-->              
        <div class="col-sm-6, col-md-4">
          <div class="form-group">
            <label>信箱<span class="text-danger">*</span class="text-danger"></label>
            <input type="text" class="form-control" name="email" id="email" value="" required>
          </div>
        </div> 
      </div>
      <div class="text-center pb-20">
        <input type="hidden" name="op" value="reg"> <!--$_POST['op給他一個']="叫做reg-未來要做的動作"-->
        <button type="submit" class="btn btn-primary">送出</button>
      </div>
  
    </form>
  <!--name是要拿來顯示資料後端的標題-->
  </div><?php }
}
