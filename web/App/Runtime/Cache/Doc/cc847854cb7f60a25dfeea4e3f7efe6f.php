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
            <input @click="dis(0)" style="cursor: pointer;"  class="radio_input" type="radio" name="priority" id="" value="1" v-model="titVal">紧急
            <input @click="dis(0)" style="cursor: pointer;" class="radio_input" type="radio" name="priority" id="" value="2" v-model="titVal">重要
            <input @click="dis(1)" style="cursor: pointer;" class="radio_input" type="radio" name="priority" id="" value="3" v-model="titVal">一般
            <input @click="dis(1)" style="cursor: pointer;" class="radio_input" type="radio" name="priority" id="" value="4" v-model="titVal">优化
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
            <div class="form_div1 time_div">
                <label class="tit">截止时间</label>
                <input class="tame_input" type="date" name="deadline" v-model="message.time" id="">
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
                    <div class="cus-files-content">
                        <div class="cus-warning">
                            <p class="cus-warning-item">最多上传文件个数: 6</p>
                            <p class="cus-warning-item">文件最大不能超过: 10M</p>
                            <p class="cus-warning-item">允许上传文件类型: .jpg,.gif,.png,.jpeg</p>
                        </div>
                    </div>
                </div>
            </div><br>
            <!-- <div class="line"></div> -->
            <button class="but" type="button">取消</button>
            <button class="but" type="submit" @click="submit" />提交</button>
        </form>
    </div>
</body>
<script src="/Public/Doc/doclay/plugins/layui/layui.js"></script>   
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
            },
            dis(num){
                if(num === 0){
                $(".time_div").show();
                }else if(num === 1){
                $(".time_div").hide();
                }
            }
        },
    });

    var maxFileSize = 10485760; // 最大文件大小
    var maxFileLength = 6; // 文件个数

    // 重置文件上传
    function resetUpload(msg) {
        $('.cus-files-content').find('.cus-img').remove();
        $('.cus-files-input')[0].value = '';
        $('.cus-warning').show();

        layui.use('layer', function() {
            layui.layer.alert(msg);
        })
    }

    /**
     * 对上传文件进行验证
     * @param  {[object]} files         [文件对象]
     * @param  {[number]} maxFileLength [文件个数]
     * @param  {[number]} maxFileSize   [文件大小]
     * @return {[bool]}   result [description]
     */
    function testUpload(files ,maxFileLength, maxFileSize) {
        var result = true;

        // 未选择文件, 清空选择框
        if(files.length === 0) {
            resetUpload('未选择任何文件');
            
            result = false;
        }

        // 文件个数超过限制, 重新选择
        if(files.length > maxFileLength) {
            resetUpload('上传文件个数不能超过6个, 请重新上传!');

            result = false;
        }

        // 文件大小超过限制, 重新选择
        ;[].slice.call(files).forEach(function(item, idx) {
            if(item.size > maxFileSize) {
                resetUpload('上传文件最大不能超过10M, 请重新上传!');

                result = false;
            }
        })

        return result;
    }

    /**
     * 显示文件缩略图
     * @param  {[object]} files [文件对象]
     * @param  {[element]} el    [缩略图显示的节点]
     */
    function showThumbnails(files, el) {
        ;[].slice.call(files).forEach(function(item, idx) {
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

            $(el).append(img);
        })
    }

    // 文件上传
    $('#cus-ipt').on('change', function() {
        // 验证
        var files = this.files;
        $('.cus-warning').show();

        var res = testUpload(files, maxFileLength, maxFileSize);

        if(res) {
            $('.cus-warning').hide();
            showThumbnails(files, $('.cus-files-content'));
        }
    })
</script>

</html>