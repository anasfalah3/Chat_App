<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
      header("location: login.php");
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
                              <a href="profile.php?id=<?= $_SESSION['unique_id']?>"><img src="php/images/<?php echo $row['img']; ?>" alt=""></a>
                              <div class="details">
                                    <span><?php echo $row['fname'] . " " . $row['lname']; ?></span>
                                    <p><?php echo $row['status']; ?></p>
                              </div>
                        </div>
                        <a href="php/logout.php?logout_id=<?= $row['unique_id'] ?>" class="logout">Log out</a>
                  </header>
                  <div class="search">
                        <span class="text"> Select an user to start chat</span>
                        <input type="text" placeholder="Enter name to search...">
                        <button><i class="fas fa-search"></i></button>
                  </div>
                  <div class="users-list">

                  </div>
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
</body>

</html>