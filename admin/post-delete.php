<?php 
require_once('../config.php');
require_once('inc/common.php');

$Q_METHOD = $_SERVER['REQUEST_METHOD'];
if($Q_METHOD == 'GET'){
	$id = $_GET['id'];
	var_dump($id);

	$sql = "DELETE FROM posts where id = '" . $id . "'";
	$result = delete($sql);
	if($result->message == DB_STATUS_SQL_SUCCESS){
		header('Location: /admin/posts.php');
	}
}