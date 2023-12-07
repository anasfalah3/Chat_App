<?php
session_start();
include('config.php');
$NewPassword = trim(mysqli_real_escape_string($conn, $_POST['password']));
$Email = $_SESSION['email'];
if (!empty($NewPassword)) {
      $sql = mysqli_query($conn, "SELECT * FROM users WHERE email='$Email'");
      $query = mysqli_num_rows($sql);
      $fetch = mysqli_fetch_assoc($sql);
      
      if ($Email) {
            mysqli_query($conn, "UPDATE users SET password='$NewPassword' WHERE email='$Email'");
            echo "your password has been succesful reset";
      } else {
            echo "Please try again";
      }
}else {
      echo "Please Enter a new password";
}


?>