<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/ProjectDelivery/Public/Doc/doclay/plugins/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/ProjectDelivery/Public/Doc/css/SubmitFeedback.css" media="all">
    <script src="/ProjectDelivery/Public/static/jquery-2.0.3.min.js"></script>
    <script src="/ProjectDelivery/Public/static/vue.min.js"></script>
</head>

<body class="">
    <div class="layui-fluid" id="app">
        <button class="button2"> < 返回</button>
       <form action="">
           <label class="tit">优先级</label>
           <input class="radio_input" type="radio" name="level" id="" value="0">紧急
           <input class="radio_input" type="radio" name="level" id="" value="1">重要
           <input class="radio_input" type="radio" name="level" id="" value="2">一般
           <input class="radio_input" type="radio" name="level" id="" value="3">优化
           <label class="tit">问题分类</label>
           <select name="" id="">
               <option value="">111111111111111</option>
               <option value="">2</option>
               <option value="">3</option>
           </select>
           <img class="problem_img" src="" alt="">相似问题
           <label class="tit">所属项目</label>
           <select name="" id="">
                <option value="">111111111111111</option>
                <option value="">2</option>
                <option value="">3</option>
            </select><br>
            <div class="form_div1">
                <label class="tit">名称</label>
                <input class="name_input" type="text" name="" id="">
            </div>
            <div class="form_div1" style="position: absolute;">
                <label class="tit">截止时间</label>
                <input class="tame_input" type="date" name="" id="">
            </div><br>
            <div class="form_div2">
                <label class="tit">描述</label>
                <textarea name="" id="" cols="40" rows="7"></textarea>
            </div>
            <div class="form_div2" style="position: absolute;">
                <label class="tit">附件选择</label>
                <div class="upload_div">
                    <img class="up_img" src="/ProjectDelivery/Public/Doc/images/up@2x.png" alt="">
                    <div>
                        <p>点击或将文件拖拽到这里上传</p>
                        <p class="p1">支持扩展名：png.jpg 最多6个</p>
                    </div>
                </div>
            </div>
            <div class="line"></div>
            <button class="button1">取消</button>
            <button class="button1">提交</button>
       </form>
       
    </div>
</body>
<script src="/ProjectDelivery/Public/Doc/doclay/plugins/layui/layui.js"></script>   
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                message:'hahaha',
                selectList:[
                ],
                myVal:0
            },
            created: function () {
                // 获取上个页面传递回来的ID
                var url = location.search;
                var theRequest = new Object();
                var arr = new Object();
                if (url.indexOf("?") != -1) {
                    var str = url.substr(1); //substr()方法返回从参数值开始到结束的字符串；
                    var strs = str.split("&");
                    for (var i = 0; i < strs.length; i++) {
                        theRequest[strs[i].split("=")[0]] = (strs[i].split("=")[1]);
                    }
                }
                this.getEle();
            },
            methods: {
                getEle() {
                    var that = this;
                    $.ajax({
                        cache: false,
                        type: "POST",
                        url: "<?php echo U('Feedback/DropdownBoxList');?>",
                        dataType: "json",
                        success: function (data) {
                            // that.selectList = JSON.parse(JSON.stringify(data.data.problem));
                            // console.log(that.selectList);
                        var html = '';
                       
                        for (k in data.data.problem) {
                            html = html + "<option value=" + data.data.problem[k].pc_id + " >" + data.data.problem[k].name + "</option>";
                        }
                        // console.log(html);
                        $(".selectA").append(html);
                        
                        }
                     })
                }
            },
        });
        $("#but1").click(function () {
            var priority = $('input');
            // $.ajax({
            //     cache: false,
            //     type: "post",
            //     url: "http://192.168.4.41:8086/Doc/Feedback/FeedbackSubmit",
            //     dataType: JSON,
            //     data:{
            //         pd_id:"1",
            //         priority:"2",
            //         problem_name:"1",
            //         project_name:"1",
            //         name:"点不动",
            //         describe:"动不了",
            //         deadline:"2020-07-23",
            //         },
            //     success: function (data) {
            //         console.log(data);
            //     }
            // })
        })
  
    </script>
</html>