<?php
require 'PHPMailer-master/PHPMailerAutoload.php';
// Email Submit
  function send_mail($mail){
      if(!$mail->Send()) {
         // echo json_encode(array('info' => 'error', 'msg' => __ERROR_MESSAGE__));
      } else {
            // echo json_encode(array('info' => 'success', 'msg' => __SUCCESS_MESSAGE__));
      }
    }
// Note: filter_var() requires PHP >= 5.2.0
if ( isset($_POST['email']) && isset($_POST['name']) && isset($_POST['message']) ) {

  // detect & prevent header injections
  // $test = "/(content-type|bcc:|cc:|to:)/i";
  // foreach ( $_POST as $key => $val ) {
  //   if ( preg_match( $test, $val ) ) {
  //     exit;
  //   }
  // }

      $name    = $_POST['name'];
    $mail2   = $_POST['email'];
    // $website  = $_POST['website'];
    $comment = $_POST['message'];

      $mail = new PHPMailer();

      $mail->IsSMTP();  // telling the class to use SMTP
      $mail->Host     = "smtp.gmail.com"; // SMTP server
      $mail->SMTPAuth = true;
      $mail->SMTPDebug = 0;
      $mail->Username = 'MultiDyneResponder@gmail.com';
      $mail->Password = 'multidyne';
      $mail->SMTPSecure = 'tls';
      $mail-> Port    = 587;
      // $mail->From     = "nmg2225@yahoo.com";
      // $mail->FromName = $name;
      $mail->SetFrom("multidyneresponder@gmail.com",$name);
      $mail->AddReplyTo($mail2, $name);

      $mail->AddAddress("nathangrotticelli@gmail.com");

      $mail->Subject  = "New DP Website Contact Submission";
      // $mail->WordWrap = 60;
      //Send Mail
      // $to = __TO__;
      // $subject = __SUBJECT__ . ' ' . $name;
      $message = '
      <html>
      <body>
        <table style="width: 500px; font-family: arial; font-size: 14px;" border="1">
        <tr style="height: 32px;">
          <th align="center" style="width:140px;">Name:</th>
          <td align="left" style="padding-left:10px; line-height: 20px;">'. $name .'</td>
        </tr>
        <tr style="height: 32px;">
          <th align="center" style="width:140px;">E-mail:</th>
          <td align="left" style="padding-left:10px; line-height: 20px;">'. $mail2 .'</td>
        </tr>
        <tr style="height: 32px;">
          <th align="center" style="width:140px;">Message:</th>
          <td align="left" style="padding-left:10px; line-height: 20px;">'. $comment .'</td>
        </tr>
        </table>
        <div style="padding-left:9px;"><br>(Click reply to respond)</div>
      </body>
      </html>
      ';
      $mail->Body = $message;
      $mail->isHTML(true);


      // $headers  = 'MIME-Version: 1.0' . "\r\n";
      // $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
      // $headers .= 'From: ' . $mail . "\r\n";

      send_mail($mail);

  //  Replace with your email
}
?>
