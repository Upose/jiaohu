<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>feedback</title>
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
	<script src="/DeliveryApplication/Public/Doc/doclay/plugins/layui/layui.js"></script>
	<script src="/DeliveryApplication/Public/static/jquery-2.0.3.min.js""></script>
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
					<col width="150">
					<col width="500">
					<col width="130">
					<col width="150">
				</colgroup>
				<thead>
					<tr class="cus-tr-bold">
						<th>序号</th>
						<th>名称</th>
						<th>描述</th>
						<th>父级</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody id="feed-tbody">
					<tr>
						<td>1</td>
						<td>我是内容</td>
						<td>我是描述</td>
						<td class="cus-enable">父级</td>
						<td class="cus-enable">编辑</td>
					</tr>
				</tbody>
			</table>
			<div id="feed-page"></div>
		</div>
	</div>
	<script>
		var addFeed = document.getElementById('add-feed');
		var pageIndex = 1, limit = 10;
		var layer = layui.layer;
		var ares = [];
		
		// 渲染列表数据
		function tableInit(data) {
			console.log(data);
			var tBody = document.getElementById('feed-tbody');
			var str = '';
			ares = JSON.parse(JSON.stringify(data.ares));

			// 处理数据
			data.ares.forEach(function(item, idx) {
				str += '<tr><td colspan="4" style="font-weight: bold; font-size: 14px;">'+ item.name +'</td><td class="cus-enable delete" _id="'+ item.id +'">删除</td></tr>';
				data.res.forEach(function(_item, _idx) {
					if(_item.aname === item.name) {
						str += '<tr><td>'+ _item.id +'</td><td>'+ _item.name +'</td><td>'+ _item.summary +'</td><td class="cus-disable">'+ item.name +'</td><td class="cus-enable"><span>编辑</span><span class="delete" _f_id="'+ _item.f_id +'" _id="'+ item.id +'" style="color: rgba(236, 65, 65, 0.65);">删除</span></td></tr>';
					}
				});
			});

			tBody.innerHTML = str;
		}
		
		// 添加配置项
		addFeed.onclick = function() {
			var addContent = document.getElementById('add-content');
			layui.use('layer', function() {

				layer.open({
					title: '添加产品配置',
					type: 2,
					shadeClose: true,
					closeBtn: 1,
					area: ['500px', '400px'],
					content: "<?php echo U('feedback/addproduct');?>",
					success: function(layero, idx) {
						var body = layui.layer.getChildFrame('body', idx);
						var iptblock = $(body).find('#parent-level').hide();
					}
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
				url: "<?php echo U('Feedback/Product');?>",
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
		}

		// 删除
		$('#feed-table').on('click', '.delete', function(e) {
			var data = {};
			data.id = $(this).attr('_id');
			// 判断删除的是否为父级
			if(!$(this).attr('_f_id')) {
				// 不存在父级id则不传f_id
				data.f_id = 0;
			} else {
				data.f_id = $(this).attr('_f_id');
			}

			$.ajax({
				cache: false,
				type: "POST",
				url: "<?php echo U('Feedback/softdelete');?>",
				dataType: "json",
				data: data,
				success: function(res) {
					// 刷新页面, 会写数据
					window.location.reload();	
				},
				fail: function(err) {
					console.log(err);
				}
			});
		})

		getFeedList(pageIndex, limit);
	</script>
</body>
</html>