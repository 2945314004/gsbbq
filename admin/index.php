<?php 
// 启动会话 
session_start(); 
// 检查管理员是否已登录 
if (!isset($_SESSION['admin'])) { 
// 如果管理员未登录，跳转到登录页面 
header('Location: login.php'); 
exit; 
} 
?> 
<!DOCTYPE html> 
<html> 
<head> 
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>示例页面</title> 
<style> 
/* 导航栏样式 */ 
header { 
background-color: #333; 
color: #fff; 
padding: 10px; 
display: flex; 
justify-content: space-between; 
align-items: center; 
} 
nav ul { 
list-style: none; 
margin: 0; 
padding: 0; 
display: flex; 
} 
nav ul li { 
margin-right: 20px; 
} 
nav ul li a { 
color: #fff; 
text-decoration: none; 
} 
nav ul li a:hover { 
text-decoration: underline; 
} 

/* 侧边栏样式 */
aside {
background-color: #eee;
width: 200px;
position: fixed;
top: 70px;
bottom: 0;
left: -200px;
transition: left 0.3s ease;
}
aside.show {
left: 0;
}
aside ul {
list-style: none;
margin: 0;
padding: 0;
}
aside ul li a {
display: block;
padding: 10px;
color: #333;
text-decoration: none;
}
aside ul li a:hover {
background-color: #ddd;
}

/* 主内容区样式 */
main {
margin-top: 120px;
margin-left: 0;
padding: 0;
}
iframe {
width: 100vw;
height: 100vh;
border: none;
}

/* 按钮样式 */
.btn {
display: inline-block;
padding: 8px 16px;
font-size: 16px;
font-weight: bold;
text-align: center;
text-decoration: none;
background-color: #333;
color: #fff;
border: none;
border-radius: 4px;
cursor: pointer;
}
.btn:hover {
background-color: #555;
}

/* 响应式样式 */
@media screen and (max-width: 768px) {
header {
padding: 5px;
}
nav ul li {
margin-right: 10px;
}
aside {
top: 50px;
}
main {
margin-top: 100px;
}
}
</style>
</head> 
<body> 
<header> 
<div> 
<button class="btn" id="toggleBtn">&#8801;</button> 
</div> 
<nav> 
<ul> 
<li><a href="#">首页</a></li> 
<li><a href="#">关于我们</a></li> 
<li><a href="outlogin.php">注销</a></li> 
</ul> 
</nav> 
</header> 
<aside> 
<ul> 
<li><a href="#" onclick="openPage('users.php')">默认页面</a></li> 
<li><a href="#" onclick="openPage('page2.html')">页面2</a></li> 
<li><a href="#" onclick="openPage('page3.html')">页面3</a></li> 
</ul> 
</aside> 
<main> 
<iframe id="pageFrame"></iframe> 
</main> 
<script> 
// 切换侧边栏显示/隐藏 
var aside = document.querySelector('aside'); 
var toggleBtn = document.querySelector('#toggleBtn');
toggleBtn.addEventListener('click', function() {
aside.classList.toggle('show');
});

// 打开页面
function openPage(url) {
var pageFrame = document.querySelector('#pageFrame');
pageFrame.src = url;
}

// 页面加载时默认打开默认页面
window.onload = function() {
openPage('users.php');
};
</script>
</body> 
</html> 