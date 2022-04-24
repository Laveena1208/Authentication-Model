<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
class MailConfigHelper
{
    public static function getMailer(): PHPMailer
    {
        //create a instance ; passing 'true enables exception
        $mail = new PHPMailer(true);
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.mailtrap.io';                     
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'cbbb27e9183116';                     
        $mail->Password   = 'fc5a5e342bd603';                               
        $mail->SMTPSecure = 'tls';            
        $mail->Port       = 2525;                                     
        $mail->setFrom('laveena@backend.com','laveena'); 
        $mail->isHTML(true);
        return $mail;
    }
}