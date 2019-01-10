<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Tea Party</title>
    <link rel="stylesheet" href="/ProjectDelivery-master-4813cb78043ea21dbdcdbe7580c4f61a014acdb6/web/Public/Doc/doclay/plugins/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/ProjectDelivery-master-4813cb78043ea21dbdcdbe7580c4f61a014acdb6/web/Public/Doc/doclay/build/css/app.css" media="all">
    <link rel="stylesheet" href="/ProjectDelivery-master-4813cb78043ea21dbdcdbe7580c4f61a014acdb6/web/Public/Doc/css/custom.css">
    <script src="/ProjectDelivery-master-4813cb78043ea21dbdcdbe7580c4f61a014acdb6/web/Public/static/jquery-2.0.3.min.js"></script>
    <script src="/ProjectDelivery-master-4813cb78043ea21dbdcdbe7580c4f61a014acdb6/web/Public/Doc/doclay/plugins/layui/layui.js"></script>
</head>
<style>

.layui-logo img{
width: 80%;
}
</style>
<body>
     <div class="layui-layout layui-layout-admin kit-layout-admin">
        <div class="layui-header">
            <div class="layui-logo"><img src="/ProjectDelivery-master-4813cb78043ea21dbdcdbe7580c4f61a014acdb6/web/Public/Doc/images/logo@2x.png" alt=""></div>
            <!-- <div class="layui-logo kit-logo-mobile">K</div> -->
            <div class="layui-col-md-offset2">
                <ul class="layui-nav layui-col-md10" lay-filter="">
                    <li class="layui-nav-item">
                        <a  href="#"><cite>体系综合</cite></a>
                    </li>
                    <li class="layui-nav-item">
                        <a  href="<?php echo U('ProjectManagement/index');?>">项目管理</a>
                    </li>
                    <li class="layui-nav-item">
                        <a  href="#">个人管理</a>
                    </li>
                    
                    <li class="layui-nav-item layui-this">
                        <a href="<?php echo U('Feedback/index');?>">问题反馈</a>
                    </li>
                    </a>
                     
                    <li class="layui-nav-item">
                        <a href="<?php echo U('KnowledgeSharing/index');?>">知识共享</a>
                    </li>
                   
                    <li class="layui-nav-item">
                        <a  href="#">共同成长</a>
                    </li>
                    <li class="layui-nav-item">
                        <a href="<?php echo U('BackstageManagement/index');?>">后台管理</a>
                    </li>
                </ul>
            </div>

            <ul class="layui-nav layui-layout-right kit-nav">
                <li class="layui-nav-item">
                <a href=" ">
                <img src="/ProjectDelivery-master-4813cb78043ea21dbdcdbe7580c4f61a014acdb6/web/Public/Doc/images/a.jpg" class="layui-nav-img"><span id="user-name">Yukari</span>
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
                <div class="kit-side-fold"><img src="/ProjectDelivery-master-4813cb78043ea21dbdcdbe7580c4f61a014acdb6/web/Public/Doc/images/切换@2x.png" alt=""></div>
                <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
                <!-- 标志 点赞 &#xe6c6 重要 &#xe658;-->
                <ul class="layui-nav layui-nav-tree" lay-filter="kitNavbar" kit-navbar>
                    <!--默认展开 layui-nav-itemed-->
                    <li class="layui-nav-item">
                        <!-- <a class="" href="javascript:;"><i class="layui-icon layui-icon-set" aria-hidden="true"></i><span>产品使用</span></a> -->
                        <a class="" href="javascript:;"><img class="cus-nav-icon" src="/ProjectDelivery-master-4813cb78043ea21dbdcdbe7580c4f61a014acdb6/web/Public/Doc/images/2@2x.png" alt=""><span>产品使用</span></a>
                        <dl class="layui-nav-child">
                            <dd>
                               <a href="javascript:;" kit-target data-options="{url:'<?php echo U('Feedback/ComprehensiveAnalysis');?>',icon:'',title:'综合分析',id:'3'}"><img class="cus-nav-icon" src="/ProjectDelivery-master-4813cb78043ea21dbdcdbe7580c4f61a014acdb6/web/Public/Doc/images/2@2x.png" alt=""><span>综合分析</span>
                                </a>
                            </dd>
                            <dd>
                               <a href="javascript:;" kit-target data-options="{url:'<?php echo U('Feedback/MyFeedback');?>',icon:'',title:'我的反馈',id:'2'}"><img class="cus-nav-icon" src="/ProjectDelivery-master-4813cb78043ea21dbdcdbe7580c4f61a014acdb6/web/Public/Doc/images/3@2x.png" alt=""><span>我的反馈</span>
                                </a>
                            </dd>
                            <dd>
                                 <a href="javascript:;" kit-target data-options="{url:'<?php echo U('Feedback/ProductChoice');?>',icon:'',title:'提交反馈',id:'1'}"><img class="cus-nav-icon" src="/ProjectDelivery-master-4813cb78043ea21dbdcdbe7580c4f61a014acdb6/web/Public/Doc/images/4@2x.png" alt=""><span>提交反馈</span>
                                 </a>
                            </dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a class="" href="javascript:;"><img class="cus-nav-icon" src="/ProjectDelivery-master-4813cb78043ea21dbdcdbe7580c4f61a014acdb6/web/Public/Doc/images/2@2x.png" alt=""><span>技术疑难</span></a>
                    </li>
                     <li class="layui-nav-item">
                        <a class="" href="javascript:;"><img class="cus-nav-icon" src="/ProjectDelivery-master-4813cb78043ea21dbdcdbe7580c4f61a014acdb6/web/Public/Doc/images/2@2x.png" alt=""><span>平台优化</span></a>
                    </li>
                     <li class="layui-nav-item">
                        <a class="" href="javascript:;"><img class="cus-nav-icon" src="/ProjectDelivery-master-4813cb78043ea21dbdcdbe7580c4f61a014acdb6/web/Public/Doc/images/2@2x.png" alt=""><span>体系信箱</span></a>
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
                        url: "<?php echo U('Login/logout');?>",
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

        // 左侧菜单栏切换图标
        $('.layui-side').on('click', '.kit-side-fold, .kit-side-fold img', function() {
            var lis = $('.layui-nav-tree').find('li.kit-side-folded');
            if(lis.length > 0) {
                $('.kit-side-fold img').attr('src', '/ProjectDelivery-master-4813cb78043ea21dbdcdbe7580c4f61a014acdb6/web/Public/Doc/images/切换2@2x.png');
            } else {
                $('.kit-side-fold img').attr('src', '/ProjectDelivery-master-4813cb78043ea21dbdcdbe7580c4f61a014acdb6/web/Public/Doc/images/切换@2x.png');
            }
        })
    })
</script>
</body>

</html>