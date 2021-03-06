<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="icon.ico">
    <title>文档管理</title>
    <link rel="stylesheet" href="/Public/Doc/doclay/build/css/app.css" media="all">
    <!-- <link rel="stylesheet" href="/Public/Doc/doclay/plugins/layui/css/layui.css" media="all"> -->
    <link rel="stylesheet" href="/Public/Doc/css/document _m.css" media="all">
    <!-- <link rel="stylesheet" href="/Public/static/bootstrap.css" media="all"> -->

    <script src="/Public/static/jquery-2.0.3.min.js"></script>
    <script src="/Public/static/vue.min.js"></script>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous">
    <link rel="stylesheet" href="/Public/static/bootstrap-theme.min.css" media="all">
    <script src="/Public/static/bootstrap.min.js"></script>
    <style lang="">
        html,
        body {
            font: inherit;
            color: inherit;
            font-family: PingFangSC;
        }

        .cus-btn {
            padding: 4px 8px;
            border-radius: 4px;
            border: 1px solid rgba(7, 200, 141, 1);
            background: rgba(7, 200, 141, 1);
            font-size: 14px;
            font-family: PingFangSC-Regular;
            color: rgba(255, 255, 255, 1);
            cursor: pointer;
            margin-top: 10px;
        }

        .zhezhao {
            position: absolute;
            z-index: 1;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #000;
            opacity: 0.3;
        }

        .form {
            z-index: 10;
            width: 480px;
            /*height: 300px;*/
            padding-bottom: 40px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            position: fixed;
            box-shadow: 1px 1px 50px rgba(0, 0, 0, .3);
        }

        .form_title {
            padding: 0 80px 0 20px;
            height: 42px;
            line-height: 42px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
            font-family: PingFangSC-Regular;
            color: rgba(102, 102, 102, 1);
            overflow: hidden;
            background-color: #F8F8F8;
            border-radius: 2px 2px 0 0;
            position: relative;
            margin-bottom: 5px;
        }

        .XXX {
            position: absolute;
            right: 15px;
            cursor: pointer;
            font-size: 16px;
        }

        .l_form{
            margin-left: 3vw;
        }

        .l_label {
            display: inline-block;
            padding: 9px 10px;
            font-size: 14px;
            font-family: PingFangSC-Regular;
            color: rgba(102, 102, 102, 1);
            font-weight: bold;
            text-align: right;
        }

        .input_div {
            display: inline-block;
            position: relative;
        }

        .input_line {
            background: rgba(255, 255, 255, 1);
            border-radius: 4px;
            border: 1px solid rgba(217, 217, 217, 1);
            height: 30px;
            padding-left: 5px;
            font-size: 14px;
        }

        .wendang {
            position: relative;
        }

        /*        .wendang::after{
            content: '标签名请用逗号(,)隔开。';
            position: absolute;
            right:-133px;
            top: 3vh;
            font-size: 12px;
            color: red;
        }*/

        .choose_type {
            font-size: 12px;
            font-family: PingFangSC-Regular;
            color: rgba(0, 0, 0, 0.65);
        }

        .choose_type span {
            display: inline-block;
            width: 13px;
            height: 13px;
            border-radius: 50%;
            position: relative;
            top: .5vh;
            cursor: pointer;
            border: 1px solid #c2c2c2;
        }

        .choose_type .choose_yes {
            background: rgb(213, 213, 213);
        }

        .l_line {
            width: 100%;
            height: 1px;
            border: .5px solid rgba(151, 151, 151, .3);
            position: relative;
            top: 4vh;
        }

        .btn_bottom {
            position: relative;
            top: 3vh;
            text-align: right;
            padding-right: 2vw;
        }

        .des {
            display: inline-block;
            font-size: 14px;
            color: rgb(47, 141, 254);
            cursor: pointer;
            padding-left: 4vw;
        }
    </style>
</head>

