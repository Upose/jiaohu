<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>fankui</title>
    <link rel="stylesheet" href="/ProjectDelivery/Public/Doc/doclay/plugins/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/ProjectDelivery/Public/Doc/doclay/build/css/app.css" media="all">
    <!--<link rel="stylesheet" href="../Public/Doc/doclay/plugins/layui/css/layui.css" media="all">-->
    <link rel="stylesheet" href="/ProjectDelivery/Public/static/bootstrap.min.css" media="all">
    <script src="/ProjectDelivery/Public/static/jquery-2.0.3.min.js"></script>
    <script src="/ProjectDelivery/Public/static/vue.min.js"></script> 
    <style>
        body {
            padding: 8vh 4vw;
            background: rgb(242, 242, 242)
        }

        * {
            padding: 0;
            margin: 0;
        }

        .layui-upload-img {
            width: 92px;
            height: 92px;
            margin: 0 10px 10px 0;
            border: 1px solid;
        }

        .layui-btn-xs {
            height: 22px;
            line-height: 22px;
            padding: 0 5px;
            font-size: 12px;
        }

        .one {
            background: rgb(255, 255, 255);
            margin-bottom: 20px;
            padding: 5vh 4vw;
            font-size: 1.2vw;
            color: #4A4A4A;
            position: relative;
        }
        /*已解决弹窗*/

        .one .window_ok {
            top: 50%;
            left: 50%;
            position: absolute;
            width: 32vw;
            height: 38vh;
            background: rgba(255, 255, 255, 1);
            box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.2);
            border-radius: 4px;
            transform: translate(-50%, -50%);
        }

        .window_ok .window_ok_title {
            height: 6vh;
            padding: 1vh;
            padding-left: 1vw;
            border-bottom: 1px solid rgba(233, 233, 233, 1);
        }

        .window_ok .window_ok_botttom span {
            display: inline-block;
            width: 4vw;
            height: 4vh;
            font-size: 1.2vw;
            text-align: center;
            line-height: 4vh;
            background: rgba(255, 255, 255, 1);
            border-radius: 2px;
            margin-right: .5vw;
            float: right;
            cursor: pointer;
            border: 1px solid rgba(217, 217, 217, 1);
        }

        .window_ok .window_ok_botttom .choose {
            background: #07C88D;
            color: #fff;
        }

        .window_ok .window_ok_botttom {
            height: 6vh;
            padding: 1vh;
            padding-left: 1vw;
            margin-top: 2vh;
            border-top: 1px solid rgba(233, 233, 233, 1);
        }

        .window_ok .rel_pel {
            border-radius: 4px;
            width: 20vw;
            height: 5vh;
            padding-left: 1.5vw;
            border: 1px solid rgba(217, 217, 217, 1);
        }

        .window_ok .rel_fun {
            border-radius: 4px;
            height: 15vh;
            width: 20vw;
            padding-left: 1.5vw;
            resize: none;
            border: 1px solid rgba(217, 217, 217, 1);
            vertical-align: middle
        }


        .state {
            font-size: 1.2vw;
            color: #4A4A4A;
        }

        .state .left {
            display: inline-block;
            width: 45%;
            padding-right: 10vw;
        }

        .state .right {
            display: inline-block;
            width: 45%
        }

        .states .left {
            float: left;
            width: 45%;
            padding-right: 10vw;
        }

        .states .right {
            display: inline-block;
            width: 45%
        }

        .state .right .biaoqian span {
            display: inline-block;
            /*width: 7vw;*/
            padding: .5vh 1.5vw;
            height: 4vh;
            font-size: 1.2vw;
            text-align: center;
            line-height: 3vh;
            background: rgba(150, 212, 206, 0.32);
            border-radius: 2px;
            border: 1px solid rgba(0, 149, 136, 1)
        }

        .state .right .biaoqian .wfaz {
            border-radius: 2px;
            color: #D55454;
            background: rgb(255, 255, 255);
            border: 1px solid rgba(213, 84, 84, 1);
        }

        .title_color {
            color: #9B9B9B;
            margin-top: 2vh;
        }

        p {
            margin-bottom: 1vh;
        }

        .left .jinji {
            position: relative;
            top: 0vh;
            padding-left: 1.2vw;
            margin-right: 2vw;
        }
        .left .yiban {
            position: relative;
            top: 0vh;
            padding-left: 1.2vw;
            margin-right: 2vw;
        }
        .left .zhongyao {
            position: relative;
            top: 0vh;
            padding-left: 1.2vw;
            margin-right: 2vw;
        }
        .left .youhua {
            position: relative;
            top: 0vh;
            padding-left: 1.2vw;
            margin-right: 2vw;
        }
        .jinji::after {
            content: '';
            width: 8px;
            height: 8px;
            position: absolute;
            display: inline-block;
            background: #FF4242;
            left: 0;
            top: 1.2vh;
            border-radius: 50%;
        }
        
        .yiban::after {
            content: '';
            width: 8px;
            height: 8px;
            position: absolute;
            display: inline-block;
            background: #4A90E2;
            left: 0vw;
            top: .8vh;
            border-radius: 50%;
        }
        .zhongyao::after {
            content: '';
            width: 8px;
            height: 8px;
            position: absolute;
            display: inline-block;
            background: #F5A623;
            left: 0vw;
            top: .8vh;
            border-radius: 50%;
        }
        .youhua::after {
            content: '';
            width: 8px;
            height: 8px;
            position: absolute;
            display: inline-block;
            background: #7ED321;
            left: 0vw;
            top: .8vh;
            border-radius: 50%;
        }

        .right .files span {
            height: 12vh;
            width: 8vw;
            margin-bottom: 1vh;
            margin-right: .5vw;
            line-height: 12vh;
            border-radius: 4px;
            text-align: center;
            display: inline-block;
            border: 1px dotted #D9D9D9;
            background: rgba(251, 251, 251, 1);
        }

        .right .files span img {
            height: 12vh;
            width: 8vw;
            background-size: 100% 100%;
        }

        .two {
            background: rgb(255, 255, 255);
            padding: 5vh 4vw;
            font-size: 1.2vw;
            color: #4A4A4A;
        }

        .two .content_text {
            margin-bottom: 3vh;
        }

        .two .content_text .shuru_input{
            height: 6vh;
            width: 100%;
            padding-left: .5vw;
            line-height: 6vh;
            background: rgba(249, 249, 249, 1);
            border-radius: 4px;
            border: 1px solid rgba(234, 234, 234, 1);    
        }

        .two .content_text li:nth-child(1) {
            height: 6vh;
            padding-left: .5vw;
            line-height: 6vh;
            background: rgba(249, 249, 249, 1);
            border-radius: 4px;
            border: 1px solid rgba(234, 234, 234, 1);
        }

        .two .content_text li:nth-child(2) {
            color: rgba(155, 155, 155, 1);
            text-indent: .5em;
        }

        .bot_line {
            border-top: 1px solid rgba(151, 151, 151, .3);
        }

        .bot_line ul {
            text-align: right;
            padding-right: 5vw;
            padding-top: 4vh;
            margin-bottom: 0;
        }

        .bot_line li {
            padding: .5vh 1vw;
            display: inline-block;
            cursor: pointer;
            background: rgba(255, 255, 255, 1);
            border-radius: 4px;
            border: 1px solid rgba(217, 217, 217, 1);
        }

        .bot_line .active {
            background: #07C88D;
            color: #fff;
        }
    </style>
