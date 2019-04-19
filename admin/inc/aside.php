<?php
	require_once('../../config.php');
	require_once('common.php');
	$current_user = $_SESSION['user'];
	if(empty($current_user)){
		header("Location: /admin/login.php");
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Aside >> Admin</title>
	<link rel="stylesheet" href="../../static/verdors/bootstraps/css/bootstrap.css">
	<link rel="stylesheet" href="../../static/assets/css/admin.css">
	<link rel="stylesheet" href="../../static/verdors/font-awesome/css/font-awesome.css">
</head>
<body>
	<div class="aside">
		<div class="profile">
			
			<img class="avatar" src="<?php echo   (!empty($current_user) && isset($current_user['avatar'])) ? $current_user['avatar']: AVATAR_DEFAULT_PATH; 
			?>" >
			<h3 class="name">
				<?php echo (!empty($current_user) && isset($current_user['name'])) ? $current_user['name'] : '匿名'; ?>
			</h3>
		</div>
		<div id="nav_content">
			<script id="nav_wrap" type="text/html">
				<ul class="nav">
					 {{each menus}}
					 	{{if $value.children}}
							<li>
								<a href="#{{$value.inner_url}}" class="collapsed" data-toggle="collapse">
									<i class="{{$value.icon}}"></i>{{$value.name}}<i class="fa fa-angle-right"></i>
								</a>
								<ul id="{{$value.inner_url}}" class="collapse">
									{{each $value.children}}
										<li><a href="{{$value.url}}">{{$value.name}}</a></li>
									{{/each}}
								</ul>
							</li>
					 	{{else}}
							<li ><a  href="{{$value.url}}"><i class="{{$value.icon}}"></i>{{$value.name}}</a></li>
					 	{{/if}}
					 {{/each}}
				</ul>
			</script>

		</div>
	</div>
	<script src="../../static/verdors/jQuery/jquery-1.12.4.js"></script>
	<script src="../../static/verdors/bootstraps/js/bootstrap.js"></script>
	<script src="../../static/verdors/art-template/template-web.js"></script>
	<script src="../../static/assets/js/json.js"></script>
	<script src="../../static/verdors/chartjs/utils.js"></script>
	<script src="../../static/assets/js/admin.js"></script>
</body>
</html>
