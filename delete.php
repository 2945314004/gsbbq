<?php
session_start();

$id = $_GET["id"];

require_once 'config.php';

// 创建数据库连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 判断是否有权限删除该记录
$sql = "SELECT * FROM biao WHERE id='" . $id . "' AND user_id='" . $_SESSION["user_id"] . "'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 有权限删除记录
    $sql = "DELETE FROM biao WHERE id='" . $id . "' AND user_id='" . $_SESSION["user_id"] . "'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('删除成功！');window.location.reload();window.history.go(-1);</script>";
        
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // 没有权限删除记录
    echo "<script>alert('这不是你发表的不能删除！');history.back();</script>";
}

$conn->close();
?>