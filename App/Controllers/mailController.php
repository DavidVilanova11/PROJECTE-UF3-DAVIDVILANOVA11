<?php

include_once(__DIR__ . "/../Core/Controller.php");
include_once(__DIR__ . "/../Core/Mailer.php");

class mailController extends Controller
{

    public function index()
    {
        $params['msg'] = $_SESSION['msg'] ?? null;
        $this->render("mail/index", $params, "site");
    }

    public function send()
    {
        $nom = $_POST['nom_entrenador'] ?? null;
        $email = $_POST['email_entrenador'] ?? null;
        $msg = $_POST['msg'] ?? null;
        $subject = $_POST['subject'] ?? null;

        if ((is_null($nom) || is_null($email) || is_null($subject) || is_null($msg))) {
            header("Location: /mail/index");
            die();
        }

        try {
            $mail = new Mailer();
            $mail->mailServerSetup();
            $mail->addRec([$email], [], array("david.vilanova@cirvianum.cat"));
            //$contingut = "<p>Hi " . $nom . " un altre motiu de mail.</p>";
            $mail->addContent($subject, $msg);
            $mail->send();
            $_SESSION['msg'] = "Mail sent!";
            header("Location: /mail/index");
        } catch (Exception $e) {
            $_SESSION['msg'] = "Mail not sent!";
            header("Location: /mail/index");
        }
    }
}
