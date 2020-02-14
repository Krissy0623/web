<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<{$xoImgUrl}>bootstrap/bootstrap.min.css"> <!--斷線CSS-->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> -->

    <title>會員管理</title>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<{$xoImgUrl}>bootstrap/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="<{$xoImgUrl}>bootstrap/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="<{$xoImgUrl}>bootstrap/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  
  </head>
  <body>
	<{* 轉向樣版連結 *}>
	<{include file="tpl/redirect.tpl"}>

    <!-- <h1><{$op}></h1> -->
    <{if $smarty.session.admin}> <!--有值就進來執行;真是管理員,不真不是管理員-->
    	<{* 管理員 *}>  
    	<{include file="tpl/admin.tpl"}>
    <{else}>
        <{* 訪客 *}>
	
		<{if $op=="login_form" }>
        	<{include file="tpl/login_form.tpl"}>
        <{elseif $op=="reg_form"}>
        	<{include file="tpl/reg_form.tpl"}>
        <{/if}>
    <{/if}>	
 </body>
</html>