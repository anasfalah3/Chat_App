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
                  <header>Reset Your Password</header>
                  <form action="#" method="POST" name="recover_psw">
                        <div class="error-txt"></div>
                        <div class="field input">
                              <label for="">New Password</label>
                              <input type="password" id="password" placeholder="Enter new password" name="password" required autofocus>
                        </div>
                        <div class="field button">
                              <input type="submit" value="Reset" name="reset">
                        </div>
                  </form>
            </section>
      </div>

</body>

</html>

<?php
if (isset($_POST["reset"])) {
      include('php/config.php');
      $psw = $_POST["password"];

      $token = $_SESSION['token'];
      $Email = $_SESSION['email'];


      $sql = mysqli_query($conn, "SELECT * FROM users WHERE email='$Email'");
      $query = mysqli_num_rows($sql);
      $fetch = mysqli_fetch_assoc($sql);

      if ($Email) {
            mysqli_query($conn, "UPDATE users SET password='$psw' WHERE email='$Email'");
?>
            <script>
                  window.location.replace("login.php");
                  alert("<?php echo "your password has been succesful reset" ?>");
            </script>
      <?php
      } else {
      ?>
            <script>
                  alert("<?php echo "Please try again" ?>");
            </script>
<?php
      }
}

?>