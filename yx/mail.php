<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$sendhost = $_POST["host"];                     //邮箱服务器
$sendadress = $_POST["sendadress"];             //发件邮箱
$password = $_POST["password"];                 //stmp授权码
$sendport = $_POST["port"];                     //邮箱端口
$sendname = $_POST["sendname"];                 //发件人
$recename = $_POST["recename"];                 //收件人
$receadress = $_POST["receadress"];             //收件地址
$title = $_POST["title"];                       //收件人
$content = $_POST["content"];                   //邮件正文内容

require './phpmailer/PHPMailer.php';
require './phpmailer/Exception.php';
require './phpmailer/SMTP.php';

$mail = new PHPMailer(true);
try {
    //发件信息
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //需要输出调试请取消注释
    $mail->isSMTP();                                            //设置是否使用smtp发送
    $mail->Host       = $sendhost;                              //stmp服务器地址
    $mail->SMTPAuth   = true;                                   //启动smtp身份验证
    $mail->Username   = $sendadress;                              //邮箱用户名
    $mail->Password   = $password;                              //邮箱授权码
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //启动隐式TLS加密
    $mail->Port       = $sendport;                                  //邮箱端口`

    //收件信息
    $mail->setFrom($sendadress, $sendname);                  //发件邮箱，发件人
    $mail->addAddress($receadress, $recename);              //收件邮箱，收件人
    // $mail->addAddress('ellen@example.com');               //添加多个收件邮箱
    // $mail->addReplyTo('info@example.com', 'Information'); //添加回复，信息
    // $mail->addCC('cc@example.com');                       //添加CC
    // $mail->addBCC('bcc@example.com');                     //密件抄送人

    //附件
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //添加附件
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //可选名称

    //内容
    $mail->isHTML(true);
    $mail->Subject = $title;                                              //邮件主题
    $mail->Body    = $content;                 //邮件内容
    $mail->AltBody = '当前客户端不支持HTML格式，请更换客户端查看';        //当前客户端不支持HTML格式则显示此内容

    $mail->send();
    echo '<div style="width: 95%;height: 60px;margin: 40px auto;border-radius: 10px;box-shadow: 2px 4px rgba(0, 0, 0, .2);text-align: center;font-size: 30px;">邮件已发送</div>';                                                     //消息已发送
} catch (Exception $e) {
    echo "<div style='width: 95%;margin: 40px auto;border-radius: 10px;box-shadow: 2px 4px rgba(0, 0, 0, .2);text-align: center;font-size: 30px;'>邮件发送失败， 错误原因: {$mail->ErrorInfo}</div>";
}

?>

