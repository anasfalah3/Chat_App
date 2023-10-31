<?php 
      $conn = mysqli_connect("localhost","root","","chatapp");
      if ($conn) {
            // echo "database connected". mysqli_connect_error();
      }else {
            echo "error";
      }
?>