<?php
session_start();

// 检查是否登录
if (!isset($_SESSION['user_id'])) {
  echo "<script>alert('请先登录！');window.location.href='login.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>表白墙</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 16px;
      line-height: 1.6;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      box-sizing: border-box;
    }

    h1 {
      text-align: center;
      margin-top: 20px;
      margin-bottom: 40px;
      font-size: 36px;
    }

    h2 {
      font-size: 24px;
      margin-top: 30px;
      margin-bottom: 10px;
    }

    p {
      margin-top: 0;
      margin-bottom: 20px;
      font-size: 18px;
      line-height: 1.5;
    }

    .delete-link {
      display: inline-block;
      margin-top: 20px;
      color: #ff0000;
      text-decoration: none;
    }

    /* 表单样式 */
    .form-container {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      margin-bottom: 20px;
      
    }

    .form-container h2 {
      margin-top: 0;
    }

    .form-container p {
      margin-bottom: 10px;
    }

    .form-container label {
      display: block;
      margin-bottom: 5px;
    }

    .form-container input[type="text"],
    .form-container textarea {
      display: block;
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 5px;
      margin-bottom: 10px;
      box-sizing: border-box;
      border: 2px solid #000;
      
    }

    .form-container input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      
    }

    .form-container input[type="submit"]:hover {
      background-color: #3e8e41;
    }

    /* 响应式样式 */
    @media screen and (max-width: 600px) {
      .container {
        max-width: 100%;
        padding: 10px;
      }

      h1 {
        font-size: 28px;
      }

      .form-container {
        margin-bottom: 10px;
      }
    }
  </style>
</head>
<body>
          <br><br><br>
    <nav style="background-color: #4CAF50; color: white; display: flex; justify-content: space-between; align-items: center; padding: 10px; position: fixed; top: 0; width: 100%;">
  <a href="javascript:history.back()" style="color: white; font-size: 20px; text-decoration: none;">
    返回
  </a>
  <h1 style="margin: 0; font-size: 28px;">我的表白</h1>
  <div style="width: 40px;"></div>
</nav>
  
  <div class="container">
	  			<?php session_start();
	  			$username = $_SESSION['username'];
	  			?>
    
    <?php

    require_once 'config.php';
    

    
    
	
	

    // 创建数据库连接
    $conn = new mysqli($servername, $username, $password, $dbname);
			// 获取当前用户ID
			$user_id = $_SESSION["user_id"];
	
			// 查询当前用户发布的表白信息
			$query = "SELECT * FROM biao WHERE user_id = '$user_id' ORDER BY create_time DESC";
			$result = $conn->query($query);

    if ($result->num_rows > 0) {
      // 输出每一条记录
      while($row = $result->fetch_assoc()) {
        echo "<div class='form-container'>";
        echo "<h2>" . $row["title"] . "</h2>";
        echo "<p>" . $row["content"] . "</p>";
        echo "<form>";
        echo "<label>发布人：</label>";
        echo "<input type='text' value='" . $row["name"] . "' readonly>";
        echo "<label>专业：</label>";
        echo "<input type='text' value='" . $row["major"] . "' readonly>";
        echo "<label>对方姓名：</label>";
        echo "<input type='text' value='" . $row["to_name"] . "' readonly>";
        echo "<label>内容：</label>";
        echo "<textarea readonly>" . $row["message"] . "</textarea>";
        echo "<label>发布时间：</label>";
        echo "<input type='text' value='" . $row["create_time"] . "' readonly>";
        echo "</form>";
        echo "<a href=\"delete.php?id=" . $row["id"] . "\" class=\"delete-link\">删除</a>";
        echo "<div style=\"width: 10px; display: inline-block;\"></div>";  // 添加空元素
        echo "<a href=\"edit.php?id=" . $row["id"] . "\" class=\"edit-link\">编辑</a>";
        // echo "<a href=\"edit.php?id=  $row["id"] " class="edit-link">编辑</a>";
        echo "</div>";
      }
    } else {
      echo "<p>暂无记录</p>";
    }

    $conn->close();
    ?>
  </div>
</body>
</html>