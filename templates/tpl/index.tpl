
<{if $op == "contact_form"}>
    <{include file="tpl/contact_form.tpl"}>
<{elseif  $op == "ok"}>
  <{include file="tpl/ok.tpl"}>
  
<{* 登入 *}>
<{elseif  $op == "login_form"}>
  <{include file="tpl/login_form.tpl"}>
<{* 註冊 *}>
<{elseif  $op == "reg_form"}>
  <{include file="tpl/reg_form.tpl"}>

<{else}>
  <{* 把body.tpl引進來 *}>
  <{include file="tpl/body.tpl"}>
<{/if}>