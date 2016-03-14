<?php

require 'vendor/autoload.php';

header("refresh:3;url=http://www.wejiang.com/");

if (empty($_POST["email"])) {
	echo "请输入 email！"; die();
}

$email = test_input($_POST["email"]);
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
  	echo "无效的 email 格式！"; die();
}

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->CharSet = 'UTF-8';

$mail->Host       = "smtp.qq.com"; // SMTP server example
$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
$mail->Username   = "user@example.com"; // SMTP account username example
$mail->Password   = "xx";        // SMTP account password example

$mail->setFrom('user@example.com', 'WeJiang Robot');
$mail->addAddress('caizhenghai@gmail.com');     // Add a recipient

$mail->Subject = 'WeJiang 上线通知谁？';
$mail->Body    = "WeJiang 上线通知 - 【{$email}】，现在时间是：".date('Y-m-d H:i:s');

if(!$mail->send()) {
    echo '邮件发送失败';
    echo '错误: ' . $mail->ErrorInfo;
} else {
    echo '邮件发送成功';

}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}