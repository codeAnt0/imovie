<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>后台登录</title>
<meta name="author" content="DeathGhost" />
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/style.css" tppabs="css/style.css" />
<style>
body{height:100%;background:#16a085;overflow:hidden;}
canvas{z-index:-1;position:absolute;}
</style>
<!-- <script src="http://www.jq22.com/jquery/1.11.1/jquery.min.js"></script> -->
<script src="/Public/Admin/js/jquery.js"></script>
<script src="/Public/Admin/js/verificationNumbers.js" tppabs="js/verificationNumbers.js"></script>
<script src="/Public/Admin/js/Particleground.js" tppabs="js/Particleground.js"></script>
<script>
$(document).ready(function() {
  //粒子背景特效
  $('body').particleground({
    dotColor: '#5cbdaa',
    lineColor: '#5cbdaa'
  });
  //验证码
  createCode();
  //测试提交，对接程序删除即可
  $(".submit_btn").click(function(){
	  location.href="javascrpt:;"/*tpa=http://***index.html*/;
	  });
});
</script>
</head>
<style type="text/css">
  #logo{
    z-index: 99;
    position: absolute;
    left:0px;
    top:0px;
    width: 200px;
  }
  .val_icon > img{
    width : 118px;
    height :42px;
  }
  .verify{       
    background: #5cbdaa;
    color: white;
  }
  .admin_login dd .checkcode input {
    width: 176px;
  }
  .verify::-webkit-input-placeholder{
     color: white;
  }
</style>
<body>
<form action="" method="post">
<img id="logo" src="/Public/Admin/images/logo.png">
<dl class="admin_login">
 <dt>
  <strong>站点后台管理系统</strong>
  <em>Management System</em>
 </dt>
 <dd class="user_icon">
  <input type="text" name="name" placeholder="账号" class="login_txtbx"/>
 </dd>
 <dd class="pwd_icon">
  <input type="password" name="password" placeholder="密码" class="login_txtbx"/>
 </dd>
 <dd class="val_icon">
  <div class="checkcode">
    <input name="code" type="text" class="verify" placeholder="验证码" />
  </div>
    <img src="<?php echo U('verify');?>" id="v" />
 <!--  <input type="button" value="点击更换" class="ver_btn" onClick="validate();"> -->
 </dd>
 <dd>
  <input type="submit" value="立即登陆" class="submit_btn"/>
 </dd>
 <dd>
  <p>© 2015-2016 jq22 版权所有</p>
  <p>陕B2-8998988-1</p>
 </dd>
</dl>
</form>
<script type="text/javascript">
        $('#v').click(function(){
            var src="/index.php/Admin/Index/verify/"+Math.random();
            $(this).attr('src',src);
        })
</script>
</body>
</html>