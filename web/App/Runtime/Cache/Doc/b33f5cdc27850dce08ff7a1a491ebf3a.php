<?php if (!defined('THINK_PATH')) exit();?><html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/Public/Doc/doclay/plugins/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/Public/Doc/css/ProductUse.css" media="all">
    <script src="/Public/Doc/doclay/plugins/layui/layui.js"></script>
    <script src="/Public/static/jquery-2.0.3.min.js"></script>
    <script src="/Public/static/vue.min.js"></script>
</head>

<body class="new">
    <div id="div1" class="layui-fluid" data-url="<?php echo U('Feedback/Product');?>">
        <h4>选择产品</h4>
        <div v-for="item in arrList1">
            <strong>{{item.name}}</strong>
            <div class="separate_line line1"></div>
            <div class="feedback_div" v-for="val in item.child">
                <img src="/Public/Doc/images/2icon@2x.png" alt="">{{val.name}}
                <button id="feedback_button" @click="openNew(val.id,item.id)">反馈</button>
            </div>
        </div>
    </div>

</body>
<script>
    var app = new Vue({
        el: '.new',
        data: {
            listTitle1: '',
            arrList1: [],
        },
        created: function () {
            this.getList();
        },
        methods: {
            getList() {
                var that = this
                $.ajax({
                    cache: false,
                    type: "post",
                    url: "<?php echo U('Feedback/ProductList');?>",
                    dataType: "json",
                    success: function (data) {
                        $.each(data.data, function (i, data) {
                            that.arrList1.push(data);
                        })
                    }
                })
            },
            //跳转页面
            openNew(nID,oID){
                window.location.href = "<?php echo U('Feedback/submitfeedback');?>"+"&nID="+ nID +"&oID=" + oID;
            },
        },
    });

</script>


<!-- <script src="../Public/static/bootstrap.min.js"></script>   -->

</html>