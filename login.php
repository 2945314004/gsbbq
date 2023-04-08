<?php
session_start();
if (isset($_SESSION["user_id"])) {
    // 如果已经登录，跳转到主页
    header("Location: index.php");
    exit();
}

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 处理表单提交
    $username = $_POST["username"];
    $password = $_POST["password"];
    $ip = $_SERVER['REMOTE_ADDR']; // 获取用户IP地址

    // 连接数据库
    $conn = new mysqli("你的数据库ip", "biao", "294531", "biao");

    // 使用预处理语句和绑定参数来防止SQL注入
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // 登录成功
        $row = $result->fetch_assoc();
        $_SESSION["user_id"] = $row["id"];

        // 更新用户IP地址到数据库
        $user_id = $row["id"];
        $stmt = $conn->prepare("UPDATE users SET ip=? WHERE id=?");
        $stmt->bind_param("si", $ip, $user_id);
        $stmt->execute();

        header("Location: index.php");
        exit();
    } else {
        // 登录失败
        $error_message = "用户名或密码错误。";
    }

    // 关闭数据库连接
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>登录 - 表白墙</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    /* 全局样式 */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    
    /* 表单样式 */
    form {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      background-color: #f2f2f2;
      border-radius: 10px;
    }
    
    label {
      display: block;
      margin-bottom: 5px;
    }
    
    input[type="text"],
    input[type="password"] {
      display: block;
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 5px;
      margin-bottom: 10px;
      box-sizing: border-box;
    }
    
    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    
    input[type="submit"]:hover {
      background-color: #3e8e41;
    }
    
    /* 响应式样式 */
    @media screen and (max-width: 600px) {
      form {
        max-width: 100%;
        border-radius: 0;
      }
    }
  </style>
</head>
<body>
  <h1 style="text-align: center;">登录表白墙</h1>
  <form method="post">
    <label>用户名：</label>
    <input type="text" name="username" required>
    <label>密码：</label>
    <input type="password" name="password" required>
    <label for="disclaimer">
      <input type="checkbox" id="disclaimer" name="disclaimer" required>
      我已阅读并同意<a href="/ggao/mz.php">免责声明</a>和<a href="/ggao/tiaoyue.php">用户条约</a>
    </label>
    <input type="submit" value="登录">
    <?php if ($error_message != "") { echo "<p>" . $error_message . "</p>"; } ?>
  </form>
  <p style="text-align: center;">还没有账号？<a href="register.php">立即注册</a></p>

</body>
</html>