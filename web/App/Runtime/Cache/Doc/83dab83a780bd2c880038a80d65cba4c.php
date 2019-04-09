<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Tea Party</title>
    <link rel="stylesheet" href="/Public/Doc/doclay/plugins/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/Public/Doc/doclay/build/css/app.css" media="all">
    <link rel="stylesheet" href="/Public/Doc/css/custom.css">
    <script src="/Public/static/jquery-2.0.3.min.js"></script>
    <script src="/Public/Doc/doclay/plugins/layui/layui.js"></script>
</head>
<style>

.layui-logo img{
width: 80%;
}
</style>
<body>
     <div class="layui-layout layui-layout-admin kit-layout-admin">
        <div class="layui-header">
            <div class="layui-logo"><img src="/Public/Doc/images/logo@2x.png" alt=""></div>
            <!-- <div class="layui-logo kit-logo-mobile">K</div> -->
            <div class="layui-col-md-offset2">
                <ul class="layui-nav layui-col-md10" lay-filter="">
                    <li class="layui-nav-item">
                        <a href="#"><cite>体系综合</cite></a>
                    </li>
                    <li class="layui-nav-item">
                        <a href="<?php echo U('ProjectManagement/index');?>">项目管理</a>
                    </li>
                    <li class="layui-nav-item">
                        <a  href="#">个人管理</a>
                    </li>
                    
                    <li class="layui-nav-item">
                        <a href="<?php echo U('feedback/index');?>">问题反馈</a>
                    </li>
                    </a>
                     
                    <li class="layui-nav-item">
                        <a href="<?php echo U('KnowledgeSharing/index');?>">知识共享</a>
                    </li>
                   
                    <li class="layui-nav-item">
                        <a  href="#">共同成长</a>
                    </li>
                    <li class="layui-nav-item layui-this">
                        <a  href="<?php echo U('BackstageManagement/index');?>">后台管理</a>
                    </li>
                </ul>
            </div>

            <ul class="layui-nav layui-layout-right kit-nav">
                <li class="layui-nav-item">
                <a href=" ">
                <img src="/Public/Doc/images/a.jpg" class="layui-nav-img"><span id="user-name">Yukari</span>
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;">基本资料</a></dd>
                    <dd><a class="newPsd" href="javascript:;">修改密码</a></dd>
                    <dd><a href="javascript:;" id="exitlogin">安全退出</a></dd>
                </dl>
                </li>
                <li class="layui-nav-item"><a href="javascript:;"><i class="fa fa-sign-out" aria-hidden="true"></i>  </a></li>
            </ul>
        </div>
        <div class="layui-side layui-bg-black kit-side">
            <div class="layui-side-scroll">
                <div class="kit-side-fold"><img src="/Public/Doc/images/切换@2x.png" alt=""></div>
                <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
                <!-- 标志 点赞 &#xe6c6 重要 &#xe658;-->
                <ul class="layui-nav layui-nav-tree" lay-filter="kitNavbar" kit-navbar>
                    <!--默认展开 layui-nav-itemed-->




                    <li class="layui-nav-item">
                        <a class="" href="javascript:;"><img class="cus-nav-icon" src="/Public/Doc/images/2@2x.png" alt=""><span>问题反馈配置</span></a>
                        <dl class="layui-nav-child">
                            <dd>
                                 <a href="javascript:;" kit-target data-options="{url:'<?php echo U('BackstageManagement/productsconfig');?>',icon:'',title:'产品配置',id:'1'}">
                                 <img class="cus-nav-icon" src="/Public/Doc/images/3@2x.png" alt="">
                                 <span>产品配置</span>
                                 </a>
                            </dd>
                            <dd>
                               <a href="javascript:;" kit-target data-options="{url:'<?php echo U('BackstageManagement/problemconfig');?>',icon:'',title:'问题分类配置',id:'2'}">
                                <img class="cus-nav-icon" src="/Public/Doc/images/4@2x.png" alt="">
                                <span>问题分类配置</span>
                                </a>
                            </dd>

                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a class="" href="javascript:;"><img class="cus-nav-icon" src="/Public/Doc/images/2@2x.png" alt=""><span>管理配置</span></a>
                        <dl class="layui-nav-child">
                            <dd>
                                 <a href="javascript:;" kit-target data-options="{url:'<?php echo U('BackstageManagement/ProjectConfig');?>',icon:'',title:'项目所属行业配置',id:'3'}">
                                    <img class="cus-nav-icon" src="/Public/Doc/images/3@2x.png" alt="">
                                    <span>所属行业配置</span>
                                 </a>
                            </dd>
                            <dd>
                               <a href="javascript:;" kit-target data-options="{url:'<?php echo U('BackstageManagement/ProjectRole');?>',icon:'',title:'项目角色配置',id:'4'}">
                                    <img class="cus-nav-icon" src="/Public/Doc/images/4@2x.png" alt="">
                                    <span>角色配置</span>
                                </a>
                            </dd>
                            <dd>
                               <a href="javascript:;" kit-target data-options="{url:'<?php echo U('BackstageManagement/ProjectStatus');?>',icon:'',title:'项目所处状态',id:'5'}">
                                    <img class="cus-nav-icon" src="/Public/Doc/images/4@2x.png" alt="">
                                    <span>所处状态</span>
                                </a>
                            </dd>
                            <dd>
                               <a href="javascript:;" kit-target data-options="{url:'<?php echo U('BackstageManagement/ProjectEvent');?>',icon:'',title:'项目事件分类配置',id:'6'}">
                                    <img class="cus-nav-icon" src="/Public/Doc/images/4@2x.png" alt="">
                                    <span>事件分类配置</span>
                                </a>
                            </dd>

                        </dl>
                    </li>

                    

                   
                   
                </ul>
            </div>
        </div>
        <!-- 修改密码弹出层  -->
        <div class="layui-row" id="changePassword" style="display: none;padding-top: 70px;padding-left:20px;height: 100%">
            <div class="layui-col-md10" style="height: 100%;">
                <form  class="layui-form left_form">
                    <div class="layui-form-item" style="margin-bottom: 30px;">
                        <label class="layui-form-label" style="width: 110px;">原密码:</label>
                        <div class="layui-input-block">
                            <input type="password" name="oldPwd" lay-verify="required" autocomplete="off" placeholder="请输入原密码" class="layui-input input">
                        </div>
                    </div>
                    <div class="layui-form-item" style="margin-bottom: 30px;">
                         <label class="layui-form-label" style="width: 110px;">新密码:</label>
                         <div class="layui-input-block">
                           <input type="password" name="newPwd" lay-verify="required" autocomplete="off" placeholder="请输入新密码" class="layui-input input">
                         </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 110px;">确认新密码:</label>
                        <div class="layui-input-block">
                            <input type="password" name="newPwdSub" lay-verify="required" autocomplete="off" placeholder="请再次输入新密码" class="layui-input input">
                        </div>
                    </div>
                    <div class="bottom_btn layui-form-item" style="margin-top: 80px;">
                        <button type="button" style="float: right;" class="layui-btn layui-btn-primary layui-btn-radius">取消</button>
                        <button class="layui-btn layui-btn layui-btn-radius plan-true" lay-submit="" lay-filter="demo1" style="float: right;margin-right: 10px;">提交</button>
                    </div>
                </form>
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

        // var message;
        var message,layer,form;
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
        layui.use(['layer','form'], function(){
            layer = layui.layer;
            form = layui.form,
            // 修改密码
            $('.newPsd').on('click',function(){
                layer.open({
                        type: 1,
                        title: '修改密码',
                        closeBtn: 2,   // 关闭样式
                        shadeClose: true,  // 关闭方式
                        anim:5,    // 弹出样式
                        area: ['36vw', '70vh'],
                        // btn:['确定','取消'],
                        isOutAnim:false,    // 关闭动画
                        content: $('#changePassword'),
                })								
            });
            form.on('submit(demo1)', function(data){
                var {oldPwd, newPwd, newPwdSub} = data.field;
                if(newPwd != newPwdSub){
                    layer.alert('修改密码不一致',{time: 3000});
                    $('.left_form').find('input').val("");
                    return false;
                }
                if(oldPwd == newPwd){
                    layer.alert('新密码不能与原密码相同',{time: 3000});
                    $('.left_form').find('input').val("");
                    return false;
                }
                var uid = window.sessionStorage.getItem('isLogin');
                $.ajax({
                    url:"<?php echo U('login/updpass');?>",
                    type: 'post',
                    data: {
                        uid: uid,//用户ID
                        oldPass: oldPwd,//原密码
                        newPass: newPwd,//新密码
                        repeatPass: newPwdSub//重复密码
                    },
                    dataType: 'json',
                    success: function(res) {
                        var {code, data, errmsg} = res;
                        if(code == 200){
                            layer.alert("修改密码成功",{time: 3000});
                            setTimeout(function(){
                                layer.closeAll();
                            },3000)
                        }else if(code == 2){
                            layer.alert(data,{time: 3000});
                            $('.left_form').find('input').val("");
                        }
                    },
                    error: function(err){
                        console.error(err)
                    }
                });
                return false;
            });
        });
        $("#cancelPsdModal").on('click',function(){
            layer.close(layer.index);
        })
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
                $('.kit-side-fold img').attr('src', '/Public/Doc/images/切换2@2x.png');
            } else {
                $('.kit-side-fold img').attr('src', '/Public/Doc/images/切换@2x.png');
            }
        })

    })
</script>
</body>

</html>