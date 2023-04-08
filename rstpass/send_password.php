<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = ''; // 生成新的密码
    $subject = '找回密码';
    $message = '您的新密码是：' . $password;

    // 更新数据库中的密码

    $from = '发件人邮箱';
    $fromName = '发件人名称';
    $smtp = array(
        'host' => 'smtp.qq.com',
        'port' => 465,
        'auth' => true,
        'username' => 'wxhn233@qq.com',
        'password' => 'lcfuyqxkrpzldhcd'
    );

    require_once 'PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = $smtp['auth'];
    $mail->SMTPSecure = 'ssl';
    $mail->Host = $smtp['host'];
    $mail->Port = $smtp['port'];
    $mail->Username = $smtp['username'];
    $mail->Password = $smtp['password'];
    $mail->setFrom($from, $fromName);
    $mail->addAddress($email);
    $mail->Subject = $subject;
    $mail->msgHTML($message);
    $mail->AltBody = '请使用 HTML 邮件客户端查看邮件内容。';

    if (!$mail->send()) {
        echo '发送邮件失败：' . $mail->ErrorInfo;
    } else {
        echo '已将新密码发送到您的邮箱，请查收！';
    }
} else {
    // 显示找回密码的表单
}