<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/Public/Doc/doclay/plugins/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/Public/Doc/css/SubmitFeedback.css" media="all">
    <script src="/Public/static/vue.min.js"></script>
    <script src="/Public/static/jquery-2.0.3.min.js"></script>
</head>

<body class="">
    <div id="app">
        <form action="<?php echo U('Feedback/FeedbackSubmit');?>" method="POST" enctype="multipart/form-data">
            <button @click="return()" type="button" class="layui-btn layui-btn-primary"><i class="layui-icon">&#xe65c;</i> 返回</button>
            <label class="tit">优先级</label>
            <input type="hidden" name="pd_id" :value="oid"/>
            <input type="hidden" name="pds_id" :value="nid"/>
            <input class="radio_input" type="radio" name="priority" id="" value="1" v-model="titVal">紧急
            <input class="radio_input" type="radio" name="priority" id="" value="2" v-model="titVal">重要
            <input class="radio_input" type="radio" name="priority" id="" value="3" v-model="titVal">一般
            <input class="radio_input" type="radio" name="priority" id="" value="4" v-model="titVal">优化
            <label class="tit">问题分类</label>
            <select name="pc_id" id="" v-model="message.type" required>
                <option v-for="item in selectList1" :value="item.pc_id">    {{item.name}}</option>
            </select>
            <img class="problem_img" src="" alt=""><span class="color1">相似问题</span>
            <label class="tit">所属项目</label>
            <select name="ps_id" id="" v-model="message.xiangmu" required>
                <option v-for="item in selectList2" :value="item.ps_id">{{item.name}}</option>
            </select>
            <br>
            <div class="form_div1">
                <label class="tit">名称</label>
                <input class="name_input" v-model="message.mingcheng" type="text" name="name" id="" required>
            </div>
            <div class="form_div1" style="position: absolute;">
                <label class="tit">截止时间</label>
                <input class="tame_input" type="date" name="deadline" v-model="message.time" id="" required>
            </div>
            <br>
            <div class="form_div2">
                <label class="tit">描述</label>
                <textarea name="describe" id="" v-model="message.des" cols="40" rows="7" required></textarea>
            </div>
            <div class="form_div2" style="vertical-align: top;">
                <label class="tit">上传文件</label>
                <div class="cus-files" id="cus-form">
                    <input type="file" name="photo[]" id="cus-ipt" class="cus-files-input" multiple="multiple" accept=".jpg,.png,.git" />
                    <div class="cus-files-content"></div>
                </div>
            </div><br>
            <!-- <div class="line"></div> -->
            <button class="but" type="button">取消</button>
            <button class="but" type="submit" @click="submit" />提交</button>
        </form>
    </div>
</body>
<!-- <script src="/Public/Doc/doclay/plugins/layui/layui.js"></script>    -->
<script>
    var app = new Vue({
        el: '#app',
        data: {
            message: '',
            selectList1: [],
            selectList2: [],
            selectList3: [],
            oid: '',
            nid: '',
            myVal: 0,
            titVal: '1',
            theRequest: [],
        },
        created: function () {
            // 获取上个页面传递回来的ID
            var url = location.search;
            var theRequest = new Object();
            if (url.indexOf("?") != -1) {
                var str = url.substr(1); //substr()方法返回从参数值开始到结束的字符串；
                var strs = str.split("&");
                // console.log(strs);
                
                for (var i = 0; i < strs.length; i++) {
                    theRequest[strs[i].split("=")[0]] = (strs[i].split("=")[1]);
                }
            }
            this.oid = theRequest.oID;
            this.nid = theRequest.nID;

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
                        that.selectList1 = data.data.problem;
                        that.selectList2 = data.data.project;
                    }
                })
            },
            return(){window.history.go(-1)},
            submit() {
                var _this = this;
            }
        },
    });
    // 文件上传
    $('#cus-ipt').on('change', function() {
        // 验证
        var preview = document.querySelector(".cus-img");
		var files = this.files;
        
        [].slice.call(files).forEach(function(item, idx) {
            var reader = new FileReader();
            var img = document.createElement('img');
            
            img.className = 'cus-img';

            if(item){
                reader.readAsDataURL(item);
            }else{
                img.src = '';
            }
    
            reader.onloadend = function(){
                img.src = reader.result;
            }

            $('.cus-files-content').append(img);

        })
       
    })
</script>

</html>