<?php

namespace auth;

class SendMail
{

  public static function post(String $token, String $username, String $email, $type = null)
  {
    $mail = new \mail\PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";
    // $mail->SMTPDebug  = 1;
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "STARTTLS";
    $mail->Port       = 587;
    $mail->Host       = "51.79.221.80";
    // $mail->Add
    // $mail->Host       = "mail.kaito.ninja";
    $mail->Username   = "noreply@kaito.ninja";
    $mail->Password   = "kaito1@3";
    $mail->IsHTML(true);
    $mail->AddAddress($email, $username);
    if ($type == "reset") {
      $mail->SetFrom("noreply@kaito.ninja", "Reset Password");
      $mail->Subject = "Reset Password";
      $content = '
      <html>
      <body>
      <center>
      <p>
          <a href="https://store.kaito.ninja/resetpassword/' . $token . '" 
          style="background-color:#ffbe00; color:#000000; display:inline-block; padding:12px 40px 12px 40px; text-align:center; text-decoration:none;" 
          target="_blank">Reset Password Now</a>
      </p>
      </center>
      </body>
  </html>
  ';
    }else{
      $mail->SetFrom("noreply@kaito.ninja", "Verify Email");
      $mail->Subject = "Verify Email";
      $content = '
      <html>
      <body>
      <center>
      <p>
          <a href="https://store.kaito.ninja/verify/' . $token . '" 
          style="background-color:#ffbe00; color:#000000; display:inline-block; padding:12px 40px 12px 40px; text-align:center; text-decoration:none;" 
          target="_blank">Verify Email Now</a>
      </p>
      <span style="font-size: 10px;"><a href=".">Email preferences</a></span>
      </center>
      </body>
  </html>
  ';
    }

    $mail->MsgHTML($content);
    if (!$mail->Send()) {
      return false;
    } else {
      return true;
    }
  }
}