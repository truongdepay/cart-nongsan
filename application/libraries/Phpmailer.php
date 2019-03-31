<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: TruongNv
 * Date: 2/19/2019
 * Time: 4:01 PM
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Phpmailer
{
    private $_mail;

    public function __construct()
    {
        $this->_mail = new PHPMailer();
    }

    public function sendMail()
    {
        try {
            //Server settings
            $this->_mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $this->_mail->isSMTP();                                      // Set mailer to use SMTP
            $this->_mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
            $this->_mail->SMTPAuth = true;                               // Enable SMTP authentication
            $this->_mail->Username = 'user@example.com';                 // SMTP username
            $this->_mail->Password = 'secret';                           // SMTP password
            $this->_mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $this->_mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $this->_mail->setFrom('from@example.com', 'Mailer');
            $this->_mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
            $this->_mail->addAddress('ellen@example.com');               // Name is optional
            $this->_mail->addReplyTo('info@example.com', 'Information');
            $this->_mail->addCC('cc@example.com');
            $this->_mail->addBCC('bcc@example.com');

//            //Attachments
////            $this->_mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
////            $this->_mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $this->_mail->isHTML(true);                                  // Set email format to HTML
            $this->_mail->Subject = 'Here is the subject';
            $this->_mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $this->_mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $this->_mail->send();
            echo 'Message has been sent';
        } catch (new Exception() $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
}