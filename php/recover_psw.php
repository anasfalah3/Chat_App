<?php
include('config.php');
$email = mysqli_real_escape_string($conn, $_POST['email']);
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (!empty($email)) {
      $email = $_POST["email"];

      $sql = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
      $query = mysqli_num_rows($sql);
      $fetch = mysqli_fetch_assoc($sql);

      if (mysqli_num_rows($sql) <= 0) {
            echo "Sorry, no emails exists ";
      } else if ($fetch["is_verified"] == 0) {
            echo "Sorry, your account must verify first, before you recover your password !";
      } else {
            // generate token by binaryhexa 
            $token = bin2hex(random_bytes(50));

            //session_start ();
            $_SESSION['token'] = $token;
            $_SESSION['email'] = $email;

            //Load Composer's autoloader
            require("../PHPMailer/PHPMailer.php");
            require("../PHPMailer/SMTP.php");
            require("../PHPMailer/Exception.php");

            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'example@example.com';                     //SMTP username
            $mail->Password   = 'example';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;


            //Recipients
            $mail->setFrom('example@example.com', 'example');
            $mail->addAddress(trim($_POST["email"])); //Add a recipient

            //Content
            $mail->isHTML(true);                //Set email format to HTML
            $mail->Subject = "Recover your ChatApp password";
            $mail->Body = "<b>Dear User</b>
            <h3>We received a request to reset your password.</h3>
            <p>Kindly click the below link to reset your password</p>
            <a href='http://localhost/ChatApp/reset_psw.php'>Reset password</a>
            <br><br>
            <p>With regrads,</p>
            <b>ChatApp</b>";

            if (!$mail->send()) {
                  echo " Invalid Email ";
            } else {
                  echo "success";
            }
      }
}