</head>

<body class="news">
    <div class="one">
        <!--<p class="return_btn">< 返回</p>-->
        <button @click="return()" class="layui-btn layui-btn-primary"><i class="layui-icon">&#xe65c;</i> 返回</button>
        <div class="state">
            <div class="left">
                <p class="title_color">状态</p>
                <p>
                    <span v-show="statue=='一般'" class='yiban'>{{statue}}</span>
                    <span v-show="statue=='紧急'" class='jinji'>{{statue}}</span>
                    <span v-show="statue=='优化'" class='youhua'>{{statue}}</span>
                    <span v-show="statue=='重要'" class='zhongyao'>{{statue}}</span>
                    截止时间：<span>{{deadline}}</span></p>
            </div>
            <div class="right">
                <p class="title_color">标签</p>
                <p class="biaoqian">
                    <span v-show="product_name">{{product_name}}</span>
                    <span v-show="child_product_name">{{child_product_name}}</span>
                    <span v-show="problem_classification" class="wfaz">{{problem_classification}}</span>
                </p>
            </div>
        </div>
        <div>
            <p class="title_color">所属项目</p>
            <p>{{project_name}}</p>
        </div>
        <div>
            <p class="title_color">反馈名称</p>
            <p>{{name}}</p>
        </div>
        <div class="states">
            <div class="left">
                <p class="title_color">描述</p>
                <p>{{describe}}</p>
            </div>
            <div class="right">
                <p class="title_color">附件</p>
                <p class="files">
                    <span><img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1533114638&di=3a7af6f9941e594742631db6f5053c6e&imgtype=jpg&er=1&src=http%3A%2F%2Fimg.25pp.com%2Fuploadfile%2Fsoft%2Fimages%2F2012%2F1104%2F20121104021248181.jpg" alt=""></span>
                    <span><img src="/ProjectDelivery/Public/Doc/images/b.jpg" alt=""></span>
                    <span><img src="/ProjectDelivery/Public/Doc/images/b.jpg" alt=""></span>
                    <span>照片</span>
                    <span>照片</span>
                    <span>照片</span>
                </p>
            </div>
        </div>
        <div class="bot_line">
            <ul>
                <li @click="replys()">回复</li>
                <li class="active" @click="solves(1)">已解决</li>
                <li @click="pauses(1)">暂停</li>
            </ul>
        </div>
        <!--已解决弹窗-->
        <div v-show="solve" class="window_ok">
            <div class="window_ok_title">问题解决</div>
            <div>
                <p style="margin-top: 2vh;"><span style="margin-left: 2.7vw;">解决人：</span> <input v-model="message.name" class="rel_pel" type="text"><br/></p>
                <p><span style="margin-left: 1.5vw;">解决方法：</span> <textarea v-model="message.content" class="rel_fun" placeholder=""></textarea></p>
            </div>
            <div class="window_ok_botttom">
                <span @click="submitSolve()">确定</span>
                <span @click="solves(0)" class="choose">取消</span>
            </div>
        </div>
        <!--暂停弹窗-->
        <div v-show="pause" class="window_ok window_pause">
            <div class="window_ok_title">暂停原因</div>
            <div>
                <p style="margin-top: 2vh;"><span style="margin-left: 2.7vw;">解决人：</span> <input v-model="message.name" class="rel_pel" type="text"><br/></p>
                <p><span style="margin-left: 1.5vw;">解决方法：</span> <textarea v-model="message.content" class="rel_fun" placeholder=""></textarea></p>
            </div>
            <div class="window_ok_botttom">
                <span @click="submitPause()">确定</span>
                <span @click="pauses(0)" class="choose">取消</span>
            </div>
        </div>
    </div>
     <div class="two">

        <div class="content_text">
            <input class="shuru_input" type="text" placeholder="请输入评论">
        </div>

        <ul class="content_text">
            <li>我是一句很长，超级长的文案，我是一句很长</li>
            <li><span style="margin-right:2vw;">研发老哥666</span><span>2018/7/20 12:00</span></li>
        </ul>
        <ul class="content_text">
            <li>我是一句很长，超级长的文案，我是一句很长</li>
            <li><span style="margin-right:2vw;">研发老哥666</span><span>2018/7/20 12:00</span></li>
        </ul>
    </div>
