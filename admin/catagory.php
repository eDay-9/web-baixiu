<?php 
	require_once('../config.php');
	require_once('inc/common.php');

	$sql = "select * from posts";
	$result = query($sql);
	
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Index >> Admin</title>
	<?php require_once('inc/header.php'); ?>
</head>
<body>
	<!-- 侧边 -->
	<div class="aside">
	</div>
	<!-- 版心 -->
	<div id="posts" class="main">
		<!-- 导航栏 -->
		<div class="navbar">
		</div>
		<!-- 内容 -->
		<div class="container-fluid">
			
		</div>
	</div>
	
	<?php require_once('inc/footer.php'); ?>
	<script src="../static/assets/js/admin.js"></script>
	
</body>
</html>