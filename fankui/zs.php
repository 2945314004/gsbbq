<!DOCTYPE html> 
<html> 
<head> 
<meta charset="UTF-8"> 
<title>反馈信息</title> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style> 
table { 
border-collapse: collapse; 
width: 100%; 
} 
th, td { 
text-align: left; 
padding: 8px; 
} 
th { 
background-color: #4CAF50; 
color: white; 
} 
tr:nth-child(even) { 
background-color: #f2f2f2; 
} 
form { 
margin: 20px auto; 
padding: 10px; 
border: 1px solid #ccc; 
border-radius: 5px; 
max-width: 600px; 
} 
input[type=text], textarea { 
width: 100%; 
padding: 12px; 
border: 1px solid #ccc; 
border-radius: 4px; 
box-sizing: border-box; 
resize: vertical; 
} 
input[type=submit] { 
background-color: #4CAF50; 
color: white; 
padding: 12px 20px; 
border: none; 
border-radius: 4px; 
cursor: pointer; 
} 
input[type=submit]:hover { 
background-color: #45a049; 
} 
@media screen and (max-width: 600px) { 
form { 
max-width: 100%; 
} 
} 
</style> 
</head> 
<body> 
<h1>反馈信息</h1> 
<?php 
// 连接数据库 
require_once 'config.php'; 
$conn = new mysqli($servername, $username, $password, $dbname); 
if ($conn->connect_error) { 
die("连接失败：" . $conn->connect_error); 
} 
// 查询数据库表 fankui 中的联系方式、内容和时间字段 


$sql = "SELECT contact, problem, create_time FROM fankui ORDER BY create_time DESC"; 
$result = $conn->query($sql); 
// 遍历查询结果，将数据显示在表格中 
while ($row = $result->fetch_assoc()) { 
echo "<form>"; 
echo "<label>联系方式:</label><br>"; 
echo "<input type='text' value='" . $row["contact"] . "' readonly><br>"; 
echo "<label>问题描述:</label><br>"; 
echo "<textarea rows='4' readonly>" . $row["problem"] . "</textarea><br>"; 
echo "<label>反馈时间:</label><br>"; 
echo "<input type='text' value='" . $row["create_time"] . "' readonly><br>"; 
echo "</form>"; 
echo "<hr>"; 
} 
// 关闭数据库连接 
$conn->close(); 
?> 
</body> 
</html> 