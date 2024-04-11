<?php

function generateActivationCode($length = 6)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $activationCode = '';
    for ($i = 0; $i < $length; $i++) {
        $activationCode .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $activationCode;
}

$activationCode = generateActivationCode();
$id = 1;

require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
require './PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'tharinduruchiranga252@gmail.com';
$mail->Password = 'nvwm mutj blaf ttfb';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->setFrom('tharinduruchiranga252@gmail.com', 'Your Name');
$mail->addAddress('tharinduruchiranga1234@gmail.com');

$mail->isHTML(true);
$mail->Subject = 'Activation Code for Your Account.';
$mail->Body = 'Dear User,<br><br>'
    . 'Please click this button and activate your account.<br>'
    . '<a href="http://localhost/hardware/public/activate.php?id=' . $id . '&code=' . $activationCode . '" style="display:inline-block;background-color:#007bff;color:#ffffff;font-size:16px;padding:10px 20px;text-decoration:none;border-radius:5px;">Activate Account</a><br><br>'
    . 'Thank you!<br>';

if ($mail->send()) {
    echo "Email sent successfully!";
} else {
    echo "Failed to send email. Error: " . $mail->ErrorInfo;
}