</body>
  <script src="/ProjectDelivery/Public/Doc/doclay/plugins/layui/layui.js"></script> 
<script>
    var app = new Vue({
        el: '.news',
        data: {
            solve: false,
            pause: false,
            message: {}, //弹窗的信息
            Uid:'',
            Allitem:{},
            statue:'', // 状态
            project_name:'',//所属项目
            deadline:'',//截止时间
            describe:'',//描述
            problem_classification:'',//问题分类
            child_product_name:'',//
            product_name:'',//
            name:'',//反馈名称
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
            // console.log(theRequest.id); //此时的theRequest就是我们需要的参数；
            this.Uid = theRequest.id;
            this.getEle();
        },
        methods: {
            // 获取页面元素
            getEle(){
                // console.log('要传的ID',this.Uid);
                var that = this;
                // debugger
                $.ajax({
                    cache: false,
                    type: "POST",
                    url: "<?php echo U('Feedback/ProblemFeedback');?>",
                    dataType: "json",
                    data: {id:this.Uid},
                    success: function (res) {
                        console.log('>>>',res);
                        that.statue=res.data.statue;
                        that.project_name=res.data.project_name;
                        that.deadline=res.data.deadline;
                        that.describe=res.data.describe;
                        that.problem_classification=res.data.problem_classification;
                        that.child_product_name=res.data.child_product_name;
                        that.product_name=res.data.product_name;
                        that.name=res.data.name;
                        //    $.each(res.data, function(i,item) {
                        //     console.log('页面元素',item)
                        //     that.statue=item.statue;
                        // });
                    }
                })    
            },
            // 返回上一层
            return(){window.history.go(-1)},
            // 已解决确定按钮
            submitSolve() {
                // console.log(this.message);
                $.ajax({
                        cache: false,
                        type: "POST",
                        url: 'http://192.168.4.41:8086/Doc/Feedback/Solve',
                        dataType: "json",
                        data: this.message,
                        success: function (res) {
                            console.log('已解决', res)
                        }
                    })
                this.solves(0);
                this.message = ''
            },
            // 暂停确定按钮
            submitPause() {
                // console.log(this.message);
                    $.ajax({
                        cache: false,
                        type: "POST",
                        url: 'http://192.168.4.41:8086/Doc/Feedback/Suspend',
                        dataType: "json",
                        data: this.message,
                        success: function (res) {
                            console.log('暂停', res);
                        }
                    })
                    this.pauses(0);
                   this.message = ''
            },
            // 已解决按钮
            solves(val) {
                var that = this;
                if (val) {
                    that.solve = true;
                } else {
                    that.solve = false;
                }
            },
            // 暂停按钮
            pauses(val) {
                var that = this;
                if (val) {
                    that.pause = true;
                } else {
                    that.pause = false;
                }
            },
             //回复
            replys(){
                var inpVla= $('.shuru_input').val();
                console.log('111',inpVla);
                $.ajax({
                        cache: false,
                        type: "POST",
                        url: '',
                        dataType: "json",
                        data: this.message,
                        success: function (res) {
                            
                        }
                    })
            },
        },
    })
    //按钮选择样式
    $('.bot_line li').click(function (e) {
        e.stopPropagation();
        $(this).addClass('active').siblings().removeClass('active');
    })
    //弹窗按钮选择
    $('.window_ok_botttom span').click(function (e) {
        e.stopPropagation();
        $(this).addClass('choose').siblings().removeClass('choose');
    })
</script>


</html>