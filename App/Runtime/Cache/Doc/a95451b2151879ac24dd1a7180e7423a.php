<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>fankui</title>
    <link rel="stylesheet" href="/ProjectDelivery/Public/Doc/doclay/plugins/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/ProjectDelivery/Public/Doc/doclay/build/css/app.css" media="all">
    <script src="/ProjectDelivery/Public/static/jquery-2.0.3.min.js"></script>
    <script src="/ProjectDelivery/Public/Doc/doclay/plugins/layui/layui.js"></script> 
    <script src="/ProjectDelivery/Public/static/vue.min.js"></script>
    <style>
        body {
            padding: 8vh 4vw;
            color: #4A4A4A;
        }

        .btn-sub {
            display: inline-block;
            height: 38px;
            line-height: 38px;
            padding: 0 8px;
            background-color: #009688;
            color: #fff;
            white-space: nowrap;
            text-align: center;
            font-size: 14px;
            border: none;
            border-radius: 2px;
            cursor: pointer;
            opacity: .9;
        }

        td a {
            color: #4A90E2;
        }

        .zhaungtai {
            position: relative;
        }

        .zhaungtai span {
            position: relative;
            top: 0vh;
            padding-left: 5px;
        }

        .yiban::after {
            content: '';
            width: 8px;
            height: 8px;
            position: absolute;
            display: inline-block;
            background: #4A90E2;
            left: -1vw;
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
            left: -1vw;
            top: .8vh;
            border-radius: 50%;
        }

        .jinji::after {
            content: '';
            width: 8px;
            height: 8px;
            position: absolute;
            display: inline-block;
            background: #FF4242;
            left: -1vw;
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
            left: -1vw;
            top: .8vh;
            border-radius: 50%;
        }
    </style>
</head>

<body>
   <div class="new">
        <form class="layui-form" action="">
        <div class="layui-form-item">
            <label class="layui-form-label">提交时间</label>
            <div class="layui-input-inline" style="width:13vw">
                <input type="text" name="starTime" class="layui-input" id="test1" placeholder="yyyy-MM-dd">
            </div>
            <label class="layui-form-label" style="padding:9px 5px; margin-left:-10px;">至</label>
            <div class="layui-input-inline" style="width:13vw">
                <input type="text" name="endTime" class="layui-input" id="test2" placeholder="yyyy-MM-dd">
            </div>
            <div class="layui-input-inline">
                <input type="text" name="keywords" lay-verify="title" autocomplete="off" placeholder="关键字" class="layui-input">
            </div>
            <!--<button class="layui-btn layui-btn-normal">默认按钮</button>-->
            <span class="btn-sub" lay-submit lay-filter="formDemo">搜索</span>
        </div>
    </form>
 
    <table class="layui-table ">
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
                <td @click="openNew(item.id)"><span>查看</span></td>
            </tr>
        </tbody>
    </table>
    <div id="test3"></div>
   </div>
</body>
  <!--<script src="/ProjectDelivery/Public/Doc/doclay/plugins/layui/layui.js"></script> -->
<script>
    var app = new Vue({
        el: '.new',
        data: {
            arrList: [],
            pageIndex:1,
            limit:10
        },
        created:function() {
            this.getList();
            this.layPage();
        },
        methods: {
            //进入页面获取数据
            getList () {
                console.log('-----------')
                var that =this
                $.ajax({
                    cache: false,
                    type: "POST",
                    url: "<?php echo U('Feedback/FeedbackList');?>",
                    dataType: "json",
                    data: { pageIndex: that.pageIndex || 1,limit:that.limit || 10},
                    success: function (res) {
                        // console.log('333', res.data)
                        that.arrList = res.data;
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
                        , count: 70 //数据总数，从服务端得到
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
                var _this = this;
                layui.use('form', function () {
                var form = layui.form;
                //监听提交
                form.on('submit(formDemo)', function (data) {
                    // layer.msg(JSON.stringify(data.field));
                    console.log(data.field);
                    $.ajax({
                            cache: false,
                            type: "POST",
                            url: "<?php echo U('Feedback/SearchFeedbackList');?>",
                            dataType: "json",
                            data:data.field,
                            success: function (res) {
                                console.log('查询', res.data);
                                // this.arrList= res.data;
                            }
                        });
                    return false;
                });
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
</script>


</html>