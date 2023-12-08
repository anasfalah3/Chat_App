<?php
session_start();
include_once "config.php";
$fname = trim(mysqli_real_escape_string($conn, $_POST['fname']));
$lname = trim(mysqli_real_escape_string($conn, $_POST['lname']));
$password = trim(mysqli_real_escape_string($conn, $_POST['password']));
$login_id = mysqli_real_escape_string($conn, $_POST['id']);

if (!empty($fname) && !empty($lname)&& !empty($password)) {
      //let's check user upload file or not
      if (isset($_FILES['fileImg'])) {
            $img_name = $_FILES['fileImg']['name']; // getting user uploaded img name
            //$img_type = $_FILES['image']['type']; // getting user uploaded img type
            $tmp_name = $_FILES['fileImg']['tmp_name']; // this is temporary name is used to save/move file in our folder

            //let's explode image and get the last extension like png ...
            $img_explode = explode('.', $img_name);
            $img_ext = end($img_explode); //here we get the extension of an user uploaded img file

            $extensions = ['png', 'jpeg', 'jpg']; //these are some valid img ext and we've store them in array
            if (in_array($img_ext, $extensions) === true) {
                  $time = time();

                  $new_img_name = $time . $img_name;
                  if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                        //let's update user data inside table
                        $sql2 = "UPDATE users SET fname = '{$fname}', lname = '{$lname}', password = '{$password}',
                                img='{$new_img_name}' WHERE unique_id =  '{$login_id}'";
                        $query = mysqli_query($conn, $sql2);
                        if ($query) { //if these data inserted
                                    echo "success";
                        } else {
                              echo "error";
                        }
                  }
            } else {
                  echo "Please select an Image file - jpeg, jpg, png!";
            }
      } else {
            echo "Please select an Image file!";
      }
} else {
      echo "you can't delete your informations";
}
