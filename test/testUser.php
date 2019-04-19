<?php 
session_start();
$current_user = $_SESSION['user'];
echo $current_user['avatar'];
echo json_encode($current_user);
echo isset($current_user->avatar) ;