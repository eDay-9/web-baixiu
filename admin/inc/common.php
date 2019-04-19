<?php 
	 // require('../../config.php');
	$current_user = (Object)array();
	
	class DBResult 
	{
		public $status;
		public $message;
		public $data;
		public $count;
		function getStatus(){
			return $this->status;
		}
		function setStatus($status){
			$this->status = $status;
		}
		function setMessage($message){
			$this->message = $message;
		}
		function getMessage(){
			return empty($this->message) ? '' : $this->message;
		}
		function setData($data){
			return $this->data = $data;
		}
		function getData(){
			return empty($this->data) ? array() : $this->data;
		}
		function getCount(){
			return empty($this->data) ? 0 : count($this->data);
		}
	}


	function isLogin(){
		//用户登录权限
		session_start();
		if(!isset($_SESSION['user'])){
			header("Location: /admin/login.php",true,301);
			exit();
		}
	}
	if( $_SERVER['REQUEST_URI'] !==  NO_IS_LOGIN_IN_URL ){
		isLogin();
	}

	function query($sql){
		$result = new DBResult();
		$conn = mysqli_connect( DB_SERVER_IP , DB_USER , DB_PASSWORD , DB_DATABASE);
		if(!$conn) {
			$result->setMessage(DB_STATUS_CONNECT_FAIL);
			return $result;
		} 
		$rows = mysqli_query($conn,$sql);
		if(!$rows) {
			$result->setMessage(DB_STATUS_SQL_PARAMS);
			return $result;
		}
		$data = array();
		while ($row = mysqli_fetch_assoc($rows)) {
			array_push($data, $row);
		}
		$result->setMessage(DB_STATUS_SQL_SUCCESS);
		$result->setData($data);
		mysqli_close($conn);
		return $result;
	}

	// 数据库链接

	// function query($sql){
	// 	$result = (Object)Array();
	// 	$conn = mysqli_connect( DB_SERVER_IP , DB_USER , DB_PASSWORD , DB_DATABASE);
	// 	if(!$conn) {
	// 		$result->setMessage(DB_STATUS_CONNECT_FAIL);
	// 		$result->data = [];
	// 		return ;
	// 	} 
	// 	$rows = mysqli_query($conn,$sql);
	// 	if(!$rows) {
	// 		$result->message = DB_STATUS_SQL_PARAMS;
	// 		$result->data = [];
	// 		return ;
	// 	}
	// 	$data = Array();
	// 	while($row = mysqli_fetch_assoc($rows)){
	// 		$data[] = $row ;
	// 	} 
	// 	$result->message = DB_STATUS_SQL_SUCCESS;
	// 	$result->data = $data;
	// 	mysqli_close($conn);
	// 	return $result;
	// }

	// $result = getResult("select * from users");
	// echo json_encode($result);
	
	// 返回关联数组
	function insert($sql){
		$result = new DBResult();
		$conn = mysqli_connect( DB_SERVER_IP , DB_USER , DB_PASSWORD , DB_DATABASE);
		if(!$conn) {
			$result->setMessage(DB_STATUS_CONNECT_FAIL);
			return $result;
		} 
		$rows = mysqli_query($conn,$sql);
		if(!$rows) {
			$result->setMessage(DB_STATUS_SQL_PARAMS);
			return $result;
		}
		$result->setMessage(DB_STATUS_SQL_SUCCESS);
		return $result;
	}

	function delete($sql){
		$result = new DBResult;
		$conn = mysqli_connect( DB_SERVER_IP , DB_USER , DB_PASSWORD , DB_DATABASE);
		if(!$conn) {
			$result->setMessage(DB_STATUS_CONNECT_FAIL);
			return $result;
		} 
		$rows = mysqli_query($conn,$sql);
		if(!$rows) {
			$result->setMessage(DB_STATUS_SQL_PARAMS);
			return $result;
		}
		$result->setMessage(DB_STATUS_SQL_SUCCESS);
		return $result;
	}


	// $uuid = uniqid();
	// var_dump($uuid);
	//  insert("insert into users(id,email,`password`,`name`,avatar,status,create_date,last_modify_date) 
	//  				values ('3','123@163.com','123','小李','/uploads/avatar.jpg','0','2019-09-09','2019-09-09');");

	// $result = new DBResult();
	// $result = query('select * from posts');
	// var_dump($result->getMessage());
	// var_dump($result->getData());
	// var_dump($result->getCount());
	// $result = new DBResult();
	// $result->setStatus("测试状态");
	// $result->setMessage("测试信息");
	// $result->setData(Array());

	// echo $result->getStatus();
	// echo $result->getMessage();
	// echo json_encode($result->getData());
	