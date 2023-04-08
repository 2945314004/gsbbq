<?php
// 开始 session
session_start();

// 判断用户是否已登录，如果未登录则跳转到登录页面
if (!isset($_SESSION["user_id"])) {
  header("Location: /login.php");
  exit();
}

// 连接数据库
require_once 'config.php';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("连接失败：" . $conn->connect_error);
}

// 查询用户信息
$user_id = $_SESSION["user_id"];
$sql = "SELECT id, email, username FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $user_id = $row["id"];
  $email = $row["email"];
  $username = $row["username"];
} else {
  $user_id = "未知";
  $email = "未绑定邮箱";
  $username = "未知";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>个人主页</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		body {
			background-color: #f2f2f2;
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}
		header {
			background-color: #4CAF50;
			color: #fff;
			padding: 20px;
			text-align: center;
		}
		h1 {
			margin-top: 0;
		}
		nav {
			background-color: #333;
			color: #fff;
			padding: 10px;
			text-align: center;
		}
		nav ul {
			list-style: none;
			margin: 0;
			padding: 0;
		}
		nav ul li {
			display: inline-block;
			margin: 0 10px;
		}
		nav ul li a {
			color: #fff;
			text-decoration: none;
			padding: 10px;
		}
		nav ul li a:hover {
			background-color: #fff;
			color: #333;
		}
		section {
			margin: 20px;
		}
		section h2 {
			border-bottom: 1px solid #ccc;
			margin-bottom: 10px;
			padding-bottom: 5px;
		}
		footer {
			background-color: #333;
			color: #fff;
			padding: 10px;
			text-align: center;
			position: absolute;
			bottom: 0;
			width: 100%;
			height: 40px;
			line-height: 40px;
		}
	</style>
</head>
<body>
	<header>
		<h1>个人主页</h1>
	</header>
	<nav>
		<ul>
			<li><a href="/">首页</a></li>
			<li><a href="/my.php">我的发表记录</a></li>
			<li><a href="newpassword.php">修改密码</a></li>
		</ul>
	</nav>
	<!--<section>-->
	<!--	<h2>个人简介</h2>-->
	<!--	<p>我是一个热爱编程的程序员，喜欢研究新技术，喜欢挑战自己。</p>-->
	<!--</section>-->
	<section>
		<h2>个人信息</h2>
		<ul>
			<li>账号:<?php echo $username; ?></li><br>
			<li>邮箱:<?php echo $email ? $email : "未绑定邮箱"; ?></li> 
			<a href="bdyx.php">修改/绑定邮箱</a><br>
			<br><li>JavaScript</li>
		</ul>
	</section>
	<footer>
		&copy; 2023 - All GS.
	</footer>
</body>
</html>