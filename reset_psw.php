<?php include_once "header.php"; ?>
<style>
      .form form .success-txt {
            color: #12731c;
            background: #84c78b8a;
            padding: 8px 10px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 10px;
            border: 1px solid #84c78b;
            display: none;
      }
</style>

<body>

      <div class="wrapper">
            <div class="loader-wrapper">
                  <div class="dot-spinner">
                        <div class="dot-spinner__dot"></div>
                        <div class="dot-spinner__dot"></div>
                        <div class="dot-spinner__dot"></div>
                        <div class="dot-spinner__dot"></div>
                        <div class="dot-spinner__dot"></div>
                        <div class="dot-spinner__dot"></div>
                        <div class="dot-spinner__dot"></div>
                        <div class="dot-spinner__dot"></div>
                  </div>
            </div>
            <section class="form reset">
                  <header>Reset Your Password</header>
                  <form action="#" method="POST" name="recover_psw">
                        <div class="error-txt"></div>
                        <div class="success-txt"></div>
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
      <script src="javascript/jquery.min.js"></script>
      <script>
            $(window).on("load", function() {
                  $(".loader-wrapper").fadeOut("slow");
            });
      </script>
</body>

</html>