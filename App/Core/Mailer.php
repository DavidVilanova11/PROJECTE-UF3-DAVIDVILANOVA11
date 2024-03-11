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
        $this->Subject = 'Verify your email please';
        $content = '<p>Hi ' . $user['nom'] . '</p>';
        $content .= '<p>Click follow button in order to verify your email</p>';
        $content .= "<a style='padding: 4px; background-color: blue; color:white; text-decoration: unset;' href='http://localhost/usuari/verify/?email=" . $user['email'] . "&token=" . $user['token'] . "'>Verify!</a>";
        $this->Body = $content;
    }

    function addContent($subject, $content)
    {
        $this->isHTML(true);
        $this->Subject = $subject;
        $this->Body = $content;
    }
}
