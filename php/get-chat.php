<?php 
      session_start();
      if (isset($_SESSION['unique_id'])) {
            include("config.php");
            $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
            $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
            $output = "";

            $sql = "SELECT * FROM messages
                    LEFT JOIN users ON users.unique_id = messages.incoming_msg_id
                    WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                    OR  (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id ASC";
            $query = mysqli_query($conn, $sql);
            if (mysqli_num_rows($query) > 0) {
                  while ($row = mysqli_fetch_assoc($query)) {
                        if ($row['outgoing_msg_id'] === $outgoing_id) {
                              $output .= '<div class="chat outgoing">
                                                <div class="details">';
                        // Conditionally display the message paragraph
                        if (!empty($row['msg'])) {
                              $output .= '<p>'.htmlspecialchars($row['msg']).'</p>';
                        }
                        // Conditionally display the image
                        if (!empty($row['files'])) {
                              $output .= '<img src="php/files/'.$row['files'].'" alt="">';
                        }
                        $output .= '</div>
                                    </div>';
                        } else {
                              $output .= '<div class="chat incoming">
                                                <img src="php/images/'.htmlspecialchars($row['img']).'" alt="">
                                                <div class="details">';
                        // Conditionally display the message paragraph
                        if (!empty($row['msg'])) {
                              $output .= '<p>'.htmlspecialchars($row['msg']).'</p>';
                        }
                        // Conditionally display the image
                        if (!empty($row['files'])) {
                              $output .= '<img src="php/files/'.$row['files'].'" alt="">';
                        }
                        $output .= '</div>
                                    </div>';
                        }
                  }
                  echo $output;
            }
      }else {
            header("..login.php");
      }


?>