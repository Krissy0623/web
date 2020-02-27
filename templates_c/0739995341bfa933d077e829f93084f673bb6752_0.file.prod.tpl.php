<?php
/* Smarty version 3.1.34-dev-7, created on 2020-02-27 16:24:44
  from 'D:\PHP\xampp\htdocs\web\templates\tpl\prod.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e577ccc3176e7_86851617',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0739995341bfa933d077e829f93084f673bb6752' => 
    array (
      0 => 'D:\\PHP\\xampp\\htdocs\\web\\templates\\tpl\\prod.tpl',
      1 => 1582791877,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e577ccc3176e7_86851617 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['op']->value == "op_list") {?>
    <table class="table table table-bordered table-striped table-hover table-sm">
        <thead>
            <tr>
                <th scope="col" style="width:85px">圖片</th>
                <th scope="col">標題</th>
                <th scope="col">分類</th>
                <th scope="col" class="text-right">價格</th>
                <th scope="col" class="text-center">狀態</th>
                <th scope="col" class="text-center">計數</th>
                <th scope="col" class="text-center">新增
                    <a href="?op=op_form"><i class="fas fa-plus-square"></i></a>
                    
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rows']->value, 'row');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
?>              <tr>
                <td><img src="<?php echo $_smarty_tpl->tpl_vars['row']->value['prod'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
" width=80></td>
                <td class="align-middle"><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</td>                 <td class="align-middle"><?php echo $_smarty_tpl->tpl_vars['row']->value['kind_sn'];?>
</td>
                <td class="text-right align-middle"><?php echo $_smarty_tpl->tpl_vars['row']->value['price'];?>
</td>
                <td class="text-center align-middle"><?php if ($_smarty_tpl->tpl_vars['row']->value['enable']) {?><i class="fas fa-check"></i><?php }?></td>
                <td class="text-center align-middle"><?php echo $_smarty_tpl->tpl_vars['row']->value['counter'];?>
</td>
                <td class="text-center align-middle">
                    <a href="prod.php?op=op_form&sn=<?php echo $_smarty_tpl->tpl_vars['row']->value['sn'];?>
"><i class="fas fa-edit"></i></a> <!--可以編輯選擇到的項目-->
                    <a href="javascript:void(0)" onclick="op_delete(<?php echo $_smarty_tpl->tpl_vars['row']->value['sn'];?>
);"><i class="far fa-trash-alt"></i></a>
                </td>
            </tr>
            <?php
}
} else {
?>
                <tr>
                    <td colspan=6>目前沒有資料</td>
                </tr>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </tbody>
    </table>
    
    <!--sweetalert2-->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['xoAppUrl']->value;?>
class/sweetalert2/sweetalert2.min.css">
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['xoAppUrl']->value;?>
class/sweetalert2/sweetalert2.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
        function op_delete(sn){ //這裡是javascript所以不用加錢字符號
                Swal.fire({
                    title: '你確定嗎?',
                    text: "你將無法還原",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '是的,刪除它!',
                    cancelButtonText: '取消'
                    }).then((result) => {
                    if (result.value) {
                        document.location.href="prod.php?op=op_delete&sn="+sn;
                    }
                })    
        }
    <?php echo '</script'; ?>
>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['op']->value == "op_form") {?>
    <div class="container mt-5" style="padding-top: 30px;">
        <h1 class="text-center">商品管理表單</h1>
        
        <form action="prod.php" method="post" id="myForm" class="mb-2" enctype="multipart/form-data">
        <!--傳檔案就是要加enctype="multipart/form-data"(規定)-->
        <!--  `content`, `price`, `enable`, `date`, `sort`, `counter` -->
        <div class="row">         
            <!--標題-->              
            <div class="col-sm-4">
                <div class="form-group">
                    <label>標題<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="title" id="title" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
">
                </div>
            </div>         
            <!--分類-->              
            <div class="col-sm-4">
                    <div class="form-group">
                        <label>分類</label>
                        <select name="kind_sn" id="kind_sn" class="form-control">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['row']->value['kind_sn_options'], 'option');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['option']->value) {
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['option']->value['sn'];?>
" <?php if ($_smarty_tpl->tpl_vars['option']->value['sn'] == $_smarty_tpl->tpl_vars['row']->value['kind_sn']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['option']->value['title'];?>
</option>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                </div>
            <!--商品狀態-->
            <div class="col-sm-4">
                <div class="form-group">
                    <label style="display:block;">商品狀態</label>
                    <input type="radio" name="enable" id="enable_1" value="1" <?php if ($_smarty_tpl->tpl_vars['row']->value['enable'] == '1') {?>checked<?php }?>>
                    <label for="enable_1" style="display:inline;">啟用</label>&nbsp;&nbsp;
                    <input type="radio" name="enable" id="enable_0" value="0" <?php if ($_smarty_tpl->tpl_vars['row']->value['enable'] == '0') {?>checked<?php }?>>
                    <label for="enable_0" style="display:inline;">停用</label>
                </div>
            </div>      
            <!--價格-->              
            <div class="col-sm-3">
                <div class="form-group">
                    <label>價格</label>
                    <input type="text" class="form-control" name="price" id="price" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['price'];?>
">
                </div>
            </div>         
            <!--日期-->              
            <div class="col-sm-3">
                <div class="form-group">
                    <label>日期</label>
                    <input type="text" class="form-control" name="date" id="date" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['date'];?>
" onClick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})">
                </div>
            </div>             
            <!--排序-->              
            <div class="col-sm-3">
                <div class="form-group">
                    <label>排序</label>
                    <input type="text" class="form-control" name="sort" id="sort" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['sort'];?>
">
                </div>
            </div>             
            <!--計數-->              
            <div class="col-sm-3">
                <div class="form-group">
                    <label>計數</label>
                    <input type="text" class="form-control" name="counter" id="counter" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['counter'];?>
">
                </div>
            </div>
            <!--圖片上傳-->              
            <div class="col-sm-6">
                <div class="form-group">
                    <label>圖片</label>
                    <input type="file" class="form-control" name="prod" id="prod" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['prod'];?>
">
                    <label class="mt-1">
                        <?php if ($_smarty_tpl->tpl_vars['row']->value['prod']) {?>
                            <img src="<?php echo $_smarty_tpl->tpl_vars['row']->value['prod'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
" class="img-fluid">
                        <?php }?>
                    </label>

                </div>
            </div> 
        </div>

        <div class="row">
            <div class="col-sm-12">  
                <!-- 商品內容 -->
                <div class="form-group mt-3">
                    <label class="control-label">商品內容</label>
                    <textarea class="form-control" rows="5" id="content" name="content"><?php echo $_smarty_tpl->tpl_vars['row']->value['content'];?>
</textarea>
                </div>
            </div>
        </div>

        <div class="text-center pb-2">
            <input type="hidden" name="op" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['op'];?>
"> <!--$_POST['op給他一個']="叫做reg-未來要做的動作"-->
            <input type="hidden" name="sn" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['sn'];?>
">
            <button type="submit" class="btn btn-primary">送出</button>
        </div>  
        <!--name是要拿來顯示資料後端的標題-->
        </form>
        <!--表單驗證-->
        <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js">
        <?php echo '</script'; ?>
>
        <style>
            .error{
                color:red;
            }
        </style>
        <!--調用函式-->
        <?php echo '<script'; ?>
>
            $(function(){
            $("#myForm").validate({
                submitHandler: function(form) {
                    form.submit(); //form的物件 驗證後送出
                },
                rules: { //rules是屬性
                    'title' : { //uname是物件 
                        required: true
                    }
                },
                messages: {
                    'title' : {
                        required: "必填"
                    }
                },
            })
            });
        <?php echo '</script'; ?>
>

        <?php echo '<script'; ?>
 type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['xoAppUrl']->value;?>
class/My97DatePicker/WdatePicker.js'>
        <?php echo '</script'; ?>
>

    </div>
<?php }
}
}
