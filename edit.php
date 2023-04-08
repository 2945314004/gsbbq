<?php
    session_start();  // 检查是否登录
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('请先登录！');window.location.href='login.php';</script>";
    }

    require_once 'config.php';

    // 创建数据库连接
    $conn = new mysqli($servername, $username, $password, $dbname);

    // 获取当前用户ID
    $user_id = $_SESSION["user_id"];

    // 获取当前记录的ID
    $id = $_GET["id"];

    // 查询当前记录
    $query = "SELECT * FROM biao WHERE id = '$id' AND user_id = '$user_id'";
    $result = $conn->query($query);

    if ($result->num_rows == 0) {
        // 如果当前记录不存在或不属于当前用户，跳转到首页
        echo "<script>alert('记录不存在或不属于当前用户！');window.location.href='index.php';</script>";
    } else {
        $row = $result->fetch_assoc();
    }

    // 处理表单提交
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $major = $_POST["major"];
        $to_name = $_POST["to_name"];
        $message = $_POST["message"];

        // 更新记录
        $query = "UPDATE biao SET name='$name', major='$major', to_name='$to_name', message='$message' WHERE id='$id'";
        $result = $conn->query($query);

        if ($result) {
            // 更新成功，跳转到我的表白页面
            echo "<script>alert('更新成功！');window.location.href='my.php';</script>";
        } else {
            // 更新失败，给出错误提示
            echo "<script>alert('更新失败，请重试！');</script>";
        }
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>编辑表白</title>
        <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f2f2f2;
        }
        nav {
            background-color: #4CAF50;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            position: fixed;
            top: 0;
            width: 100%;
        }
        nav a {
            color: white;
            font-size: 20px;
            text-decoration: none;
        }
        .container {
            margin-top: 80px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
        }
        input[type="text"], textarea {
            margin-top: 5px;
            padding: 10px;
            border-radius: 5px;
            border: none;
            font-size: 16px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }
        input[type="submit"] {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
            border: none;
            font-size: 18px;
            font-weight: bold;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>
    <br><br><br>
    <nav style="background-color: #4CAF50; color: white; display: flex; justify-content: space-between; align-items: center; padding: 10px; position: fixed; top: 0; width: 100%;">
        <a href="javascript:history.back()" style="color: white; font-size: 20px; text-decoration: none;">
            返回
        </a>
        <h1 style="margin: 0; font-size: 28px;">编辑表白</h1>
        <div style="width: 40px;"></div>
    </nav>

    <div class="container">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $id; ?>">

            <label>发布人：</label>
            <input type="text" name="name" value="<?php echo $row["name"]; ?>" required>

            <label>专业：</label>
            <input type="text" name="major" value="<?php echo $row["major"]; ?>" required>

            <label>对方姓名：</label>
            <input type="text" name="to_name" value="<?php echo $row["to_name"]; ?>" required>

            <label>内容：</label>
            <textarea name="message" required><?php echo $row["message"]; ?></textarea>

            <input type="submit" value="更新">
        </form>
    </div>
</body>
</html>