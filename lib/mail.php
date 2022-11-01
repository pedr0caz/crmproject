<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailTemplate
{
    public function __construct()
    {
        require_once('vendor/autoload.php');
    }

    public function sendMail($to, $subject, $body)
    {
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.sendgrid.net';
            $mail->SMTPAuth = true;
            $mail->Username = ENV["STMP_USER"];
            $mail->Password = ENV["STMP_PASS"];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            $mail->setFrom('pedrotuga3@gmail.com', 'Pedro');
            $mail->addAddress($to);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
