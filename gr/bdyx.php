<?php
// 开始 session
session_start();

// 判断用户是否已登录，如果未登录则跳转到登录页面
if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit();
}

// 连接数据库
require_once 'config.php';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("连接失败：" . $conn->connect_error);
}

// 处理用户提交的表单
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user_id = $_SESSION["user_id"];
  $email = $_POST["email"];

  // 更新用户信息
  $sql = "UPDATE users SET email = '$email' WHERE id = '$user_id'";
  if ($conn->query($sql) === TRUE) {
    $_SESSION["email"] = $email;
    header("Location: /gr");
    exit();
  } else {
    $error_message = "绑定失败，请稍后再试。";
  }
}

// 查询用户信息
$user_id = $_SESSION["user_id"];
$sql = "SELECT email FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $email = $row["email"];
} else {
  $email = "";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>绑定邮箱</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		body {
			background-color: #f2f2f2;
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}
		h1 {
			background-color: #4CAF50;
			color: #fff;
			padding: 20px;
			text-align: center;
			margin-top: 0;
		}
		form {
			margin: 20px auto;
			max-width: 500px;
			padding: 20px;
			background-color: #fff;
			box-shadow: 0 0 10px rgba(0,0,0,0.2);
			border-radius: 5px;
			text-align: center;
		}
		label {
			display: block;
			margin-bottom: 10px;
			font-weight: bold;
		}
		input[type="email"] {
			padding: 10px;
			border-radius: 5px;
			border: 1px solid #ccc;
			width: 100%;
			box-sizing: border-box;
			margin-bottom: 20px;
		}
		input[type="submit"] {
			background-color: #4CAF50;
			color: #fff;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			font-size: 16px;
		}
		input[type="submit"]:hover {
			background-color: #3e8e41;
		}
	</style>
</head>
<body>
	<h1>绑定邮箱</h1>
	<?php if (isset($error_message)): ?>
		<p style="color: red;"><?php echo $error_message; ?></p>
	<?php endif; ?>
	<form method="post">
		<label for="email">邮箱：</label>
		<input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
		<input type="submit" value="提交">
	</form>
</body>
</html>