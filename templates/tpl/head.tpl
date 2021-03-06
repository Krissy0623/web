  <!-- <style>
      納入css檔9620行
      #mainNav {
        background-color: rgba(255,72,0,.5);
      }
  </style> -->
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container">
          <a class="navbar-brand js-scroll-trigger" href="#page-top"><{$WEB.web_title}></a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto my-2 my-lg-0">
              <{foreach $mainMenus as $mainMenu}>
                <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="<{$mainMenu.url}>" <{if $mainMenu.target == 1}>target="_blank" <{/if}>><{$mainMenu.title}></a>
                </li>
              <{/foreach}>

              <{* 購物車圖示 *}>  
              <{if $smarty.session.cartAmount and $op != "order_form"}>
                <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="cart.php?op=order_form">
                    <i class="fas fa-cart-plus"></i> 
                  </a>
                </li>
              <{/if}>

              <!-- <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="index.php#portfolio"><{$a2}></a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="index.php#contact"><{$a3}></a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="index.php?op=contact_form"><{$a4}></a>
              </li> -->
              <{if $smarty.session.user.kind === 1}> 
              <{* 管理員 *}>
                <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="user.php">後台</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="index.php?op=logout">登出</a>
                </li>
              <{* 會員 *}>  
              <{elseif $smarty.session.user.kind === 0}>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="index.php?op=logout">登出</a>
              </li>
              <{* 未登入 *}>
              <{else}>
                <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="index.php?op=login_form">登入</a>
                </li>
                <!-- <{* 做這邊 *}>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="index.php?op=reg_form">註冊</a>
                </li> -->
              <{/if}>
            </ul>
          </div>
        </div>
      </nav>
    