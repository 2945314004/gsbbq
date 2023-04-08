<?php
// 连接数据库
require_once 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 获取用户提交的信息
$contact = $_POST["contact"];
$problem = $_POST["problem"];

// 将信息插入到数据库中
$sql = "INSERT INTO fankui (contact, problem) VALUES ('$contact', '$problem')";

if ($conn->query($sql) === TRUE) {
    echo "问题已提交成功！";
} else {
    echo "提交失败：" . $conn->error;
}

// 关闭数据库连接
$conn->close();
?>