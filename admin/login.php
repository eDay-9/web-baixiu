<?php 
	require_once('../config.php');
	require_once('inc/common.php');

	function login(){
		//TODO ：验证 登录
		//页面验证
		if(!isset($_POST['email']) || !isset($_POST['password'])) { 
			$GLOBALS['message'] = '参数错误！'; 
			return;
		} 
		// 业务
		$email = $_POST['email'];
		$password = $_POST['password'];
		$result = query("select * from users where email = '" . $email . "' limit 1");
		if($result->message != DB_STATUS_SQL_SUCCESS || count($result->data) == 0){
			$GLOBALS['message'] = '用户名或密码错误';
			return;
		}
		$user =($result->data)[0];
		if($user['password'] !== $password){
			$GLOBALS['message'] = '用户名或密码错误';
			return;
		}
		// 进入主页
		session_start();
		$_SESSION['user'] = $user;
		session_write_close();

		header("Location: /admin/index.php",true,301);
		exit();
	}

	$Q_METHOD = $_SERVER['REQUEST_METHOD'];
	
	if($Q_METHOD == 'POST'){
		login();
	}
	if($Q_METHOD == 'GET'){
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Cache-Control" content="no-cache" />
	<title>Login in << Admin</title>
	<link rel="stylesheet" href="../static/verdors/bootstraps/css/bootstrap.css">
	<link rel="stylesheet" href="../static/assets/css/admin.css">
</head>
<body>
	<div class="login">
		<form class="login-wrap" action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate="off">
			<img class="avatar" src="../static/assets/images/default.png" alt="头像">
				<?php if(!empty($message)) : ?>
				<div class="alert alert-danger">
			        <strong>错误！</strong>  <?php echo $message; ?>
			      </div>
			  <?php endif ?>
			<div class="form-group">
				<label for="email" class="sr-only">邮箱</label>
				<input type="text"  id="email" name="email" class="form-control" />
			</div>
			<div class="form-group">
				<label for="password" class="sr-only">密码</label>
				<input type="text" id="password" name="password" class="form-control" />
			</div>
			<button class="btn btn-primary btn-block">登录</button>			
		</form>
	</div>	
</body>
</html>