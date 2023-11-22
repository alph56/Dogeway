<?php

    include_once '../../Inicio/includes/user.php';
    include_once '../../Inicio/includes/user_session.php';
    include_once "config.php";
    
    $userSession = new UserSession();
    $user = new User();

    if(isset($_SESSION['user'])){
    $user->setUser($userSession->getCurrentUser());
    }

    $outgoing_id = $user->getUniqueId();
    $sql = "SELECT * FROM usuario WHERE NOT unique_id = {$outgoing_id} AND verificado = 1  ORDER BY id DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>