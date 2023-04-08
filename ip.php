<?php
// 连接MySQL数据库
$servername = "你的数据库ip";
$username = "数据库名称";
$password = "数据库密码";
$dbname = "数据库表名";

$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
  die("连接失败: " . $conn->connect_error);
}

// 获取用户IP地址
$user_ip = $_SERVER['REMOTE_ADDR'];

// 将用户IP地址存储到MySQL数据库中
$sql = "INSERT INTO users (ip,username) VALUES ('$user_ip',29453)";

if ($conn->query($sql) === TRUE) {
  echo "记录成功";
} else {
  echo "记录失败: " . $conn->error;
}

// 关闭数据库连接
$conn->close();
?>