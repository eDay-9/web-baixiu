<?php 
	require_once('../../config.php');
	(!isset($current_user['avatar'])) ? $avatar = '../../static/assets/images/default.png' : $avatar = $current_user['avatar'];;
	$conn = mysqli_connect(DB_SERVER_IP, DB_USER, DB_PASSWORD, DB_DATABASE);
	if(!$conn) exit('用户连接失败！');
	$result = mysqli_query($conn,"SELECT * from menus");
	if(!$result) exit('用户查询失败');
	$menus = mysqli_fetch_all($result,MYSQLI_ASSOC);
	$json = json_encode($menus);
	echo json_encode($menus);
	
	
