<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>社区生活服务管理系统 | login</title>

    <!--<link href="css/style.css" rel="stylesheet" type="text/css">-->
    <style>
        body{font:12px/180% Arial,Helvetica,Verdana;color:#5a5a5a; margin:0; background:#FFF;}
        body.login{ background: url('../img/bk1.jpg');	background-size:cover;}
        table,td{font:12px/180% Arial, "宋体",Helvetica, sans-serif,Verdana; color:#58595b;}
        table{border-collapse:collapse; border-spacing:0; empty-cells:show; }
        th, td { border-collapse:collapse; }
        A:link{text-decoration:none; color:#58595b;}
        A:visited{text-decoration:none; color:#58595b;}
        A:hover{text-decoration:none; color:#206fd5;}
        img{ border:0; }
        div,p,img,ul,li,form,input,label,span,dl,dt,dd,h1,h2,h3,h4,h5,h6{margin:0;padding:0;}
        input[type="reset"]::-moz-focus-inner, input[type="button"]::-moz-focus-inner, input[type="submit"]::-moz-focus-inner, input[type="file"] > input[type="button"]::-moz-focus-inner{   border:none;padding:0 }
        ol,ul,li{list-style-type:none;}
        .overz{ overflow:auto; zoom:1; overflow-x:hidden; overflow-y:hidden;}
        .dspn{ display:none;}
        a{blr:expression(this.onFocus=this.blur())} /*for IE*/
        a{outline:none;} /*for Firefox*/
        html{-webkit-text-size-adjust:none;}

        /*--login--*/
        .login_m{ width:403px; margin:0 auto; height:400px; margin-top:98px; /*position: absolute;left:50%;top:50%;margin-left:-202px;margin-top:-188px;*/}
        .login_logo{ text-align:center; margin-bottom:5px;}
        .login_boder{ background-color :white;no-repeat;overflow:hidden;height:400px;border-radius:5px;}
        .login_padding{ padding:8px 47px 40px 47px ;}
        .login_boder h2{ color:#4f5d80; text-transform:uppercase; font-size:12px; font-weight:normal; margin-bottom:11px;}
        .forget_model_h2{color:#4f5d80; font-size:12px; font-weight:normal; margin-bottom:11px;}

        .login_boder input.txt_input{ width:295px; height:36px; border:1px solid #cad2db; background:url(../images/txt_input_bg.gif) no-repeat;  padding:0 5px; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; line-height:36px; margin-bottom:10px; font-size:14px; color:#717171; font-family:Arial;}
        .login_boder input.txt_input2{ margin-bottom:20px;}
        .login_boder input.txt_input:focus{ transition:border linear .2s,box-shadow linear .2s; -moz-transition:border linear .2s,-moz-box-shadow linear .2s; -webkit-transition:border linear .2s,-webkit-box-shadow linear .2s; outline:none;border-color:rgba(173,173,173.75); box-shadow:0 0 8px rgba(173,173,173,.5); -moz-box-shadow:0 0 8px rgba(173,173,173,.5); -webkit-box-shadow:0 0 8px rgba(173,173,173,3); border:1px solid #6192c8;}
        .login_boder p.forgot{ font-size:11px;  text-align:right; margin-bottom:15px;}
        .login_boder p.forgot a,.login_boder p.forgot a:visited{color:#8c8e91;}
        .login_boder p.forgot a:hover{color:#206fd5;}
        .rem_sub input.sub_button{  width:300px; height:40px; background-color:#ffcc00;border:none; color:#FFF; padding-bottom:2px; font-size:14px; font-weight:bold;border-radius:10px;}

        .rem_sub input.sub_buttons{ float:left; width:122px;  height:32px; background:url(../images/site_bg.png) no-repeat -153px -850px; border:none; color:#FFF; padding-bottom:2px; font-size:14px; font-weight:bold;}
        .rem_sub input.sub_buttons:hover{ background-position:-153px -882px; cursor:pointer;}

        .rem_sub input.sub_button:hover{ background-position:-153px -882px; cursor:pointer;}
        .rem_sub .rem_sub_l{ float:left; font-size:12px; height:33px; line-height:33px;}
        .rem_sub input#checkbox{ margin-right:5px; vertical-align:middle;}
    </style>




</head>

<body class="login">

<div class="login_m">
    <div class="login_boder">
        <div class="login_logo"><img src="../img/logo1.png" width="100" height="100"></div>
        <form class="form-horizontal" action="{{ url('auth/adminlogin') }}" method="POST">
            {{csrf_field()}}
            <div class="login_padding">
                <h2>用户名</h2>
                <label>
                    <input type="text" id="username" class="txt_input txt_input2" name="username" onfocus="if (value ==&#39;Your name&#39;){value =&#39;&#39;}" onblur="if (value ==&#39;&#39;){value=&#39;Your name&#39;}" value="Your name">
                </label>
                <h2>密码</h2>
                <label>
                    <input type="password" name="password" id="password" class="txt_input" onfocus="if (value ==&#39;******&#39;){value =&#39;&#39;}" onblur="if (value ==&#39;&#39;){value=&#39;******&#39;}" value="******">
                </label>
                <p class="forgot"><a href="javascript:void(0);">忘记密码?</a></p>
                <div class="rem_sub">

                    <label>
                        <input type="submit" class="sub_button" name="button" id="button" value="登录" style="opacity: 0.7;">
                    </label>
                </div>
            </div>
        </form>
    </div><!--login_boder end-->
</div><!--login_m end-->

<br />
<br />

<p align="center"> 社区生活管理系统 <a href="http://h2design.taobao.com/" target="_blank" title="氢设计"></a></p>

</body>
</html>