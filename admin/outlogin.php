<?php
// 启动会话
session_start();

// 清除管理员会话数据
unset($_SESSION['admin']);

// 清除管理员cookie
setcookie('admin', '', time()-3600);

// 跳转到登录页面
header('Location: login.php');
exit;
?>