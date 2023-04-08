<!DOCTYPE html> 
<html> 
<head> 	
	<meta charset="UTF-8"> 	
	<title>提交问题</title> 	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 16px;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }
    
    h1 {
        text-align: center;
        margin-top: 20px;
    }
    
    form {
        margin: 20px auto;
        width: 90%;
        max-width: 600px;
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
    }
    
    label {
        display: block;
        margin-top: 10px;
    }
    
    input[type="text"],
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        margin-top: 5px;
        margin-bottom: 15px;
        box-sizing: border-box;
    }
    
    input[type="submit"],
    input[type="button"] {
        background-color: #4CAF50;
        border: none;
        color: #fff;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin-top: 10px;
        margin-right: 10px;
        border-radius: 5px;
        cursor: pointer;
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
    }
    
    input[type="submit"]:hover,
    input[type="button"]:hover {
        background-color: #3e8e41;
    }
    
    input[type="submit"]:active,
    input[type="button"]:active {
        background-color: #1e471e;
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.3) inset;
    }
    
    @media (max-width: 768px) {
        form {
            width: 100%;
            border-radius: 0;
            box-shadow: none;
        }
        
        input[type="submit"],
        input[type="button"] {
            margin-top: 20px;
            margin-right: 0;
            width: 100%;
        }
    }
</style>

</head> 
<body> 	
	<h1>提交问题</h1> 	
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
	<label for="contact">联系方式(QQ/微信/电话号码)：</label> 
	<input type="text" id="contact" name="contact"> 
	<label for="problem">问题：</label> 
	<textarea id="problem" name="problem" rows="5" cols="30" maxlength="200"></textarea> 
	<input type="submit" value="提交"> 
	<input type="button" value="返回" onclick="window.history.back()"> 
</form>


<?php
// 获取表单数据
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contact = trim($_POST["contact"]);
    $problem = trim($_POST["problem"]);

    // 数据库连接配置
    require_once 'config.php';
    // 创建连接
    $conn = new mysqli($servername, $username, $password, $dbname);

    // 检查连接
    if ($conn->connect_error) {
        echo "<script>alert('连接失败: " . $conn->connect_error . "');</script>";
    } else {
        // 将数据插入数据库中
        $sql = "INSERT INTO fankui (contact, problem) VALUES ('$contact', '$problem')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('反馈成功');</script>";
        } else {
            echo "<script>alert('反馈失败: " . $conn->error . "');</script>";
        }
    }

    // 关闭连接
    $conn->close();
}
?>
</body>
</html>