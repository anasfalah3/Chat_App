<?php
      session_start();
      include_once "config.php";
      $fname = mysqli_real_escape_string($conn, $_POST['fname']);
      $lname = mysqli_real_escape_string($conn, $_POST['lname']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);

      if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
            //let's check user email is valid or not
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  //let's check that email already exist in the database or not
                  $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
                  if (mysqli_num_rows($sql) > 0) {
                        echo "$email - This email already exist!";
                  }else {
                        //let's check user uploid file or not
                        if (isset($_FILES['image'])) {
                              $img_name = $_FILES['image']['name']; // getting user uploaded img name
                              //$img_type = $_FILES['image']['type']; // getting user uploaded img type
                              $tmp_name = $_FILES['image']['tmp_name']; // this is temporary name is used to save/move file in our folder

                              //let's explode image and get the last extension like png ...
                              $img_explode = explode('.',$img_name);
                              $img_ext = end($img_explode); //here we get the extension of an user uploaded img file

                              $extensions = ['png', 'jpeg','jpg']; //these are some valid img ext and we've store them in array
                              if (in_array($img_ext, $extensions)===true) {
                                    $time = time();
                                    
                                    $new_img_name = $time.$img_name;
                                   if(move_uploaded_file($tmp_name, "images/".$new_img_name)){
                                          $status = "Active now"; // once user signed up then his status will be active now
                                          $random_id = rand(time(), 100000000) ;// creatind randome id for user

                                          //let's insert all user data inside table

                                          $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                                                        VALUES ('{$random_id}', '{$fname}','{$lname}','{$email}','{$password}','{$new_img_name}','{$status}')");
                                          if ($sql2) { //if these data inserted
                                                $sql3 = mysqli_query($conn, "SELECT *FROM users WHERE email = '{$email}'");
                                                if (mysqli_num_rows($sql3) >0) {
                                                      $row = mysqli_fetch_assoc($sql3);
                                                      $_SESSION['unique_id'] = $row['unique_id']; //using this session we used user unique_id other php file
                                                      echo "success";
                                                }
                                          }else {
                                                echo "Somthing went wrong!";
                                          }
                                   }
                              }else {
                                    echo "Please select an Image file - jpeg, jpg, png!";
                              }

                        }else {
                              echo "Please select an Image file!";
                        }
                  }
            }else {
                  echo "$email - This is not valid email";
            }
      }else {
            echo "All input field are required!"; 
      }
?>