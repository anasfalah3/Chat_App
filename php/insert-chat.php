<?php 
      session_start();
      if (isset($_SESSION['unique_id'])) {
            include("config.php");
            $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
            $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
            $message = mysqli_real_escape_string($conn, $_POST['message']);
            $new_img_name = ""; // Initialize to an empty string
            if (isset($_FILES['image'])) {
                  $img_name = $_FILES['image']['name']; // getting user uploaded img name
                  $tmp_name = $_FILES['image']['tmp_name']; // this is temporary name is used to save/move file in our folder
            
                  //let's explode image and get the last extension like png ...
                  $img_explode = explode('.', $img_name);
                  $img_ext = end($img_explode); //here we get the extension of an user uploaded img file
            
                  $extensions = ['png', 'jpeg', 'jpg']; //these are some valid img ext and we've store them in array
                  if (in_array($img_ext, $extensions)) {
                        $time = time();
                        $new_img_name = $time . $img_name;
                        move_uploaded_file($tmp_name, "files/" . $new_img_name);
                  }
            }           

            if (!empty($message) || !empty($new_img_name)) {
                  $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg,files)
                                      VALUES ('{$incoming_id}', '{$outgoing_id}', '{$message}', '{$new_img_name}')") or die();
            }
      }else {
            header("..login.php");
      }

?>