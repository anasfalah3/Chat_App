<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
      header("location: login.php");
}
?>
<?php include_once "header.php"; ?>

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
            <section class="users">
                  <header>
                        <?php
                        include_once "php/config.php";
                        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                        if (mysqli_num_rows($sql) > 0) {
                              $row = mysqli_fetch_assoc($sql);
                        }
                        ?>
                        <div class="content">
                              <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>

                              <div class="details">
                                    <span>Profile</span>
                              </div>
                        </div>
                        <a href="php/logout.php?logout_id=<?= $row['unique_id'] ?>" class="logout">Log out</a>
                  </header>

                  <section class="form signup">
                        <form action="php/profile.php" enctype="multipart/form-data" autocomplete="off">
                              <div class="error-txt"></div>
                              <div class="success-txt"></div>
                              <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                              <div class="upload">
                                    <img src="php/images/<?php echo $row['img']; ?>" id="image">

                                    <div class="rightRound" id="upload">
                                          <input type="file" name="fileImg" id="fileImg" accept=".jpg, .jpeg, .png">
                                          <i class="fa fa-camera"></i>
                                    </div>
                                    <div class="leftRound" id="cancel" style="display: none;">
                                          <i class="fa fa-times"></i>
                                    </div>
                              </div>
                              <div class="name-details">
                                    <div class="field input">
                                          <label for="">New First Name</label>
                                          <input type="text" name="fname" placeholder="First Name" value="<?php echo $row['fname']; ?>">
                                    </div>
                                    <div class="field input">
                                          <label for="">New Last Name</label>
                                          <input type="text" name="lname" placeholder="Last Name" value="<?php echo $row['lname']; ?>">
                                    </div>
                              </div>
                              <div class="field input">
                                    <label for="">New Password</label>
                                    <input type="password" name="password" id="password" placeholder="Enter new pasword">
                                    <i class="fas fa-eye"></i>
                              </div>
                              <div class="field button">
                                    <input type="submit" id="submit" value="Save">
                              </div>
                        </form>
                  </section>
            </section>
      </div>
      <?php include_once "NetworkCheck.php"; ?>

      <script src="javascript/users.js"></script>
      <script src="javascript/jquery.min.js"></script>
      <script>
            $(window).on("load", function() {
                  $(".loader-wrapper").fadeOut("slow");
            });
      </script>
      <script type="text/javascript">
            document.getElementById("fileImg").onchange = function() {
                  document.getElementById("image").src = URL.createObjectURL(fileImg.files[0]); // Preview new image
            }
      </script>

      <script src="javascript/pass-show-hide.js"></script>
      <script src="javascript/profile.js"></script>
      <script type="text/javascript">
            document.getElementById("fileImg").onchange = function() {
                  document.getElementById("image").src = URL.createObjectURL(fileImg.files[0]); // Preview new image
                  document.getElementById("cancel").style.display = "block";
                  document.getElementById("upload").style.display = "none";
            }

            var userImage = document.getElementById('image').src;
            document.getElementById("cancel").onclick = function() {
                  document.getElementById("image").src = userImage; // Back to previous image
                  document.getElementById("cancel").style.display = "none";
                  document.getElementById("upload").style.display = "block";
            }
      </script>
</body>

</html>