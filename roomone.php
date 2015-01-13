<?php
	require_once 'protected/config.php';
	require_once 'protected/GenerUtil.php';
	if (!isset($_SESSION['max'])) {
		$_SESSION['max'] = 0;
	}
?>
<html>
	<head>
		<meta charset="utf-8" />
		<title>聊天室</title>
		<link rel="stylesheet" type="text/css" href="css/common.css" />
		<script type="text/javascript" src="js/front.js"></script>
	</head>
	<body>
		<div id="chatbody" class="chatdialog">
		</div>
		<p>作者</p>
		<input id="author" type="text" name="name" value=""/> <br />
		<textarea id="content" rows="10" cols="20" name="value"></textarea>
		<div id="submit" class="button">提交</div>
	</body>
</html>