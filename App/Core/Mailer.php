<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
// require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
// $mail = new PHPMailer(true);

class Mailer extends PHPMailer
{

    function mailServerSetup()
    {

        //Server settings
        $this->SMTPDebug = SMTP::DEBUG_OFF; //$this->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $this->isSMTP();                                            //Send using SMTP
        $this->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $this->SMTPAuth   = true;                                   //Enable SMTP authentication
        $this->Username   = 'david.vilanova@cirvianum.cat';                     //SMTP username
        $this->Password   = 'cibzyodqyvjrwcfo';                               //SMTP password
        $this->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $this->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    }
    /**
     * @throws Exception
     */
    function addRec($to, $cc, $bcc)
    {
        $this->setFrom('phpmailer.daw@cirvianum.cat', 'Ins Cirvianum');
        foreach ($to as $address) {
            $this->addAddress($address);
        }
        foreach ($cc as $address) {
            $this->addCC($address);
        }
        foreach ($bcc as $address) {
            $this->addBCC($address);
        }
    }

    /**
     * @throws Exception
     */
    function addAttachments($att)
    {
        foreach ($att as $attachment) {
            $this->addAttachment($attachment);
        }
    }

    function addVerifyContent($user = null) // per defecte null
    {
        $this->isHTML(true);
        $this->Subject = 'Verify Your Email!';
        $content =  '<img src="https://i.pinimg.com/736x/d8/22/3b/d8223b912e287e531990d1c01b39efc3.jpg" alt="logo" style="width: 100px; height: 100px;">';
        $content .= '<h2 style="color: #333; font-family: Arial, sans-serif;">Hey ' . $user['nom'] . ',</h2>';
        $content .= '<p style="color: #666; font-family: Arial, sans-serif; font-size: 16px;">Welcome to our community! We’re thrilled to have you on board.</p>';
        $content .= '<p style="color: #666; font-family: Arial, sans-serif; font-size: 16px;">Just one quick step left:</p>';
        $content .= "<a style='padding: 12px 24px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px; font-family: Arial, sans-serif; font-size: 18px; display: inline-block; margin-top: 20px;' href='http://localhost/usuari/verify/?email=" . $user['email'] . "&token=" . $user['token'] . "'>Verify My Email 🚀</a>";
        $content .= '<p style="color: #666; font-family: Arial, sans-serif; font-size: 14px; margin-top: 20px;">Having trouble? Reach out to our support team at support@example.com</p>';
        $this->Body = $content;
    }

    function addContent($subject, $content)
    {
        $this->isHTML(true);
        $this->Subject = $subject;
        $this->Body = $content;
    }
}
