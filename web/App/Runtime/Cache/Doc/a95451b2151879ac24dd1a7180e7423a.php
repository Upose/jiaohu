<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>fankui</title>
    <link rel="stylesheet" href="/jfyy/Public/Doc/doclay/plugins/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/jfyy/Public/Doc/doclay/build/css/app.css" media="all">
    <link rel="stylesheet" href="/jfyy/Public/Doc/css/submit2.css" media="all">
    <script src="/jfyy/Public/static/jquery-2.0.3.min.js"></script>
    <script src="/jfyy/Public/Doc/doclay/plugins/layui/layui.js"></script> 
    <script src="/jfyy/Public/static/vue.min.js"></script>
</head>
<body>
   <div class="new">
        <form class="layui-form" action="">
        <div class="layui-form-item">
            <label class="layui-form-label">提交时间</label>
            <div class="layui-input-inline" style="width:13vw">
                <input type="text" v-model="message.starTime" name="starTime" class="layui-input" id="test1" placeholder="yyyy-MM-dd">
            </div>
            <label class="layui-form-label" style="padding:9px 5px; margin-left:-10px;">至</label>
            <div class="layui-input-inline" style="width:13vw">
                <input type="text" v-model="message.endTime" name="endTime" class="layui-input" id="test2" placeholder="yyyy-MM-dd">
            </div>
            <div class="layui-input-inline">
                <input type="text" v-model="message.keywords"  name="keywords" lay-verify="title" autocomplete="off" placeholder="关键字" id="keywords" class="layui-input">
            </div>
            <!--<button class="layui-btn layui-btn-normal">默认按钮</button>-->
            <span class="btn-sub" @click="searchInput()">搜索</span>
        </div>
    </form>
 
    <table class="layui-table">
        <thead>
            <tr>
                <th>编号</th>
                <th>名称</th>
                <th>所属项目</th>
                <th>产品</th>
                <th>分类</th>
                <th>提交时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in arrList">
                <td>{{item.id}}</td>
                <td>{{item.name}}</td>
                <td>{{item.project_name}}</td>
                <td>{{item.product_name}}</td>
                <td>{{item.classification_name}}</td>
                <td>{{item.submit_time}}</td>
                <td class="zhaungtai">
                    <span v-show="item.priority=='一般'" class='yiban'>{{item.priority}}</span>
                    <span v-show="item.priority=='紧急'" class='jinji'>{{item.priority}}</span>
                    <span v-show="item.priority=='优化'" class='youhua'>{{item.priority}}</span>
                    <span v-show="item.priority=='重要'" class='zhongyao'>{{item.priority}}</span>
                    </td>
                <td style="cursor:pointer;" @click="openNew(item.id)"><span style="color:rgba(74,144,226,1);">查看</span></td>
            </tr>
        </tbody>
    </table>
    <div id="test3"></div>
   </div>
</body>
  <!--<script src="/jfyy/Public/Doc/doclay/plugins/layui/layui.js"></script> -->
<script>
    var app = new Vue({
        el: '.new',
        data: {
            arrList: [],
            pageIndex:1,
            limit:10,
            message:{},
            counts:''
        },
        created:function() {
            this.getList(); //进入页面获取数据
        },
        methods: {
            //进入页面获取数据
            getList () {
                // console.log('-----------')
                var that =this  
                $.ajax({
                    cache: false,
                    type: "POST",
                    url: "<?php echo U('Feedback/FeedbackList');?>",
                    dataType: "json",
                    data: { page: that.pageIndex || 1,limit:that.limit || 10},
                    success: function (res) {
                        console.log('333', res.data);
                        that.arrList = res.data;
                        that.counts=res.count;
                        console.log('330099993', res);
                        that.layPage(); //分页
                    }
                })
            },
            // 分页
            layPage() {
                var _this = this;
                layui.use('laypage', function () {
                    var laypage = layui.laypage;
                    laypage.render({
                        elem: 'test3'
                        , count:_this.counts
                        , limit:10
                        , curr:_this.pageIndex
                        , jump: function (obj, first) {
                            //obj包含了当前分页的所有参数
                            //首次不执行
                            if(first) {
                                return false;
                            }
                            _this.pageIndex = obj.curr;
                            _this.limit = obj.limit;
                            _this.getList();
                        }
                    });
                });        
            },
            //跳转页面
            openNew(val){
            window.location.href = "<?php echo U('feedback/submit3');?>"+"&id="+val
            },
            //搜索按钮
            searchInput(){
                var _this= this;
                var starTime = $("#test1").val();
                var endTime = $("#test2").val();
                var keywords = $("#keywords").val();
                    $.ajax({
                        cache: false,
                        type: "POST",
                        url: "<?php echo U('Feedback/SearchFeedbackList');?>",
                        dataType: "json",
                data:{starTime:starTime,
                    endTime:endTime,
                    keywords:keywords,page: _this.pageIndex || 1,limit:_this.limit || 10},
                        success: function (res) {
                            _this.arrList= res.data;
                            _this.counts=res.count;
                            console.log(res.count)
                            _this.layPage(); //分页



                        }
                    });
            }
        },
    });
    layui.use(['laydate'], function () {
        var laydate = layui.laydate;
        //常规用法
        laydate.render({
            elem: '#test1'
            ,type: 'datetime'
        });
        laydate.render({
            elem: '#test2'
            ,type: 'datetime'   
        });
    });
    layui.use('form', function(){
        var form = layui.form;
    });
</script>
</html>