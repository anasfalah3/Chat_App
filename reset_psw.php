<?php include_once "header.php"; ?>

<body>

      <div class="wrapper">
            <section class="form reset">
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
      <script src="javascript/reset_psw.js"></script>
</body>

</html>