<?php
  // 获取要删除的用户ID
  $id = $_POST['id'];

  // 连接数据库
  $conn = mysqli_connect('你的数据库ip', 'biao', '294531', 'biao');
  if (!$conn) {
    die('连接数据库失败：' . mysqli_connect_error());
  }

  // 删除用户信息
  $sql = "DELETE FROM users WHERE id = $id";
  if (mysqli_query($conn, $sql)) {
    echo '用户信息删除成功';
  } else {
    echo '用户信息删除失败：' . mysqli_error($conn);
  }

  // 关闭数据库连接
  mysqli_close($conn);
?>