<body>
    <div class="container-fluid" id="app">
        <div class="layui-row">
            <button type="button" @click="covers(1)" id="add-feed" class="cus-btn">新增</button>
        </div>
        <div class="list col-xs-8 col-sm-8 col-lg-8 col-md-8">
            排序
            <span @click="getList(0)" class="list_span color2">默认</span>
            <span @click="getList(1)" class="list_span">按更新时间</span>
            <span @click="getList(2)" class="list_span">按访问量</span>
        </div>
        <div class="input-group col-xs-4 col-sm-4 col-lg-4 col-md-4">
            <input type="text" class="form-control" placeholder="请输入内容进行检索" aria-label="Amount (to the nearest dollar)">
            <span class="input-group-addon">
                <span @click="getList(4)" class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </span>
        </div>
        <div class="line"></div>
        <div class="option col-md-12 back_color" v-for="item1 in datalist1">
            <!-- 置顶按钮 -->
            <button class="topping">置顶</button>
            <!-- 项目名称 -->
            <span class="poj_name">
                <a @click="jump(item1.id)">{{item1.name}}</a>
            </span>
            <!-- 项目标签 -->
            <button class="poj_label" v-for="val in iem1.keywords">{{val}}</button>
            <!-- 设置按钮 -->
            <div class="icon1">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </div>
            <div>
                <!-- 所属项目 -->
                <span class="fon_size">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&ensp;{{item1.author}}
                </span>
                <!-- 日期 -->
                <span class="fon_size">{{item1.submit_time}}</span>
                <!-- 阅读量 -->
                <span class="fon_size">阅读数：{{item1.read_number}}</span>
                <!-- 评论数 -->
                <span class="fon_size">评论数：{{item1.comment_number}}</span>
            </div>
        </div>
        <div class="option col-md-12" v-for="item2 in datalist2">
            <span class="poj_name">
                <a @click="jump(item2.id)">{{item2.name}}</a>
            </span>
            <button class="poj_label" v-for="val in item2.keywords">{{val}}</button>
            <div class="icon1">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </div>
            <div>
                <span class="fon_size">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&ensp;{{item2.author}}</span>
                <span class="fon_size">{{item2.submit_time}}</span>
                <span class="fon_size">阅读数：{{item2.read_number}}</span>
                <span class="fon_size">评论数：{{item2.comment_number}}</span>
            </div>
        </div>
        <!--遮罩-->
        <div class="zhezhao" @click="covers(0)" v-show="cover"></div>
        <!--form表单提交-->
        <div class="form" v-show="form">
            <form action="<?php echo U('KnowledgeSharing/addArticle');?>" method="POST" enctype="multipart/form-data">
                <div class="form_title">新增文档
                    <span @click="covers(0)" class="XXX">X</span>
                </div>
                <div class="l_form">
                    <label class="l_label">文件名称:</label>
                    <div class="input_div">
                        <input style="width:20vw;" class="input_line" type="text" name="feedName" required placeholder="请输入名称" />
                        <input style="width:10vw;opacity: 0;" class="input_line" :value="Uid" type="text" name="feedId" required placeholder="请输入名称"
                        />
                    </div>
                </div>
                <div class="l_form" id="wendang">
                    <label class="l_label">文档标签:</label>
                    <div class="input_div wendang" style="margin-right:3px;">
                        <input style="width:10vw;" id='product_bq' class="input_line bq_input" type="text" name="feedNames[]" required placeholder="请输入标签"
                        />
                    </div>

                </div>
                <p class="des">
                    <span id="add_bq">添加标签</span>&nbsp;
                    <span id="move_bq">删除标签</span>
                </p>

                <div class="l_form">
                    <label class="l_label">上传形式:</label>
                    <div class="input_div">
                        <p class="choose_type">
                            <span class="choose_yes"></span> html文档&nbsp; &nbsp;
                            <span></span> 网页链接</p>
                    </div>
                </div>
                <div class="l_form tab_choose">
                    <div class="html">
                        <label class="l_label">上传文件:</label>
                        <p class="input_div">
                            <input class="file" name="feedfile" value="" type="file" accept="file" id="picture">
                        </p>
                    </div>
                    <div style="display:none;" class="http">
                        <label class="l_label">输入链接:</label>
                        <p class="input_div">
                            <input style="width:22vw;" value="" class="input_line" name="feedhttps" type="text" placeholder="请输入网址">
                        </p>
                    </div>
                </div>
                <div class="l_line"></div>
                <div class="btn_bottom">
                    <button style="margin-right:2vw" @click="covers(0)" class="cus-btn" type="button">取消</button>
                    <button class="cus-btn" type="submit" @click="submit" />提交</button>
                </div>
            </form>
        </div>
    </div>
