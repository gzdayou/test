
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title></title>
    <link href="<?php echo ADMIN_SITE_URL;?>/resource/css/login.css" rel="stylesheet" />
    <script src="<?php echo ADMIN_SITE_URL;?>/resource/js/jquery.min.js"></script>
    <script src="<?php echo ADMIN_SITE_URL;?>/resource/js/jquery.particleground.min.js"></script>

</head>

<body>
<h1 style="width:100%; top:30%; position: absolute; margin: 0 auto; z-index: 100; text-align: center; font-size: 36px;">综合能源管理系统</h1>
<div id="particles" class="warp">
    <div class="intro">

        <div class="detail">
            <form id="f1">
                <input type="text" id="loginname" name="user_name" class="account" placeholder="请输入账号" />
                <input type="password" id="password" name="password" class="pwd" placeholder="请输入密码 " />
                <input type="text" id="vcode" name="captcha" class="code" placeholder="验证码 " />
                <img src="index.php?act=seccode&op=verify" title="看不清？点我换一张" class="codeImg" id="codeimage" onclick="reImg();" >
                <!-- <input type="checkbox" id="reb" name="reb" class="remBtn" /><label class="remWord" for="reb">记住密码</label> -->
            </form>
            <button id="btn_login" class="loginBtn">登&nbsp;&nbsp;录</button>
        </div>
    </div>
</div>


<script src="<?php echo ADMIN_SITE_URL;?>/resource/js/demo.js"></script>
<script type="text/javascript">
    //var msgBox = new MsgBox({ imghref: "/img/" });

    function reImg(){
        var img = document.getElementById("codeimage");
        img.src = "index.php?act=seccode&op=verify&rnd=" + Math.random();
    }

    $(function () {

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
            if ($('#vcode').val().length == 0) {
                alert("密码不能为空！");
                return false;
            }
            //验证登录
            $.post("index.php?act=login&op=login", $('#f1').serialize(), function (data) {
                if (data.code == 1000) {
                    window.location.href = "index.php";
                } else {
                    alert( data.msg );
                    reImg();
                    $("#vcode").val("");
                    return false;
                }
            }, "json");
        });

    });

    window.onresize = function () {
        $('.intro').css({
            'margin-top': -($('.intro').height() / 2),
            'margin-left': -($('.intro').width() / 2)
        });
    };
</script>
</body>

</html>