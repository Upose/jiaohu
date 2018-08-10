<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/Public/Doc/doclay/plugins/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/Public/Doc/css/custom.css">
    <script src="/Public/Doc/doclay/plugins/layui/layui.js"></script>
    <script src="/Public/static/jquery-2.0.3.min.js"></script>
</head>
<body>
    <div id="add-content" class="cus-model">
        <form action="" class="layui-form">
            <input type="hidden" id="edit_id" />
            <div class="layui-form-item">
                <label class="layui-form-label">名称:</label>
                <div class="layui-input-block">
                    <input type="text" name="feedName" required lay-verify="required" placeholder="请输入名称" autocomplete="off" class="layui-input" id="product_name" />
                </div>
            </div>          
            <div class="layui-form-item">
                <label class="layui-form-label">描述:</label>
                <div class="layui-input-block">
                    <textarea name="desc" placeholder="请输入描述" class="layui-textarea" id="product_describe"></textarea>
                </div>
            </div>
            <div class="layui-form-item" id="product_status">
                <label class="layui-form-label">状态:</label>
                <div class="layui-input-block">
                    <input type="radio" name="sex" value="启用" title="启用" class="layer">
                    <input type="radio" name="sex" value="禁用" title="禁用" class="layer">
                </div>
            </div>
            <div class="layui-form-item cus-fixed-btn">
                <div class="layui-input-block">
                    <button type="button" class="cus-btn btn-cancle" id="submitCancle">取消</button>
                    <button type="button" class="cus-btn" id="submitForm">确认</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        var submitForm = document.getElementById('submitForm');
        var submitCancle = document.getElementById('submitCancle');
        // form表单初始化
        layui.use('form', function() {
            var form = layui.form;
        });

        // 提交数据
        submitForm.onclick = function() {
            var product_name = $('#product_name').val();
            var product_describe = $('#product_describe').val();
            var id = $('#edit_id').val();
            
            if(product_name == '' || product_describe === '') {
                layui.use('layer', function() {
                    layui.layer.alert('名称或描述不能为空!');
                })

                return false;
            }

            if(product_name.length > 20) {
                layui.use('layer', function() {
                    layui.layer.alert('名称长度不能大于20!');
                })

                return false;
            }
            $.ajax({
                cache: false,
                async: false,
                type: "POST",
                url: "<?php echo U('BackstageManagement/UpdateProblem');?>",
                dataType: "json",
                data: {
                    name: $('#product_name').val(),
                    summary: $('#product_describe').val(),
                    status: $('.layer:checked').val(),
                    id: id
                },
                success: function(res) {
                    layui.use('layer', function() {
                        layui.layer.alert('修改成功!', function() {
                            window.parent.location.reload();
                        });
                    })
                },
                fail: function(err) {
                    console.log(err);
                }
            });
        }

        // 点击取消按钮
        submitCancle.onclick = function() {
            window.parent.location.reload();
        };
    </script>
</body>
</html>