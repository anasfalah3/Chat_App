<?php
session_start();
if (isset($_SESSION['unique_id'])) {
      header("location: users.php");
}
?>
<?php include_once "header.php"; ?>

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
            <section class="form signup">
                  <header>Realtime Chat App</header>
                  <form action="#" enctype="multipart/form-data" autocomplete="off">
                        <div class="error-txt"></div>
                        <div class="name-details">
                              <div class="field input">
                                    <label for="">First Name</label>
                                    <input type="text" name="fname" placeholder="First Name" required>
                              </div>
                              <div class="field input">
                                    <label for="">Last Name</label>
                                    <input type="text" name="lname" placeholder="Last Name" required>
                              </div>
                        </div>
                        <div class="field input">
                              <label for="">Email Address</label>
                              <input type="text" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="field input">
                              <label for="">Password</label>
                              <input type="password" name="password" placeholder="Enter new pasword" required>
                              <i class="fas fa-eye"></i>
                        </div>
                        <div class="field image">
                              <label for="">Select Image</label>
                              <input type="file" name="image" required>
                        </div>
                        <div class="field button">
                              <input type="submit" value="Continue to Chat">
                        </div>
                  </form>
                  <div class="link">Already signed up? <a href="login.php">Login now</a></div>
            </section>
      </div>
      <?php include_once "NetworkCheck.php"; ?>

      <script src="javascript/pass-show-hide.js"></script>
      <script src="javascript/signup.js"></script>
      <script src="javascript/jquery.min.js"></script>
      <script>
            $(window).on("load", function() {
                  $(".loader-wrapper").fadeOut("slow");
            });
      </script>
</body>

</html>