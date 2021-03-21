<?php

namespace auth;

class SendMail
{

  public static function post(String $token)
  {
    $mail = new \mail\PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";
    $mail->SMTPDebug  = 1;
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "STARTTLS";
    $mail->Port       = 587;
    $mail->Host       = "mail.kaito.ninja";
    $mail->Username   = "noreply@kaito.ninja";
    $mail->Password   = "kaito1@3";
    $mail->IsHTML(true);
    $mail->AddAddress("kaito1477800@gmail.com", "kaito");
    $mail->SetFrom("noreply@kaito.ninja", "Verify Email");
    $mail->Subject = "Verify Email";
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
    if (!$mail->Send()) {
      return false;
    } else {
      return true;
    }
  }
}
