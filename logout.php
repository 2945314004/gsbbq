<?php
	// 开始 session
	session_start();

	// 将 session 变量清空
	$_SESSION = array();

	// 删除 session cookie
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
	}

	// 销毁 session
	session_destroy();

	// 跳转到登录页面
	header("Location: login.php");
	exit();
?>