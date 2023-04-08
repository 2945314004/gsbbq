<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>空痕邮箱系统</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f3f5f7;
        }
        
        .header,
        .content,
        .footer {
            width: 95%;
            margin: 20px auto;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 2px 4px rgba(0, 0, 0, .2);
        }

        .header,
        .footer {
            height: 45px;
            text-align: center;
            line-height: 45px;
        }

        .header h1 {
            font-size: 20px;
        }

        .content {
            padding: 20px;
        }

        label,
        input,
        select {
            display: block;
            width: 100%;
        }
        
        label {
            margin-top: 20px;
        }
        
        input,
        select {
            margin-top: 10px;
        }

        input,
        select {
            height: 30px;
            padding-left: 10px;
        }
        
        label:nth-child(1) {
            margin-top: 10px;
        }
        
        .footer {
            font-size: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>空痕邮件系统</h1>
    </div>
    <div class="content">
        <form action="mail.php" method="POST">
            <label>发件服务器
                <select name="host">
                    <option value="smtp.qq.com">QQ邮箱</option>
                    <option value="smtp.163.com">163邮箱</option>
                    <!--<option value="smtp.aliyun.com">阿里云邮箱</option>-->
                    <!--<option value="smtp.sina.com.cn">新浪邮箱</option>-->
                    <!--<option value="smtp.gmail.com">谷歌邮箱</option>-->
                </select>
            </label>
            <label>发件端口：<input type="number" name="port" placeholder="请输入发件端口"></label>
            <label>发件地址：<input type="email" name="sendadress" placeholder="请输入发件地址"></label>
            <label>发件授权码：<input type="text" name="password" placeholder="请输入授权码"></label>
            <label>发件人：<input type="text" name="sendname" placeholder="请输入发件人"></label>
            <label>收件地址：<input type="email" name="receadress" placeholder="请输入收件地址"></label>
            <label>收件人：<input type="text" name="recename" placeholder="请输入收件人"></label>
            <label>邮件标题：<input type="text" name="title" placeholder="请输入邮件标题"></label>
            <label>邮件内容(支持HTML)：<input type="text" name="content" placeholder="请输入邮件内容"></label>
            <label><input type="submit" value="提交"></label>
        </form>
    </div>
    <div class="footer">Copyright © 2023 KongHen</div>
</body>
</html>