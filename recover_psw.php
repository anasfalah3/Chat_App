<?php include_once "header.php"; ?>

<body>

      <div class="wrapper">
            <section class="form recover">
                  <header>Password Recover</header>
                  <form action="#" name="recover_psw">
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
      <script src="javascript/recover_psw.js"></script>
</body>

</html>