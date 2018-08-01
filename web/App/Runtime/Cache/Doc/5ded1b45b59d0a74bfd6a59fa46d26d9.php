<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Document</title>
    <link rel="stylesheet" href="/DeliveryApplication/Public/Doc/doclay/plugins/layui/css/layui.css" media="all">
    <style>
    	/**
    	 * 全局样式
    	 */
    	* {
    		box-sizing: border-box;
    	}

    	html, body {
    		font: inherit;
    		color: inherit;
    		font-family: PingFangSC;
    	}

    	/**
    	 * 自定义样式
    	 */
    	.cus-body {
    		height: 100%;
    		widows: 100%;
    		padding: 0px 74px;
    	}

    	.cus-btn {
    		padding: 4px 8px;
    		border-radius: 4px;
    		border: 1px solid rgba(7, 200, 141, 1);
    		background: rgba(7, 200, 141, 1);
    		color: #fff;
    		cursor: pointer;
    		margin-top: 10px;
    	}

    	.cus-fixed-btn {
    		position: fixed;
    		bottom: 30px;
    		right: 20px;
    	}

    	.btn-cancle {
    		background: #fff;
    		border: 1px solid rgba(217, 217, 217, 1);
    		color: #000;
    	}

    	.cus-tr-bold > th {
    		font-weight: bold;
    	}

    	.cus-enable {
    		color: #4A90E2;
    		cursor: pointer;
    	}

    	.cus-disable {
    		color: rgba(236, 65, 65, 0.65);
    		cursor: pointer;
    	}

    	.cus-model {
    		padding: 10px;
    		font-size: 12px;
    	}

    	.cus-fontbold {
    		font-weight: bold;
    	}

    	/**
    	 * 对layui的样式重置
    	 */
    	.layui-form-label, .layui-layer-title {
    		font-size: 14px;
    		font-weight: bold;
    	}

    	.layui-form-radio > span, .layui-layer-btn, .cus-btn, .cus-tr-bold > th, .cus-table > tbody > tr > td {
    		font-size: 12px;
    	}
    </style>
	<script src="/DeliveryApplication/Public/Doc/doclay/plugins/layui/layui.js"></script>
	<script src="/DeliveryApplication/Public/static/jquery-2.0.3.min.js""></script>
</head>
<body>
	<div id="add-content" class="cus-model">
		<form action="" class="layui-form">
			<div class="layui-form-item">
				<label class="layui-form-label">名称:</label>
				<div class="layui-input-block">
					<input type="text" name="feedName" required lay-verify="required" placeholder="请输入名称" autocomplete="off" class="layui-input" id="product_name" max="20" />
				</div>
			</div>			
			<div class="layui-form-item">
				<label class="layui-form-label">描述:</label>
				<div class="layui-input-block">
					<textarea name="desc" placeholder="请输入描述" class="layui-textarea" id="product_describe"></textarea>
				</div>
			</div>
			<div class="layui-form-item" id="level">
				<label class="layui-form-label">层级:</label>
				<div class="layui-input-block">
					<input type="radio" name="sex" value="1" title="父级" checked class="layer">
					<input type="radio" name="sex" value="2" title="子级" class="layer" id="child-level">
				</div>
			</div>
			<div class="layui-form-item" id="parent-level">
				<label class="layui-form-label">父级:</label>
				<div class="layui-input-block">
					<section name="city" lay-verify="required">
						
					</section>
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
			
			// 表单验证
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
				url: "<?php echo U('Feedback/addProduct');?>",
				dataType: "json",
				data: {
					name: $('#product_name').val(),
					summary: $('#product_describe').val(),
					level: $('.layer:checked').val(),
					f_id: $('#parent-level select').val()
				},
				success: function(res) {
		    		window.parent.location.reload();
				},
				fail: function(err) {
					console.log(err);
				}
			});
		};
		
		// 点击取消按钮
		submitCancle.onclick = function() {
		    window.parent.location.reload();
		};
		
		// 点击选择层级
		$('#level').on('click', function() {
			if($('#child-level').is(":checked")) {
				$.ajax({
					cache: false,
					async: false,
					type: "POST",
					url: "<?php echo U('Feedback/ParentProduct');?>",
					dataType: "json",
					data: {},
					success: function(res) {
						$('#parent-level .layui-input-block').html('');
						var select = $('<select name="city" lay-verify="required"></select>')
						var str = '';

						res.data.forEach(function(item, idx) {
							str += '<option value="'+ item.id +'">'+ item.name +'</option>'
						});

						select.html(str);
						
						$('#parent-level .layui-input-block').append(select);
						layui.use('form', function() {
							layui.form.render();
						})
						$('#parent-level').show();
					},
					fail: function(err) {
						console.log(err);
					}
				});
			} else {
				$('#parent-level').hide();
			}
		})
	</script>
</body>
</html>