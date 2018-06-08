
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>用户登录</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="网站关键词">
    <meta name="Description" content="网站介绍">
    <link rel="stylesheet" href="<?php echo ADMIN_SITE_URL;?>/resource/login/css/base.css">
    <link rel="stylesheet" href="<?php echo ADMIN_SITE_URL;?>/resource/login/css/iconfont.css">
    <link rel="stylesheet" href="<?php echo ADMIN_SITE_URL;?>/resource/login/css/reg.css">
    <link rel="stylesheet" href="<?php echo ADMIN_SITE_URL;?>/resource/login/css/slide-unlock.css">
</head>
<body>
<div id="ajax-hook"></div>
<div class="wrap">
    
    <div class="wpn">
        
        <div class="form-data pos">
            <div class="logo_box"><img src="<?php echo ADMIN_SITE_URL;?>/resource/login/CO_Logo.png" style=""></div>
            <div class="change-login" style="color: #23158f; font-size: 26px; font-weight: bold; text-align:center;">
                冷热源智能节能管理系统
            </div>
            
            <div class="form1">
                <p class="p-input pos">
                    <label for="num">用户名</label>
                    <input type="text" id="loginname" value="">
                    <span class="tel-warn num-err hide"><em>账号或密码错误，请重新输入</em><i class="icon-warn"></i></span>
                </p>
                <p class="p-input pos">
                    <label for="pass">请输入密码</label>
                    <input type="password" id="password" >
                    <span class="tel-warn pass-err hide"><em>账号或密码错误，请重新输入</em><i class="icon-warn"></i></span>
                </p>
                <p class="p-input pos code hide">
                    <input type="hidden" id="_csrf" name="_csrf" value="<?php echo $output['_csrf'];?>" >
                </p>
                
                <!-- <div id="slider">
                    <div id="slider_bg" style="width: 0px;"></div>
                    <span id="label" style="left: 0px;">&gt;&gt;</span> <span id="labelTip">拖动滑块验证</span>
                </div> -->
                
            </div>
            <button class="lang-btn off log-btn" id="btn_login" >登录</button>
            <div class="third-party">
                
            </div>

            <p class="right">Powered by © 2018</p>
        </div>
    </div>
</div>
<script src="<?php echo ADMIN_SITE_URL;?>/resource/login/js/jquery.js"></script>
<script src="<?php echo ADMIN_SITE_URL;?>/resource/login/js/agree.js"></script>
<script src="<?php echo ADMIN_SITE_URL;?>/resource/login/js/login.js"></script>
<script src="<?php echo ADMIN_SITE_URL;?>/resource/login/js/jquery.slideunlock.js"></script>
<script type="text/javascript">
    //$('#drag').drag();

    $(function () {

        // var slider = new SliderUnlock("#slider",{
        //         successLabelTip : "验证通过"	
        //     },function(){
                
        //     });
        // slider.init();

        //登录按钮
        $('#btn_login').click(function () {
            //验证输入
            if ($('#loginname').val().length == 0)
            {
                alert("登录名不能为空！");
                return false;
            }
            if ($('#password').val().length == 0) {
                alert("密码不能为空！");
                return false;
            }
            // if ($("#labelTip").html() != '验证通过') {
            //     alert("请拖动滑块完成验证！");
            //     return false;
            // }
            //验证登录
            $.post("index.php?act=login&op=login", {user_name:$('#loginname').val(), password:$('#password').val(), _csrf:$('#_csrf').val()}, function (data) {
                if (data.code == 1000) {
                    window.location.href = "index.php";
                } else {
                    alert( data.msg );
                    window.location.reload();
                    return false;
                }
            }, "json");
        });

    });
</script>
</body>
</html>