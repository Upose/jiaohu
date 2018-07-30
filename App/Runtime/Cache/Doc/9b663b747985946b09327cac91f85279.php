<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>config</title>
    <link rel="stylesheet" href="/ProjectDelivery/Public/Doc/doclay/plugins/layui/css/layui.css" media="all">
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

		.cus-enable span, .cus-disable span {
			margin: 0px 5px;
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
	<script src="/ProjectDelivery/Public/Doc/doclay/plugins/layui/layui.js"></script>
	<script src="/ProjectDelivery/Public/static/jquery-2.0.3.min.js""></script>
</head>
<body>
	<div class="cus-body">
		<div class="layui-row">
			<button type="button" id="add-feed" class="cus-btn">新增</button>
		</div>
		<div>
			<table id="feed-table" class="layui-table cus-table">
				<colgroup>
					<col width="80">
					<col width="200">
					<col width="600">
					<col width="80">
					<col width="80">
				</colgroup>
				<thead>
					<tr class="cus-tr-bold">
						<th>序号</th>
						<th>名称</th>
						<th>描述</th>
						<th>状态</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody id="feed-tbody"></tbody>
			</table>
			<div id="feed-page"></div>
		</div>
	</div>
	<script>
		var addFeed = document.getElementById('add-feed');
		var pageIndex = 1, limit = 10; // 页面索引, 页面显示条数
		
		// 渲染列表数据
		function tableInit(data) {
			var tBody = document.getElementById('feed-tbody');
			var str = '';

			// 处理数据
			data.forEach(function(item, idx) {
				if(item.status == '启用') {
					str += '<tr><td>'+ item.id +'</td><td>'+ item.name +'</td><td>'+ item.summary +'</td><td class="cus-enable">'+ item.status +'</td><td><span>编辑</span></td></tr>';
				} else {
					str += '<tr><td>'+ item.id +'</td><td>'+ item.name +'</td><td>'+ item.summary +'</td><td class="cus-disable">'+ item.status +'</td><td><span class="cus-enable">编辑</span></td></tr>';
				}
			});

			tBody.innerHTML = str;
		}
		
		// 添加配置项
		addFeed.onclick = function() {
			var addContent = document.getElementById('add-content');
			layui.use('layer', function() {
				var layer = layui.layer;

				layer.open({
					title: '添加配置',
					type: 2,
					shadeClose: true,
					closeBtn: 1,
					area: ['500px', '350px'],
					content: "<?php echo U('feedback/addconfig');?>"
				});
			})
		};
		
		// 分页初始化
		function layPageInit() {
			layui.use('laypage', function() {
				var laypage = layui.laypage;
				laypage.render({
					elem: 'feed-page',
					limit: limit,
					curr: 1,
					count: 10,
					jump: function(obj, first) {
						if(first) {
							return false;
						}

						pageIndex = obj.curr;
						limit = obj.limit;

						getFeedList(pageIndex, limit);
					}
				})
			})
		}
		
		// 获取数据
		function getFeedList(pageIndex, limit) {
			pageIndex = pageIndex || 1;
			limit = limit || 10;

			$.ajax({
				cache: false,
				type: "POST",
				url: "<?php echo U('Feedback/problem');?>",
				dataType: "json",
				data: {
					pageIndex: pageIndex,
					limit: limit
				},
				success: function(res) {
					tableInit(res.data);
					layPageInit();
				},
				fail: function(err) {
					console.log(err);
				}
			});
		};

		getFeedList(pageIndex, limit);
	</script>
</body>
</html>