<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>fankui</title>
    <link rel="stylesheet" href="/Public/Doc/css/allmap.css" media="all">
    <script src="/Public/static/jquery-2.0.3.min.js"></script>
    <script src="/Public/static/vue.min.js"></script>
</head>
<body>
    <div class="new">
        <div class="new_up">
            <div>
                <label class="tit">提交项目</label>
            </div>
            <div>
                <label class="tit">问题处理情况</label>
            </div>
            <div>
                <label class="tit">处理周期</label>
            </div>
        </div>
        <div class="new_down">
            <div class="newdown_left">
                <div class="left_up">
                    <div class="up_child1">
                        <label class="tit">紧急程度</label>
                    </div>
                    <div class="up_child2">
                        <label class="tit">处理进度</label>
                    </div>
                </div>
                <div class="left_down">
                    <label class="tit">问题类型</label>
                </div>
            </div>
            <div class="newdown_right">
                <label class="tit">处理方式</label>
            </div>
        </div>
    </div>
</body>
<script>
    var app = new Vue({
        el: '.new',
        data: {
        },
        created:function() {
        },
        methods: {}
    });
</script>
</html>