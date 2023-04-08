<?php
  // 获取要编辑的用户ID
  $id = $_POST['id'];

  // 连接数据库
  $conn = mysqli_connect('你的数据库ip', 'biao', '294531', 'biao');
  if (!$conn) {
    die('连接数据库失败：' . mysqli_connect_error());
  }

  // 查询要编辑的用户信息
  $sql = 'SELECT * FROM users WHERE id = ' . $id;
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $password = $row['password'];
  } else {
    die('未找到对应的用户信息');
  }

  // 关闭数据库连接
  mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>编辑用户信息</title>
</head>
<body>
  <h1>编辑用户信息</h1>
  <form method="post" action="update.php">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <label>用户名：</label>
    <input type="text" name="username" value="<?php echo $username ?>"><br>
    <label>密码：</label>
    <input type="password" name="password" value="<?php echo $password ?>"><br>
    <label>邮箱：</label>
    <input type="email" name="email" value="<?php echo $email ?>"><br>
    <button type="submit">保存</button>
  </form>
</body>
</html>