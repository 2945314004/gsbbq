<?php
	// 开始 session
	session_start();



	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// 连接数据库
		require_once 'config.php';
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("连接失败：" . $conn->connect_error);
		}

		// 获取用户提交的表白信息
		$name = $_POST["name"];
		$major = $_POST["major"];
		$to_name = $_POST["to_name"];
		$content = $_POST["content"];
		$user_id = $_SESSION["user_id"];

		// 将表白信息插入数据库中
		$sql = "INSERT INTO biao (name, major, to_name, message, user_id) VALUES ('$name', '$major', '$to_name', '$content', '$user_id')";
		if ($conn->query($sql) === TRUE) {
			header("Location: index.php");
			exit();
		} else {
			$error_message = "发布失败，请稍后再试。";
		}

		// 关闭数据库连接
		$conn->close();
	}

	// 连接数据库
	require_once 'config.php';
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("连接失败：" . $conn->connect_error);
	}
	
	


		// 查询最新的十条记录
	$sql = "SELECT id,name, major, to_name, message, create_time FROM biao ORDER BY create_time DESC LIMIT 10";
	$result = $conn->query($sql);
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>表白墙</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
	    /* 基本样式 */
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
}

/* 页面结构样式 */
header {
    background-color: #0d3c55;
    color: #fff;
    padding: 10px;
}

nav a {
    color: #fff;
    text-decoration: none;
    margin-right: 20px;
}

nav a:hover {
    text-decoration: underline;
}

main {
    max-width: 960px;
    margin: 0 auto;
    padding: 20px;
}

section {
    margin-bottom: 40px;
}

h2 {
    margin-top: 0;
}

/* 表单样式 */
  form {
    margin-bottom: 20px;
  }

  form label {
    display: inline-block;
    width: 80px;
    margin-right: 10px;
  }

  form input[type="text"],
  form textarea {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 5px;
    margin-bottom: 10px;
    width: 100%;
  }

  form input[type="submit"] {
    background-color: #0d3c55;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
  }

  form input[type="submit"]:hover {
    background-color: #135677;
  }

  form p {
    color: red;
    margin-top: 10px;
  }

/* 表格样式 */
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }

  th, td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ccc;
  }

  th {
    background-color: #0d3c55;
    color: #fff;
  }

  td {
    background-color: #fff;
  }

  .hidden {
    display: none;
  }

  .message-details {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 20px;
    background-color: #f9f9f9;
  }

  .message-details h3 {
    margin-top: 0;
    margin-bottom: 10px;
  }

  .message-details p {
    margin-top: 0;
    margin-bottom: 5px;
  }

  .message-details pre {
    margin-top: 0;
    margin-bottom: 0;
    font-size: 14px;
    font-family: 'Courier New', Courier, monospace;
    white-space: pre-wrap;
  }

  form {
    background-color: #f5f5f5;
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 10px;
  }

  .delete-button-cell {
    padding: 10px;
    text-align: center;
  }

  .delete-button-cell button {
    background-color: #dc3545;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
  }

  .delete-button-cell button:hover {
    background-color: #c82333;
  }

/*显示在最右边*/
  .user-info {
    display: flex;
    align-items: center;
  }

  .user-id {
    margin-right: 10px;
  }

  .dropdown {
    position: relative;
  }

  .dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    z-index: 1;
    min-width: 160px;
    background-color: #f1f1f1;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    border-radius: 4px;
  }

  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }

  .dropdown-content a:hover {
    background-color: #ddd;
  }

  .dropdown:hover .dropdown-content {
    display: block;
  }

  .dropdown:hover .dropbtn {
    background-color: #3e8e41;
  }
  
  /*123*/
  
header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
}

h1 {
  margin-right: 20px;
  font-size: 24px;
  text-align: center;
  flex: 1;
}

.dropdown {
  position: relative;
  display: inline-flex;
  flex-direction: column;
  align-items: center;
  margin-left: auto;
}

.dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  font-size: 16px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  min-width: 80px;
}

.dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  font-size: 16px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  min-width: 80px;
}

.dropdown-content {
  display: none;
  position: absolute;
  z-index: 1;
  top: 40px;
  right: 0;
}

.dropdown-content a {
  color: black;
  padding: 10px;
  text-decoration: none;
  display: block;
}

.dropdown:hover .dropdown-content {
  display: block;
}

@media only screen and (max-width: 600px) {
  header {
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
  }
  h1 {
    margin-right: 0;
    font-size: 20px;
    margin-bottom: 10px;
    text-align: center;
    flex: none;
  }
  .dropdown {
    margin-top: 10px;
  }
  .dropbtn {
    min-width: 60px;
    padding: 8px 16px;
    font-size: 14px;
  }
}


p.copyright {
  text-align: center;
}
  
	</style>
	
<header>
  <h1>表白墙</h1>
  <div class="dropdown">
    <?php 
      session_start();
      $username = $_SESSION['user_id'];
    ?>
    <button class="dropbtn">菜单</button>
    <div class="dropdown-content">
        <a href="/ggao">公告</a>
        <a href="/gr">个人信息</a>
      <a href="new.php">最新表白</a>
      <a href="my.php">我的表白</a>
      <a href="/fankui">问题反馈</a>
      <?php 
    //   判断在登陆的情况下才显示退出登陆
        if(isset($username)){
          echo "<a href='logout.php'>退出登录</a>";
        }
      ?> 
    </div>
  </div>
</header>

</head>
<body>

<?php include 'latest-messages.php'; ?>
</body>
</html>