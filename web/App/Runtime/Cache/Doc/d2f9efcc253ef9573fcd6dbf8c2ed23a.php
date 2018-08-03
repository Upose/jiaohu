<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="icon.ico">
    <title>文档管理</title>
    <link rel="stylesheet" href="/Public/Doc/doclay/build/css/app.css" media="all">
    <link rel="stylesheet" href="/Public/Doc/css/document _m.css" media="all">
    <!-- <link rel="stylesheet" href="/Public/static/bootstrap.css" media="all"> -->
    <script src="/Public/static/jquery-2.0.3.min.js"></script>
    <script src="/Public/static/vue.min.js"></script>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous">
    <link rel="stylesheet" href="/Public/static/bootstrap-theme.min.css" media="all">
    <script src="/Public/static/bootstrap.min.js"></script>
</head>

<body>
    <div class="container-fluid" id="app">
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
        <div class="option col-md-12 back_color" v-for="item1 in datalist1" >
            <!-- 置顶按钮 -->
            <button class="topping">置顶</button>
            <!-- 项目名称 -->
            <span class="poj_name"><a href="/mdhtml/database.html">{{item1.name}}</a></span>
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
            <span class="poj_name"><a :href="item2.href">{{item2.name}}</a></span>
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
    </div>

</body>
<script>
    var app = new Vue({
        el: "#app",
        data: {
            listTitle1: '',
            datalist1:[],
            datalist2:[],
            f_id:''
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
                    this.f_id = theRequest.f_id;
                    this.getList(0);
        },
        methods: {
            getList(typeID) {
                var that=this;
                var keyword=$(".form-control").val();
                $.ajax({
                    cache: false,
                    type: "post",
                    url: "<?php echo U('KnowledgeSharing/articlesList');?>",
                    dataType: "json",
                    data:{f_id:that.f_id,typeid:typeID,key:keyword},
                    success: function (data) {
                        that.datalist1 = data.top;
                        that.datalist2 = data.not_top;
                       /* console.log(that.datalist1);
                        console.log(that.datalist2);*/
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
                data:{key:keyword},
                success:function(data){
                    console.log(data);
                }
            })

        }
        }
    })
    $(".list_span").click(function(){
        $(this).addClass("color2").siblings().removeClass("color2");
    })
</script>

</html>