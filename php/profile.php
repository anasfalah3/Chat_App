<?php
session_start();
include_once "config.php";

$fname = trim(mysqli_real_escape_string($conn, $_POST['fname']));
$lname = trim(mysqli_real_escape_string($conn, $_POST['lname']));
$password = trim(mysqli_real_escape_string($conn, $_POST['password']));
$login_id = mysqli_real_escape_string($conn, $_POST['id']);

// Check if any changes are submitted
if (!empty($fname) || !empty($lname) || !empty($password) || isset($_FILES['fileImg']['name'])) {
      $sqlUpdate = "UPDATE users SET ";

      // Update first name if provided
      if (!empty($fname)) {
            $sqlUpdate .= "fname = '{$fname}', ";
      }

      // Update last name if provided
      if (!empty($lname)) {
            $sqlUpdate .= "lname = '{$lname}', ";
      }

      // Update password if provided
      if (!empty($password)) {
            $sqlUpdate .= "password = '{$password}', ";
      }

      // Handle image upload
      if (!empty($_FILES['fileImg']['name'])) {
            $img_name = $_FILES['fileImg']['name'];
            $tmp_name = $_FILES['fileImg']['tmp_name'];
            $img_explode = explode('.', $img_name);
            $img_ext = end($img_explode);
            $extensions = ['png', 'jpeg', 'jpg'];

            if (in_array($img_ext, $extensions) === true) {
                  $time = time();
                  $new_img_name = $time . $img_name;

                  if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                        $sqlUpdate .= "img = '{$new_img_name}', ";
                  } else {
                        echo "Error uploading image.";
                        exit;
                  }
            } else {
                  echo "Please select a valid image file - jpeg, jpg, png!";
                  exit;
            }
      }

      // Remove the trailing comma and space
      $sqlUpdate = rtrim($sqlUpdate, ', ');

      // Add the WHERE clause
      $sqlUpdate .= " WHERE unique_id = '{$login_id}'";

      // Execute the query
      $query = mysqli_query($conn, $sqlUpdate);

      if ($query) {
            echo "success";
      } else {
            echo "error";
      }
} else {
      echo "No changes submitted.";
}
