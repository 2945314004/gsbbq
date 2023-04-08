<?php 
session_start(); 
if (!isset($_SESSION["user_id"])) { 
    // 如果未登录，跳转到登录页面 
    header("Location: login.php"); 
    exit(); 
} 

$error_message = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // 处理表单提交 
    $old_password = $_POST["old_password"]; 
    $new_password = $_POST["new_password"]; 
    $new_password2 = $_POST["new_password2"]; 

    if ($new_password != $new_password2) { 
        // 两次新密码不一致 
        $error_message = "两次输入的新密码不一致。"; 
    } else { 
        // 连接数据库 
        $conn = new mysqli("你的数据库ip", "biao", "294531", "biao"); 

        // 使用预处理语句和绑定参数来防止SQL注入 
        $stmt = $conn->prepare("SELECT id FROM users WHERE id = ? AND password = ?"); 
        $stmt->bind_param("is", $_SESSION["user_id"], $old_password); 
        $stmt->execute(); 
        $result = $stmt->get_result(); 

        if ($result->num_rows == 1) { 
            // 旧密码验证成功，更新密码 
            $stmt = $conn->prepare("UPDATE users SET password=? WHERE id=?"); 
            $stmt->bind_param("si", $new_password, $_SESSION["user_id"]); 
            $stmt->execute(); 

            // 关闭数据库连接 
            $stmt->close(); 
            $conn->close(); 

            // 弹窗提示修改成功 
            echo "<script>alert('密码修改成功。');</script>"; 
        } else { 
            // 旧密码验证失败 
            echo "<script>alert('旧密码错误。');</script>";
        } 
    } 
} 
?> 
<!DOCTYPE html> 
<html> 
<head> 
    <meta charset="utf-8"> 
    <title>修改密码 - 表白墙</title> 
     <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }
    h1 {
      text-align: center;
      margin-top: 50px;
      margin-bottom: 30px;
    }
    form {
      max-width: 500px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
    label {
      display: block;
      margin-bottom: 10px;
    }
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      margin-bottom: 20px;
      box-sizing: border-box;
    }
    input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }
    input[type="submit"]:hover {
      background-color: #3e8e41;
    }
    p {
      color: red;
      margin-top: 10px;
    }
  </style>
</head> 
<body> <br><br><br>
        <nav style="background-color: #4CAF50; color: white; display: flex; justify-content: space-between; align-items: center; padding: 10px; position: fixed; top: 0; width: 100%;">
        <a href="javascript:history.back()" style="color: white; font-size: 20px; text-decoration: none;">
        返回
        </a>
        <h1 style="margin: 0; font-size: 28px;">个人信息管理</h1>
        <div style="width: 40px;"></div>
        </nav>
    

    <h1 style="text-align: center;">修改密码</h1> 
    <form method="post"> 
        <label>旧密码：</label> 
        <input type="password" name="old_password" required> 
        <label>新密码：</label> 
        <input type="password" name="new_password" required> 
        <label>重复新密码：</label> 
        <input type="password" name="new_password2" required> 
        <input type="submit" value="修改密码"> 
        <?php if ($error_message != "") { echo "<p>" . $error_message . "</p>"; } ?> 
    </form> 
</body> 
</html> 