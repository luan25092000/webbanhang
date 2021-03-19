<?php
namespace auth;

use api\v1\AccountAPI;
use models\ResponseModel;

Class SendMail {

    private $secret = "kaito";

    public static function post(String $token) {
        $mail = new \mail\PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        // $mail->SMTPDebug  = 1;  
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "ssl";
        $mail->Port       = 465;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "mailtempkaito@gmail.com";
        $mail->Password   = "kaitoryouga";
        $mail->IsHTML(true);
        $mail->AddAddress("kaito1477800@gmail.com", "kaito");
        $mail->SetFrom("mailtempkaito@gmail.com", "Veryfy Email");
        $mail->Subject = "Veryfy Email";
        $content = '
            <html>
            <body>
            <center>
            <p>
                <a href="http://localhost:8006/verify/' . $token . '" 
                style="background-color:#ffbe00; color:#000000; display:inline-block; padding:12px 40px 12px 40px; text-align:center; text-decoration:none;" 
                target="_blank">Verify Email Now</a>
            </p>
            <span style="font-size: 10px;"><a href=".">Email preferences</a></span>
            </center>
            </body>
        </html>
        ';
        $mail->MsgHTML($content); 
        if(!$mail->Send()) {
          return false;
        } else {
          return true;
        }
    }
}
?>