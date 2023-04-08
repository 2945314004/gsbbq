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
  <title>个人信息</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }
    h1 {
      text-align: center;
      margin-top: 20px;
      margin-bottom: 30px;
    }
    div {
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      padding: 20px;
      max-width: 400px;
      margin: 0 auto;
    }
    label {
      display: block;
      margin-bottom: 10px;
    }
    input[type="text"],
    input[type="email"] {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      margin-bottom: 20px;
    }
    input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #3e8e41;
    }
    p {
      text-align: center;
      margin-top: 20px;
    }
    a {
      color: #4CAF50;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <h1>个人信息</h1>
  <div>
    <label for="username">用户名：</label>
    <input type="text" id="username" name="username" value="<?php echo $username; ?>" readonly>
    <label for="email">邮箱：</label>
    <input type="text" id="email" name="email" value="<?php echo $email ? $email : "未绑定邮箱"; ?>" readonly>
  </div>
  <p>
    <?php if ($email == "未绑定邮箱"): ?>
      <a href="bdyx.php">修改/绑定邮箱</a>
    <?php else: ?>
      <a href="bdyx.php">修改/绑定邮箱</a>
    <?php endif; ?>
  </p>
</body>
</html>