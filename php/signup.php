<?php
session_start();
include_once "config.php";
$fname = trim(mysqli_real_escape_string($conn, $_POST['fname']));
$lname = trim(mysqli_real_escape_string($conn, $_POST['lname']));
$email = trim(mysqli_real_escape_string($conn, $_POST['email']));
$password = trim(mysqli_real_escape_string($conn, $_POST['password']));

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendmail($email, $v_code)
{
      //Load Composer's autoloader
      require("../PHPMailer/PHPMailer.php");
      require("../PHPMailer/SMTP.php");
      require("../PHPMailer/Exception.php");

      //Create an instance; passing `true` enables exceptions
      $mail = new PHPMailer(true);

      try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'user@example.com';                     //SMTP username
            $mail->Password   = 'secret';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            
            //Recipients
            $mail->setFrom('user@example.com', 'Mailer');
            $mail->addAddress($email);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Email verification from ChatApp';
            $mail->Body    = "Thanks for the registration!
            click the linck below to verify your email adress
            <a href='http://localhost/ChatApp/php/verify.php?email=$email&v_code=$v_code'>Verify now</a>";

            $mail->send();
            echo true;
      } catch (Exception $e) {
            echo false;
      }
}

if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
      //let's check user email is valid or not
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //let's check that email already exist in the database or not
            $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
            if (mysqli_num_rows($sql) > 0) {
                  echo "$email - This email already exist!";
            } else {
                  //let's check user upload file or not
                  if (isset($_FILES['image'])) {
                        $img_name = $_FILES['image']['name']; // getting user uploaded img name
                        //$img_type = $_FILES['image']['type']; // getting user uploaded img type
                        $tmp_name = $_FILES['image']['tmp_name']; // this is temporary name is used to save/move file in our folder

                        //let's explode image and get the last extension like png ...
                        $img_explode = explode('.', $img_name);
                        $img_ext = end($img_explode); //here we get the extension of an user uploaded img file

                        $extensions = ['png', 'jpeg', 'jpg']; //these are some valid img ext and we've store them in array
                        if (in_array($img_ext, $extensions) === true) {
                              $time = time();

                              $new_img_name = $time . $img_name;
                              if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                                    $status = "Active now"; // once user signed up then his status will be active now
                                    $random_id = rand(time(), 100000000); // creatind randome id for user
                                    $v_code = bin2hex(random_bytes(16)); // creating random verification code

                                    //let's insert all user data inside table

                                    $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status, verification_code, is_verified)
                                                                        VALUES ('{$random_id}', '{$fname}','{$lname}','{$email}','{$password}','{$new_img_name}','{$status}','{$v_code}','0')");
                                    if ($sql2 && sendmail($email,$v_code)) { //if these data inserted
                                          $sql3 = mysqli_query($conn, "SELECT *FROM users WHERE email = '{$email}'");
                                          if (mysqli_num_rows($sql3) > 0) {
                                                $row = mysqli_fetch_assoc($sql3);
                                                $_SESSION['unique_id'] = $row['unique_id']; //using this session we used user unique_id other php file
                                                echo "success";
                                          }
                                    } else {
                                          echo "we sent a verification link to you email please check it!";
                                    }
                              }
                        } else {
                              echo "Please select an Image file - jpeg, jpg, png!";
                        }
                  } else {
                        echo "Please select an Image file!";
                  }
            }
      } else {
            echo "$email - This is not valid email";
      }
} else {
      echo "All input field are required!";
}
