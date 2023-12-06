<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();
if (isset($_SESSION['unique_id'])) {
      header("location: users.php");
}
?>
<?php include_once "header.php"; ?>

<body>

      <div class="wrapper">
            <section class="form login">
                  <header>Password Recover</header>
                  <form action="#" method="POST" name="recover_psw">
                        <div class="error-txt"></div>
                        <div class="field input">
                              <label for="">Email Address</label>
                              <input type="text" name="email" id="email_address" placeholder="Enter your email" required autofocus>
                        </div>
                        <div class="field button">
                              <input type="submit" name="recover" value="Recover">
                        </div>
                  </form>
            </section>
      </div>

</body>

</html>

<?php
if (isset($_POST["recover"])) {
      include('php/config.php');
      $email = $_POST["email"];

      $sql = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
      $query = mysqli_num_rows($sql);
      $fetch = mysqli_fetch_assoc($sql);

      if (mysqli_num_rows($sql) <= 0) {
?>
            <script>
                  alert("<?php echo "Sorry, no emails exists " ?>");
            </script>
      <?php
      } else if ($fetch["is_verified"] == 0) {
      ?>
            <script>
                  alert("Sorry, your account must verify first, before you recover your password !");
                  window.location.replace("index.php");
            </script>
            <?php
      } else {
            // generate token by binaryhexa 
            $token = bin2hex(random_bytes(50));

            //session_start ();
            $_SESSION['token'] = $token;
            $_SESSION['email'] = $email;

            //Load Composer's autoloader
            require("PHPMailer/PHPMailer.php");
            require("PHPMailer/SMTP.php");
            require("PHPMailer/Exception.php");

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
            $mail->addAddress($_POST["email"]); //Add a recipient

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
            ?>
                  <script>
                        alert("<?php echo " Invalid Email " ?>");
                  </script>
            <?php
            } else {
            ?>
                  <script>
                        alert("Email send out !  Kindly check your email inbox.")
                  </script>
<?php
            }
      }
}


?>