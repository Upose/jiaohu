<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>fy文件上传</title>
</head>
<body>

		<form action="<?php echo U('Feedback/FeedbackSubmit');?>" enctype="multipart/form-data" method="post" >
		<input type="text" name="name" />
		<input type="file" name="photo" />
		<input type="submit" value="提交" >
		</form>


</body>
</html>