<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Tea Party</title>
    <link rel="stylesheet" href="/ProjectDelivery/Public/Doc/doclay/plugins/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/ProjectDelivery/Public/Doc/doclay/build/css/app.css" media="all">
    <script src="/ProjectDelivery/Public/Doc/doclay/plugins/layui/layui.js"></script>
</head>

<body>
    <div class="layui-layout layui-layout-admin kit-layout-admin">
        <div class="layui-header">
            <div class="layui-logo">Tea Party</div>
            <div class="layui-logo kit-logo-mobile">K</div>
            <ul class="layui-nav layui-layout-left kit-nav">
                <li class="layui-nav-item"><a href="https://www.baidu.com/">其他模块</a></li>
                <li class="layui-nav-item">
                    <a href="javascript:;">其它模块</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;">xx管理</a></dd>
                        <dd><a href="javascript:;">yy管理</a></dd>
                        <dd><a href="javascript:;">zz管理</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item"><a style="background-color: #009688;" href="javascript:;"> 文档模块</a></li>
            </ul>
            <ul class="layui-nav layui-layout-right kit-nav">
                <li class="layui-nav-item">
                <a href=" ">
                <img src="http://m.zhengjinfan.cn/images/0.jpg" class="layui-nav-img">Yukari
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;">基本资料</a></dd>
                    <dd><a href="javascript:;">修改密码</a></dd>
                    <dd><a href="javascript:;">安全退出</a></dd>
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
                        <a class="" href="javascript:;"><i class="fa fa-plug" aria-hidden="true"></i><span>流程规范</span></a>
                    </li>
                    <li class="layui-nav-item">
                        <a class="" href="javascript:;"><i class="fa fa-plug" aria-hidden="true"></i><span>开发规范</span></a>
                        <dl class="layui-nav-child">
                            <dd>
                                <a href="javascript:;" kit-target data-options="{url:'Mdhtml/HtmlStandard.html',icon:'&#xe658;',title:'前端规范',id:'HtmlStandard'}"><i class="layui-icon">&#xe658;</i><span>前端规范</span></a>
                            </dd>
                            <dd>
                                <a href="javascript:;" kit-target data-options="{url:'Mdhtml/PHPStandard.html',icon:'&#xe658;',title:'PHP规范',id:'PHPStandard'}"><i class="layui-icon">&#xe658;</i><span>PHP规范</span></a>
                            </dd>
                            <dd>
                                <a href="javascript:;" kit-target data-options="{url:'Mdhtml/database.html',icon:'&#xe658;',title:'数据库规范',id:'database'}"><i class="layui-icon">&#xe658;</i><span>数据库规范</span></a>
                            </dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a class="" href="javascript:;"><i class="fa fa-plug" aria-hidden="true"></i><span>环境搭建</span></a>
                        <dl class="layui-nav-child">
                            <dd>
                                <a href="javascript:;" kit-target data-options="{url:'Mdhtml/MarkdownPadInstall.html',icon:'&#xe658;',title:'Markdown安装配置',id:'MarkdownPadInstall'}"><i class="layui-icon">&#xe658;</i><span> Markdown安装配置</span></a>
                            </dd>
                            <dd>
                                <a href="javascript:;" kit-target data-options="{url:'Mdhtml/PsConf.html',icon:'&#xe658;',title:'Ps安装配置',id:'PsConf'}"><i class="layui-icon">&#xe658;</i><span> Ps安装配置</span></a>
                            </dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a class="" href="javascript:;"><i class="fa fa-plug" aria-hidden="true"></i><span>使用教程</span></a>
                        <dl class="layui-nav-child">

                            <dd>
                                <a href="javascript:;" kit-target data-options="{url:'Mdhtml/MarkdownPadUse.html',icon:'',title:'基本使用',id:'2'}"><span> Markdown基本使用</span></a>
                            </dd>
                            <dd>
                                <a href="javascript:;" kit-target data-options="{url:'Mdhtml/companyPHP.html',icon:'&#xe658;',title:'公司PHP框架简介',id:'6'}"><i class="layui-icon">&#xe658;</i><span>公司PHP框架简介</span></a>
                            </dd>
                            <dd>
                                <a href="javascript:;" kit-target data-options="{url:'one.html',icon:'&#xe658;',title:'kettle使用简介',id:'7'}"><i class="layui-icon">&#xe658;</i><span>kettle使用简介</span></a>
                            </dd>
                            <dd>
                                <a href="javascript:;" kit-target data-options="{url:'one.html',icon:'',title:'RAP使用简介',id:'8'}"><span>RAP使用简介</span></a>
                            </dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a class="" href="javascript:;"><i class="fa fa-plug" aria-hidden="true"></i><span>知识分享</span></a>
                        <dl class="layui-nav-child">
                            <dd>
                                <a href="javascript:;" kit-target data-options="{url:'one.html',icon:'&#xe658;',title:'机器学习入门',id:'9'}"><i class="layui-icon">&#xe658;</i><span>机器学习入门</span></a>
                            </dd>
                            <dd>
                                <a href="javascript:;" kit-target data-options="{url:'one.html',icon:'',title:'聚类算法',id:'10'}"><span>聚类算法</span></a>
                            </dd>
                            <dd>
                                <a href="javascript:;" kit-target data-options="{url:'Mdhtml/submit2.html',icon:'',title:'回归算法',id:'11'}"><span>回归算法</span></a>
                            </dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;" kit-target data-options="{url:'<?php echo U('feedback/submit2');?>',icon:'',title:'回归算法',id:'12'}"><span>回归算法</span></a>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;" kit-target data-options="{url:'Mdhtml/submit3.html',icon:'',title:'回归',id:'13'}"><span>回归</span></a>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;" kit-target data-options="{url:'<?php echo U('feedback/products');?>',icon:'',title:'产品配置',id:'14'}"><span>产品配置</span></a>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;" kit-target data-options="{url:'<?php echo U('feedback/config');?>',icon:'',title:'问题反馈配置',id:'15'}"><span>问题反馈配置</span></a>
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
    </script>
</body>

</html>