<?php
      session_start();
      /*
       //se connecter à la base données
            include('db.php');
            //preparer la requete à executer
            $sql ="SELECT * FROM users";
            $pdo_statement = $pdo_conn->prepare($sql);
            //lancer de l'éxecution via la méthode execute()
            $pdo_statement->execute();
            //charger les données via la methode fetchAll()
            $users = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
            $output="";            
            
            foreach ($users as $user) {
                  $output .= '<a href="#">
                              <div class="content">
                              <img src="php/images/'.$user['img'].'" alt="">
                              <div class="details">
                                    <span>' . $user['fname'] . " " . $user['lname'].'</span>
                                    <p>This is a test message</p>
                              </div>
                              </div>
                              <div class="status-dot"><i class="fas fa-circle"></i></div>
                              </a>';
            }
      */
      include_once "config.php";
      $outgoing_id = $_SESSION['unique_id'];
      $sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id}");
      $output = "";

      if(mysqli_num_rows($sql) == 1){
            $output .= "No users are available to chat";
      }elseif(mysqli_num_rows($sql) > 0){
            include('data.php');
      }
      
      echo $output;

?>