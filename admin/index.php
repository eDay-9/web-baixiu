<?php 
	require_once('../config.php');
	require_once('inc/common.php');
	function getNums($sql){
		$result = query($sql);
		return count($result->data);
	}
	// $nums_posts = getNums_posts("select * from posts");
	// $nums_catagories = getNums_catagories("select * from catagories");
	// $nums_comments = getNums_comments("select * from comments");
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
	<div class="main">
		<!-- 导航栏 -->
		<div class="navbar">
		</div>
		<!-- 内容 -->
		<div class="container-fluid">
			<div class="jumbotron text-center">
			 	<h1>One Belt, One Road</h1>
			  	<p>Thoughts, stories and ideas.</p>
			  	<p><a class="btn btn-primary btn-lg" href="#" role="button">写文章</a></p>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="panel panel-default">
						  <!-- Default panel contents -->
						  <div class="panel-heading">站点内容统计：</div>
						  <ul class="list-group">
						    <li class="list-group-item">Cras justo odio</li>
						    <li class="list-group-item">Dapibus ac facilisis in</li>
						    <li class="list-group-item">Morbi leo risus</li>
						  </ul>
					</div>
				</div>
				<div class="col-md-4">
					<canvas id="chart-area"></canvas>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
	</div>
	
	<?php require_once('inc/footer.php'); ?>
	<script src="../static/assets/js/admin.js"></script>
	<script>
		window.onload = function(){
			loadChart();
		}
	</script>
</body>
</html>