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

class Sendmail
{
    private $_mail;

    public function __construct()
    {
        $this->_mail = new PHPMailer();
    }

    public function sendTo($subject = '', $body = '')
    {
        $list_cc = array(
            'mangtayxanh.bn@gmail.com',
            'oceanvn01@gmail.com',
            'Nguyenhangbn2911@gmail.com',
            'haanh88company@gmail.com',
            'ngoctruong.humg2012@gmail.com'
        );
        try {
            //Server settings
            $this->_mail->CharSet = 'UTF-8';
            $this->_mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $this->_mail->isSMTP();                                      // Set mailer to use SMTP
            $this->_mail->Host = 'ssl://smtp.gmail.com';  // Specify main and backup SMTP servers
            $this->_mail->SMTPAuth = true;                               // Enable SMTP authentication
            $this->_mail->Username = 'jonhdepay@gmail.com';                 // SMTP username
            $this->_mail->Password = 'Nt841646401399';                           // SMTP password
            $this->_mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $this->_mail->Port = 465;                                    // TCP port to connect to

            //Recipients
            $this->_mail->setFrom('admin@nongsandungha.com', 'Mailer');
            //$this->_mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
            $this->_mail->addAddress('ngoctruong.humg2012@gmail.com');               // Name is optional
            $this->_mail->addReplyTo('info@example.com', 'Information');
            foreach ($list_cc as $value) {
                $this->_mail->addCC($value);
            }
            //$this->_mail->addBCC('bcc@example.com');

//            //Attachments
////            $this->_mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
////            $this->_mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $this->_mail->isHTML(true);                                  // Set email format to HTML
            $this->_mail->Subject = $subject;
            $this->_mail->Body    = $body;
            $this->_mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $this->_mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $e->ErrorInfo;
        }
    }

    public function test()
    {
        return 123;
    }
}