<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/ProjectDelivery/Public/Doc/css/login.css">
</head>

<body>
    <!-- 最外层框 -->
    <div class="con">
        <!-- 左边背景图 -->
        <img src="/ProjectDelivery/Public/Doc/images/ct.jpg" alt="">
        <!-- 右边输入内容 -->
        <div class="login">
            <form>
                <img src="/ProjectDelivery/Public/Doc/images/logo.png" alt="">
                <p>账号</p>
                <input type="text" id="name">
                <p>密码</p>
                <input type="password" id="pass"><br>
                <button id="login" type="button">登录</button>
            </form>
            <div>2018 © 德拓南京交付体系出品</div>
        </div>
    </div>
</body>
<script src="/ProjectDelivery/Public/static/jquery-2.0.3.min.js"></script>
<script src="/ProjectDelivery/Public/Doc/doclay/plugins/layui/layui.js"></script>
<script>
    var login = document.getElementById('login');

    // 设置cookie
    function setCookie(c_name,value,expireseconds){
        var exdate=new Date();
        exdate.setTime(exdate.getTime()+expireseconds * 1000);
        document.cookie=c_name+ "=" +escape(value)+
        ((expireseconds==null) ? "" : ";expires="+exdate.toGMTString())
    }

    // 设置cookie
    function setCookie(key, value, iDay) {
        var oDate = new Date();
        oDate.setDate(oDate.getDate() + iDay);
        document.cookie = key + '=' + value + ';expires=' + oDate;

    }

    login.onclick = function() {
        var name = $('#name').val();
        var pass = $('#pass').val();

        if(name == '' || pass == '') {
            layui.use('layer', function() {
                layui.layer.alert('名称或描述不能为空!');
            })

            return false;
        }
    
        $.ajax({
            cache: false,
            type: "POST",
            url: "<?php echo U('Feedback/loginn');?>",
            dataType: "json",
            data: {
                name: name,
                password: pass
            },
            success: function(data) {
                if(data.code == 1) {
                    layui.use('layer', function() {
                        layui.layer.alert('用户不存在!');
                    })
                } else if(data.code == 2) {
                    layui.use('layer', function() {
                        layui.layer.alert('密码错误!');
                    })
                } else {
                    setCookie("isLogin", data.data[0].id, 3600 * 24);
                    window.location.href = "http://localhost/ProjectDelivery/index.php";
                }
            },
            fail: function(data) {
                
            }
        });
    }
</script>
</html>