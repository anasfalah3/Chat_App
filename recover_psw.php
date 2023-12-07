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
            <div class="loader-wrapper" style="display: none;">
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
            <section class="form recover">
                  <header>Password Recover</header>
                  <form action="#" name="recover_psw">
                        <div class="error-txt"></div>
                        <div class="success-txt"></div>
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
      <script src="javascript/jquery.min.js"></script>
</body>

</html>