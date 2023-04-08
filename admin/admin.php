<?php
// 启动会话
session_start();

// 检查管理员是否已登录
if (isset($_SESSION['admin'])) {
    // 如果管理员已登录，跳转到管理员页面
    header('Location: index.php');
    exit;
}

// 连接MySQL数据库
$conn = mysqli_connect('localhost', 'biao', '294531', 'biao');

// 检查管理员是否提交了登录表单
if (isset($_POST['submit'])) {
    // 获取管理员输入的用户名和密码
    $admin = $_POST['username'];
    $password = $_POST['password'];

    // 查询管理员账号信息
    $sql = "SELECT * FROM admin WHERE username='$admin' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    // 检查管理员账号信息是否正确
    if (mysqli_num_rows($result) == 1) {
        // 如果管理员账号信息正确，弹窗提示并跳转到管理员页面
        $_SESSION['admin'] = $admin;
        echo "<script>alert('登录成功！');window.location.href='index.php';</script>";
        exit;
    } else {
        // 如果管理员账号信息不正确，弹窗提示并返回登录页面
        echo "<script>alert('用户名或密码错误，请重新登录！');</script>";
    }
}

// 检查是否选择了记住我
if (isset($_POST['remember'])) {
    // 如果选择了记住我，设置cookie
    setcookie('admin', $admin, time()+3600*24*7); // 设置有效期为7天
}

// 检查cookie是否存在，如果存在则自动登录
if (isset($_COOKIE['admin'])) {
    $admin = $_COOKIE['admin'];
    // 查询管理员账号信息
    $sql = "SELECT * FROM admin WHERE username='$admin'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        // 如果管理员账号信息正确，跳转到管理员页面
        $_SESSION['admin'] = $admin;
        header('Location: index.php');
        exit;
    }
}

// 关闭数据库连接
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>管理员登录</title>
</head>
<body>
    <h1>管理员登录</h1>
    <form method="post" action="">
        <p>
            <label for="username">用户名：</label>
            <input type="text" id="username" name="username" required>
        </p>
        <p>
            <label for="password">密码：</label>
            <input type="password" id="password" name="password" required>
        </p>
        <p>
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">记住我</label>
        </p>
        <p>
            <input type="submit" name="submit" value="登录">
        </p>
    </form>
</body>
</html>