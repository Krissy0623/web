<{* sweetalert2 *}>
<!-- 你有送轉向訊息我就送這一段 -->
<{if $redirect}> 
  <!--sweetalert2-->
  <link rel="stylesheet" href="<{$xoAppUrl}>class/sweetalert2/sweetalert2.min.css">
  <script src="<{$xoAppUrl}>class/sweetalert2/sweetalert2.min.js"></script>
  <script>
    /*先跑完onload在跑動元素*/
    window.onload = function(){
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: "<{$message}>",
        showConfirmButton: false, //顯示不顯示確認紐
        timer: '<{$time}>' //顯示秒數後自動關閉
      })
    }
  </script>
<{/if}>