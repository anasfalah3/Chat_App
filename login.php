<?php
session_start();
if (isset($_SESSION['unique_id'])) {
      header("location: users.php");
}
?>
<?php include_once "header.php"; ?>

<body>
      <div class="wrapper">
            <section class="form login">
                  <header>Realtime Chat App</header>
                  <form action="#">
                        <div class="error-txt"></div>
                        <?php
                        if (isset($_GET['validation']) && $_GET['validation'] == "true") {
                              echo "<div id='validate-txt' style='color: #12731c;background: #84c78b8a;padding: 8px 10px;text-align: center;border-radius: 5px;margin-bottom: 10px;border: 1px solid #84c78b;display: block;'>";
                              echo "Your Email has been validate!";
                              echo "</div>";
                        }
                        ?>
                        <div class="field input">
                              <label for="">Email Address</label>
                              <input type="text" name="email" placeholder="Enter your email">
                        </div>
                        <div class="field input">
                              <label for="">Password</label>
                              <input type="password" name="password" placeholder="Enter your pasword">
                              <i class="fas fa-eye"></i>
                        </div>
                        <div class="field button">
                              <input type="submit" value="Continue to Chat">
                        </div>
                  </form>
                  <div class="link">
                        <a href="recover_psw.php">
                              Forgot Your Password?
                        </a>
                  </div>
                  <div class="link">Not yet signed up? <a href="index.php">Signup now</a></div>
            </section>
      </div>

      <?php include_once "NetworkCheck.php"; ?>

      <script src="javascript/pass-show-hide.js"></script>
      <script src="javascript/login.js"></script>
</body>

</html>