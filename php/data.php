<?php

while ($row = mysqli_fetch_assoc($sql)) {
    $sql2 = "SELECT * FROM messages WHERE 
             (incoming_msg_id = {$row['unique_id']} OR outgoing_msg_id = {$row['unique_id']}) 
             AND (outgoing_msg_id = {$outgoing_id} OR incoming_msg_id = {$outgoing_id}) 
             ORDER BY msg_id DESC LIMIT 1";

    $query2 = mysqli_query($conn, $sql2);

    if (!$query2) {
        // Handle query error
        continue;
    }
    $row2 = mysqli_fetch_assoc($query2);

    // Check if the last message is a file
    $isFileMessage = ($row2 !== null && !empty($row2['files']));

    // Check if the message is incoming
    $isIncoming = ($row2 !== null && $row2['outgoing_msg_id'] == $row['unique_id']);

    // Set appropriate styling for the message
    $msg = ($isFileMessage) ? 'Picture' : ($row2 !== null ? $row2['msg'] : 'No message available');
    $msgStyle = $isIncoming ? 'font-weight: bold;color:black;' : '';

    $you = ($row2 !== null && isset($row2['outgoing_msg_id']) && $outgoing_id == $row2['outgoing_msg_id']) ? "You: " : "";
    $offline = ($row['status'] == "Offline now") ? "offline" : '';
    $output .= '<a href="chat.php?user_id=' . $row['unique_id'] . '">
                    <div class="content">
                        <img src="php/images/' . $row['img'] . '" alt="">
                        <div class="details">
                            <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                            <p style="' . $msgStyle . '">' . $you . $msg . '</p>
                        </div>
                    </div>
                    <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                </a>';
}
?>