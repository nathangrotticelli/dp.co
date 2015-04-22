<?php

  /* ==========================  Define variables ========================== */

require 'PHPMailer-master/PHPMailerAutoload.php';

  #Success message
  define('__SUCCESS_MESSAGE__', "Your message has been sent. Thank you!");

  #Error message
  define('__ERROR_MESSAGE__', "Error, your message hasn't been sent");

  #Messege when one or more fields are empty
  define('__MESSAGE_EMPTY_FILDS__', "Please fill out  all fields");

  /* ========================  End Define variables ======================== */

  //Send mail function
  function send_mail($mail){
      if(!$mail->Send()) {
         echo json_encode(array('info' => 'error', 'msg' => __ERROR_MESSAGE__));

      } else {
            echo json_encode(array('info' => 'success', 'msg' => __SUCCESS_MESSAGE__));
      }
    // if(@mail($to,$subject,$message,$headers)){
    //  echo json_encode(array('info' => 'success', 'msg' => __SUCCESS_MESSAGE__));
    // } else {
    //  echo json_encode(array('info' => 'error', 'msg' => __ERROR_MESSAGE__));
    // }
  }

  //Check e-mail validation
  function check_email($email){
    if(!@eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
      return false;
    } else {
      return true;
    }
  }

  //Get post data
  if(isset($_POST['name']) and isset($_POST['email']) and isset($_POST['message'])){
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    // $website  = $_POST['website'];
    $message = $_POST['message'];

    if($name == '') {
      echo json_encode(array('info' => 'error', 'msg' => "Please enter your name."));
      exit();
    } else if($email == '' or check_email($email) == false){
      echo json_encode(array('info' => 'error', 'msg' => "Please enter valid e-mail."));
      exit();
    } else if($comment == ''){
      echo json_encode(array('info' => 'error', 'msg' => "Please enter your message."));
      exit();
    } else {
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
      $mail->AddReplyTo($email, $name);

      $mail->AddAddress("nathangrotticelli@gmail.com");

      $mail->Subject  = "New Dimepiece Website Contact Submission";
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
          <td align="left" style="padding-left:10px; line-height: 20px;">'. $email .'</td>
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
    }
  } else {
    echo json_encode(array('info' => 'error', 'msg' => __MESSAGE_EMPTY_FILDS__));
  }
 ?>