</body>
<script src="/Public/Doc/doclay/plugins/layui/layui.js"></script>
<script>
    var app = new Vue({
        el: "#app",
        data: {
            cover: false,
            form: false,
            listTitle1: '',
            datalist1: [],
            datalist2: [],
            f_id: '',
            Uid: '',
            count: 0
        },
        created: function () {
            // 获取上个页面传递回来的ID
            var url = location.search;
            var theRequest = new Object();
            if (url.indexOf("?") != -1) {
                var str = url.substr(1); //substr()方法返回从参数值开始到结束的字符串；
                var strs = str.split("&");
                for (var i = 0; i < strs.length; i++) {
                    theRequest[strs[i].split("=")[0]] = (strs[i].split("=")[1]);
                }
            }
            console.log('theRequest', theRequest)
            this.Uid = theRequest.f_id;
            this.getList(0, this.Uid);
            if (this.count == 0) {
                $('#move_bq').css({
                    'display': 'none'
                })
            }
            // console.log(this.Uid)
        },
        methods: {
            getList(typeID, Uid) {
                var that = this;
                var keyword = $(".form-control").val();
                $.ajax({
                    cache: false,
                    type: "post",
                    url: "<?php echo U('KnowledgeSharing/articlesList');?>",
                    dataType: "json",
                    data: { f_id: that.Uid, typeid: typeID, key: keyword },
                    success: function (data) {
                        that.datalist1 = data.top;
                        that.datalist2 = data.not_top;
                        // console.log(that.datalist1);
                        // console.log(that.datalist2);
                    }
                })
            },
            search() {
                var that = this;
                var keyword = $(".form-control").vul();
                $.ajax({
                    type: "post",
                    url: "",
                    dataType: "json",
                    data: { key: keyword },
                    success: function (data) {
                        console.log(data);
                    }
                })
            },
            // zhezhao
            covers(val) {
                var _this = this;
                if (val) {
                    _this.cover = true;
                    _this.form = true;
                } else {
                    _this.cover = false;
                    _this.form = false;
                }
            },
            jump(id) {
                console.log(id);
                var that = this;
                $.ajax({
                    cache: false,
                    type: "post",
                    url: "<?php echo U('KnowledgeSharing/numberCount');?>",
                    dataType: "json",
                    data: { id: id },
                    success: function (data) {

                        window.location.href = data.data;
                    }
                })
            }
        }
    })
    $(".list_span").click(function () {
        $(this).addClass("color2").siblings().removeClass("color2");
    })
    //弹窗切换
    $('.choose_type span').click(function (e) {
        e.stopPropagation();
        var i = $(this).index();
        $('.tab_choose div').eq(i).show().siblings().hide();
        $(this).addClass('choose_yes').siblings().removeClass('choose_yes');
    });
    //添加标签
    var counts = 0;
    $('#add_bq').click(function () {
        counts++;
        $("#wendang").append("<div  style='margin-right:3px;' class='input_div wendang'><input class='input_line bq_input' style='width:10vw;' id='product_bq' required type='text' name='feedNames[]' placeholder='请输入标签'/></div>")
        if (counts != 0) {
            $('#move_bq').css({
                'display': 'inline-block'
            })
        }
    })

    //删除标签
    $('#move_bq').click(function () {
        counts--;
        $("#product_bq").parent().last().remove();
        if (counts == 0) {
            $('#move_bq').css({
                'display': 'none'
            })
        }
    })
</script>

</html>