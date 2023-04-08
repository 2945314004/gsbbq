<?php 
// 开始 session
session_start();

// 判断用户是否已经登录，如果已经登录，则跳转到表白墙主页
if (isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 连接数据库
    require_once 'config.php';
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("连接失败：" . $conn->connect_error);
    }

    // 获取用户提交的注册信息
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // 判断用户名和密码是否少于六位数或包含中文或空格
    if (strlen($username) < 4 || strlen($password) < 4 || preg_match("/[\x{4e00}-\x{9fa5}\s]+/u", $username) || preg_match('/\s/', $password)) {
        $error_message = "用户名和密码不能少于四位数，且不能包含中文和空格。";
        echo "<script>alert('$error_message');</script>";
    } else {
        // 判断用户名长度是否超过20个字
        if (strlen($username) > 30) {
            $error_message = "用户名长度不能超过20个字。";
            echo "<script>alert('$error_message');</script>";
        } else {
            // 验证用户名是否已经被注册
            $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $error_message = "用户名已经被注册，请选择其他用户名。";
                echo "<script>alert('$error_message');</script>";
            } else {
                // 将用户信息插入数据库中
                $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
                $stmt->bind_param("ss", $username, $password);
                if ($stmt->execute()) {
                    // 注册成功，跳转到登录页面
                    header("Location: login.php");
                    exit();
                } else {
                    $error_message = "注册失败，请稍后再试。";
                    echo "<script>alert('$error_message');</script>";
                }
            }
        }
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
    <title>注册</title>
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
    
    /* 注册提示样式 */
    .register-tip {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
    }
    
    .register-tip a {
      color: #4CAF50;
      text-decoration: none;
    }
    
    .register-tip a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
<h1 style="text-align: center;">注册</h1>
<?php if (isset($error_message)) {
    echo "<p style='color: red; text-align: center;'>" . $error_message . "</p>";
} ?>
<form method="post">
    <label>用户名：</label>
    <input type="text" name="username" required maxlength="20">
    <label>密码：</label>
    <input type="password" name="password" required>
    <input type="submit" value="注册">
</form>
<div class="register-tip">
    <p>已有账号？<a href="login.php">立即登录</a></p>
</div>
</body>
</html>