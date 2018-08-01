<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>fankui</title>
    <link rel="stylesheet" href="/Public/Doc/doclay/plugins/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/Public/Doc/doclay/build/css/app.css" media="all">
    <!--<link rel="stylesheet" href="../Public/Doc/doclay/plugins/layui/css/layui.css" media="all">-->
    <link rel="stylesheet" href="/Public/static/bootstrap.min.css" media="all">
    <link rel="stylesheet" href="/Public/Doc/css/submit3.css" media="all">
    <script src="/Public/static/jquery-2.0.3.min.js"></script>
    <script src="/Public/static/vue.min.js"></script>
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
            <p class="title_color">提交人</p >
            <p>{{subPerName}}</p >
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
                    <span  v-for="item in Imglist">
                        <img :src="item.img">
                    </span>
                    <!--<span><img src="/Public/Doc/images/b.jpg" alt=""></span>
                    <span><img src="/Public/Doc/images/b.jpg" alt=""></span>-->
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
                <p class="labels">
                    <input class="input" type="radio" name="sex" value="1" v-model="message.id" checked>
                    <label style="margin-bottom: 0;" for="man">BUG修复</label>
                    <input class="input" type="radio" name="sex" v-model="message.id" value="2" >
                    <label style="margin-bottom: 0;" for="female">操作指导</label>
                </p>
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
                <p class="labels">
                    <input class="input" type="radio" name="sex" value="1" v-model="message.id" checked>
                    <label style="margin-bottom: 0;" for="man">BUG修复</label>
                    <input class="input" type="radio" name="sex" v-model="message.id" value="2" >
                    <label style="margin-bottom: 0;" for="female">操作指导</label>
                </p>
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

        <ul v-for="item in replyList" class="content_text">
            <li>{{item.content}}</li>
            <li><span style="margin-right:2vw;">{{item.author}}</span><span>{{item.time}}</span></li>
        </ul>
    </div>
</body>
  <script src="/Public/Doc/doclay/plugins/layui/layui.js"></script> 
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
            subPerName:'',//发起人
            project_name:'',//所属项目
            deadline:'',//截止时间
            describe:'',//描述
            problem_classification:'',//问题分类
            child_product_name:'',//
            product_name:'',//
            name:'',//反馈名称
            Imglist:[],//图片列表
            replyList:[]//回复数组
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
            this.Uid = theRequest.id;
            this.getEle();
        },
        methods: {
            // 获取页面元素
            getEle(){
                var that = this;
                $.ajax({
                    cache: false,
                    type: "POST",
                    url: "<?php echo U('Feedback/ProblemFeedback');?>",
                    dataType: "json",
                    data: {id:this.Uid},
                    success: function (res) {
                        // console.log('>>>',res);
                        that.Imglist =res.data.img; // 返回图片数组 
                        that.replyList =res.data.reply;
                        that.statue=res.data.statue;
                        that.project_name=res.data.project_name;
                        that.deadline=res.data.deadline;
                        that.describe=res.data.describe;
                        that.problem_classification=res.data.problem_classification;
                        that.child_product_name=res.data.child_product_name;
                        that.product_name=res.data.product_name;
                        that.name=res.data.name;
                        that.subPerName=res.data.submit_person_name;
                        //  $.each(res.data, function(i,item) {
                        //   console.log('页面元素',item)
                        //   that.statue=item.statue;
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
                        type:"POST",
                        url:"<?php echo U('Feedback/Solve');?>",
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
                console.log(this.message);
                    $.ajax({
                        cache: false,
                        type: "POST",
                         url:"<?php echo U('Feedback/Suspend');?>",
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
                        url: "<?php echo U('Feedback/addReply');?>",
                        dataType: "json",
                        data: {content:inpVla,id:1},
                        success: function (res) {
                            console.log('回复按钮');
                            inpVla=''
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