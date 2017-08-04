<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html >
<head>
<meta charset="UTF-8">
<title>Sign Up Login</title>
<link rel="stylesheet" href="/Public/Home/css/style.css">
<link rel="stylesheet" href="/Public/Home/css/bootstrap.min.css">
<link rel="stylesheet" href="/Public/Home/css/buttons.css">
<!-- <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/icon?family=Material+Icons'> -->
<script type="text/javascript" src="/Public/Home/js/jquery-1.8.3.min.js"></script> 
<script type="text/javascript" src="/Public/Home/js/bootstrap.min.js"></script> 
<style type="text/css">
  #logo{
    z-index: 99;
    position: absolute;
    left:0px;
    top:0px;
    width: 200px;
  }
  .cont_ba_opcitiy{
    height: 198px;
  }
</style>

</head>

<body>

<body>
<img id="logo" src="/Public/Home/images/logo.png">
<div class="cotn_principal">
  <div class="cont_centrar">
    <div class="cont_login">

      <div class="cont_info_log_sign_up">
        <div class="col_md_login">
          <div class="cont_ba_opcitiy">
            <h2>LOGIN</h2>
            <p>Login to enjoy membership service.</p>
            <button class="btn_login" onclick="cambiar_login()">LOGIN</button>
          </div>
        </div>
        <div class="col_md_sign_up">
          <div class="cont_ba_opcitiy">
            <h2>SIGN UP</h2>
            <p>If you are still not our member,please register at once.</p>
            <button class="btn_sign_up" onclick="cambiar_sign_up()">SIGN UP</button>
          </div>
        </div>
      </div>
      <div class="cont_back_info">
        <div class="cont_img_back_grey"> <img src="/Public/Home/images/po2.png" alt="" /> </div>
      </div>
      <div class="cont_forms" >
        <div class="cont_img_back_"> <img src="/Public/Home/images/po2.png" alt="" /> </div>
        <form action="<?php echo U('login');?>" method="post" id="form1">
        <div class="cont_form_login"> <a href="#" onclick="ocultar_login_sign_up()" ><i class="material-icons">&#xE5C4;</i></a>
          <h2>LOGIN</h2>
            <input type="text" name="mem_mail" placeholder="Email" />
            <input type="password" name="mem_passwd" placeholder="Password" />
            <input type="text"  name="code" placeholder="Verify"  />
          <span>
              <img id="verify" src="<?php echo U('verify');?>" alt="" />
              <a href="javascript:;" class="button button-glow button-rounded button-raised button-primary">click to change</a>
          </span>
          <a href="#" class="button button-glow button-rounded button-highlight">LOGIN</a>
        </div>
        </form>
        <form action="<?php echo U('register');?>" method="post" id="form2">
        <div class="cont_form_sign_up"> <a href="#" onclick="ocultar_login_sign_up()"><i class="material-icons">&#xE5C4;</i></a>
          <h2>SIGN UP</h2>
            <input type="text" name="mem_mail" placeholder="Email" />
            <input type="text" name="mem_name" placeholder="UserName" />
            <input type="password" name="mem_passwd" placeholder="Password" />
            <input type="password" name="re_passwd" placeholder="Confirm Password" />
          <a href="#" id="signup" class="button button-glow button-rounded button-caution">SIGNUP</a>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="/Public/Home/js/index.js"></script>
</body>
</body>
<script type="text/javascript">
  $('a:contains("click to change")').click(function(){
    $('#verify').attr('src',"<?php echo U('verify');?>?c="+Math.random());
  })
  $('a:contains("LOGIN")').click(function(){
    $('form:first').submit();
  })
  $('a:contains("SIGNUP")').click(function(){
    $('form:last').submit();
  })
</script>
</html>