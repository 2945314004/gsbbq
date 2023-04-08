<?php
// 邮件接收者
$to = "2945314004@qq.com";
// 邮件主题
$subject = "测试邮件";
// 邮件内容
$message = "这是一封测试邮件，请勿回复。";
// 邮件头部信息
$headers = "From: 2945314004@qq.com\r\n";
// SMTP服务器地址
$smtp_server = "smtp.qq.com";
// SMTP服务器端口
$smtp_port = 465;
// 邮件发送者
$smtp_user = "chapk@vip.qq.com";
// 邮件发送者密码或授权码
$smtp_password = "dgntehtphsobddii";
// 连接SMTP服务器
$smtp_conn = fsockopen($smtp_server, $smtp_port, $errno, $errstr, 30);
if(!$smtp_conn){
    echo "SMTP连接失败！";
}else{
    // 读取SMTP服务器返回信息
    $smtp_data = fgets($smtp_conn, 1024);
    // 发送EHLO命令
    fputs($smtp_conn, "EHLO $smtp_server\r\n");
    $smtp_data = fgets($smtp_conn, 1024);
    // 判断SMTP服务器是否需要TLS加密
    if(strpos($smtp_data, "STARTTLS") !== false){
        // 发送STARTTLS命令
        fputs($smtp_conn, "STARTTLS\r\n");
        $smtp_data = fgets($smtp_conn, 1024);
        // 开启TLS加密
        stream_socket_enable_crypto($smtp_conn, true, STREAM_CRYPTO_METHOD_SSLv23_CLIENT);
        // 发送EHLO命令
        fputs($smtp_conn, "EHLO $smtp_server\r\n");
        $smtp_data = fgets($smtp_conn, 1024);
    }
    // 登录SMTP服务器
    fputs($smtp_conn, "AUTH LOGIN\r\n");
    $smtp_data = fgets($smtp_conn, 1024);
    // 发送用户名
    fputs($smtp_conn, base64_encode($smtp_user)."\r\n");
    $smtp_data = fgets($smtp_conn, 1024);
    // 发送密码或授权码
    fputs($smtp_conn, base64_encode($smtp_password)."\r\n");
    $smtp_data = fgets($smtp_conn, 1024);
    // 发送MAIL FROM命令
    fputs($smtp_conn, "MAIL FROM:<$smtp_user>\r\n");
    $smtp_data = fgets($smtp_conn, 1024);
    // 发送RCPT TO命令
    fputs($smtp_conn, "RCPT TO:<$to>\r\n");
    $smtp_data = fgets($smtp_conn, 1024);
    // 发送DATA命令
    fputs($smtp_conn, "DATA\r\n");
    $smtp_data = fgets($smtp_conn, 1024);
    // 发送邮件头部信息
    fputs($smtp_conn, $headers."\r\n");
    // 发送邮件内容
    fputs($smtp_conn, $message."\r\n");
    // 发送结束标志
    fputs($smtp_conn, ".\r\n");
    $smtp_data = fgets($smtp_conn, 1024);
    // 发送QUIT命令
    fputs($smtp_conn, "QUIT\r\n");
    fclose($smtp_conn);
    echo "邮件发送成功！";
}
?>