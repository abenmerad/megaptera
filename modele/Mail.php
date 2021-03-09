<?php
require 'include_path/PHPMailer/src/Exception.php';
require 'include_path/PHPMailer/src/PHPMailer.php';
require 'include_path/PHPMailer/src/SMTP.php';
require 'include_path/PHPMailer/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Mail
{
    private static $mailer;
    private static $monMail = null;

    private function __construct($data)
    {
        Mail::$mailer              = new PHPMailer(true);
//        Mail::$mailer->SMTPDebug   = SMTP::DEBUG_SERVER;
        Mail::$mailer->isSMTP();
        Mail::$mailer->Host        = $data['hote'];
        Mail::$mailer->SMTPAuth    = $data['authSMTP'];
        Mail::$mailer->Username    = $data['utilisateur'];
        Mail::$mailer->Password    = $data['mdp'];
        Mail::$mailer->SMTPSecure  = PHPMailer::ENCRYPTION_SMTPS;
        Mail::$mailer->Port        = $data['port'];
    }

    /* La fonction __destruction  */
    public function __destruction(){
        Mail::$monMail = null;
    }
    public static function getMail($data)
    {
        if(Mail::$monMail == null)
        {
            Mail::$monMail = new Mail($data);
        }
        return Mail::$monMail;
    }

    public function ecrireMail($to, $sujet, $corps)
    {
        Mail::$mailer->setFrom(Mail::$mailer->Username, 'Megaptera');
        Mail::$mailer->addAddress($to);
        Mail::$mailer->isHTML(true);
        Mail::$mailer->Subject =  $sujet;
        Mail::$mailer->Body    = $corps;
        Mail::$mailer->AltBody = 'This is the body in plain text for non-HTML mail clients';

        Mail::$mailer->send();
    }

}
