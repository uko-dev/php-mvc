<?php
/**
 * Email sender based on PHPMailer 
 * 
 * https://github.com/PHPMailer/PHPMailer
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include APP_DIR . "Utils/EmailSender/PHPMailer/vendor/autoload.php";

class EmailSender {

    /**
     * Send email
     * 
     * @param string $subject
     * @param string $body
     * @param string $recipient
     */
    public static function sendEmail($subject, $body, $recipient)
    {   
        # SMTP auth
        $mailer = new PHPMailer();
        $mailer->isSMTP();
        $mailer->Host       = "mail.adm.tools";
        $mailer->Port       = 25;
        $mailer->SMTPAuth   = true;
        $mailer->Username   = "web@google.com";
        $mailer->Password   = "pass";
        
        # sender info
        $mailer->From     = 'web@google.com';
        $mailer->FromName = 'My letter title';
        
        # recipient info
        $mailer->isHTML(true);
        $mailer->Subject = $subject;
        $mailer->Body    = $body;
        $mailer->AddAddress($recipient);

        $mailer->smtpConnect(
            array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            )
        );

        $mailer->send();
    }
}