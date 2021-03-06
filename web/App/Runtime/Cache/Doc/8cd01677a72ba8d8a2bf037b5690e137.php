<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Tea Party</title>
    <link rel="stylesheet" href="/Public/Doc/doclay/plugins/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/Public/Doc/doclay/build/css/app.css" media="all">
    <script src="/Public/static/jquery-2.0.3.min.js"></script>
    <script src="/Public/Doc/doclay/plugins/layui/layui.js"></script>
</head>

<body>
    <div class="layui-layout layui-layout-admin kit-layout-admin">
        <div class="layui-header">
            <div class="layui-logo">德拓交付应用系统</div>
            <div class="layui-logo kit-logo-mobile">K</div>
        
            <!-- <ul class="layui-nav layui-layout-right kit-nav">
                <li class="layui-nav-item">
                <a href=" ">
                <img src="http://m.zhengjinfan.cn/images/0.jpg" class="layui-nav-img">系统管理员
                </a>
               
                </li>
                <li class="layui-nav-item"><a href="javascript:;"><i class="fa fa-sign-out" aria-hidden="true"></i>  </a></li>
            </ul> -->

            <ul class="layui-nav layui-layout-right kit-nav">
                <li class="layui-nav-item">
                <a href=" ">
                <img src="http://m.zhengjinfan.cn/images/0.jpg" class="layui-nav-img"><span id="user-name">Yukari</span>
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;">基本资料</a></dd>
                    <dd><a href="javascript:;">修改密码</a></dd>
                    <dd><a href="javascript:;" id="exitlogin">安全退出</a></dd>
                </dl>
                </li>
                <li class="layui-nav-item"><a href="javascript:;"><i class="fa fa-sign-out" aria-hidden="true"></i>  </a></li>
            </ul>
        </div>
        <div class="layui-side layui-bg-black kit-side">
            <div class="layui-side-scroll">
                <div class="kit-side-fold"><i class="fa fa-navicon" aria-hidden="true">展开/关闭</i></div>
                <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
                <!-- 标志 点赞 &#xe6c6 重要 &#xe658;-->
                <ul class="layui-nav layui-nav-tree" lay-filter="kitNavbar" kit-navbar>
                    <!--默认展开 layui-nav-itemed-->

                      <li class="layui-nav-item">
                        <a href="javascript:;" kit-target data-options="{url:'<?php echo U('feedback/productuse');?>',icon:'',title:'产品使用',id:'1'}">
                            <span>产品使用</span>
                        </a>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;" kit-target data-options="{url:'<?php echo U('feedback/submitfeedback');?>',icon:'',title:'提交反馈',id:'2'}">
                            <span>提交反馈</span>
                        </a>
                    </li>
                    

                    <li class="layui-nav-item">
                        <a href="javascript:;" kit-target data-options="{url:'<?php echo U('feedback/submit2');?>',icon:'',title:'我的反馈',id:'3'}"><span>我的反馈</span></a>
                    </li>

                   

                    <li class="layui-nav-item">
                        <a href="javascript:;" kit-target data-options="{url:'<?php echo U('feedback/products');?>',icon:'',title:'产品配置',id:'4'}"><span>产品配置</span></a>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;" kit-target data-options="{url:'<?php echo U('feedback/config');?>',icon:'',title:'问题反馈配置',id:'5'}"><span>问题反馈配置</span></a>
                    </li>

                   
                </ul>
            </div>
        </div>
        <div class="layui-body" id="container">
            <!-- 内容主体区域 -->
            <div style="padding: 15px;">主体内容加载中,请稍等...</div>
        </div>
    </div>

   <script>
    $(document).ready(function() {
        // 登录状态验证
        if(!window.sessionStorage["isLogin"]) {
            window.location.href = "<?php echo U('Login/index');?>";
        }

        $('#user-name').html(window.sessionStorage.getItem('name'));

        var message;
        layui.config({
            base: 'Public/Doc/doclay/build/js/'
        }).use(['app', 'message'], function () {
            var app = layui.app,
                $ = layui.jquery,
                layer = layui.layer;
            //将message设置为全局以便子页面调用
            message = layui.message;
            //主入口
            app.set({
                type: 'iframe'
            }).init();
        });

        $('#exitlogin').on('click', function() {
            layui.use('layer', function() {
                layer.confirm('确定退出登录?', {title:'提示'}, function(index){
                    // 退出登录接口
                    $.ajax({
                        cache: false,
                        type: "POST",
                        url: "<?php echo U('Feedback/logout');?>",
                        dataType: "json",
                        data: {},
                        success: function(res) {
                            window.sessionStorage.removeItem("isLogin");
                            window.sessionStorage.removeItem("name");
                            layer.close(index);
                            window.location.href = "<?php echo U('Login/index');?>";
                        },
                        fail: function(err) {
                            console.log(err);
                        }
                    });
                });
            })
        })
    })
</script>
</body>

</html>