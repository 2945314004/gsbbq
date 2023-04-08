<?php
    session_start();
    // 检查是否登录
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('请先登录！');window.location.href='login.php';</script>";
    }

    require_once 'config.php';
    
    // 获取当前用户ID
    $user_id = $_SESSION["user_id"];
    
    // 获取要更新的表白信息ID和内容
    $id = $_POST["id"];
    $title = $_POST["title"];
    $content = $_POST["content"];
    $to_name = $_POST["to_name"];
    $message = $_POST["message"];
    
    // 更新表白信息
    $query = "UPDATE biao SET title='$title', content='$content', to_name='$to_name', message='$message' WHERE id='$id' AND user_id='$user_id'";
    if ($conn->query($query) === TRUE) {
        echo "<script>alert('表白信息已更新！');window.location.href='my_biao.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    
    $conn->close();
?>
