<?php
  // 获取表单提交的用户信息
  $id = $_POST['id'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  // 连接数据库
  $conn = mysqli_connect('你的数据库ip', 'biao', '294531', 'biao');
  if (!$conn) {
    die('连接数据库失败：' . mysqli_connect_error());
  }

  // 更新用户信息
  $sql = "UPDATE users SET username='$username', password='$password', email='$email' WHERE id=$id";
  if (mysqli_query($conn, $sql)) {
    echo '用户信息更新成功';
  } else {
    echo '用户信息更新失败：' . mysqli_error($conn);
  }

  // 关闭数据库连接
  mysqli_close($conn);
?>