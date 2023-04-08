<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>找回密码</title>
</head>
<body>
    <h1>找回密码</h1>
    <form method="POST" action="send_password.php">
        <div>
            <label for="email">邮箱地址：</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <button type="submit">发送新密码</button>
        </div>
    </form>
</body>
</html>