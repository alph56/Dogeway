<?php
    include_once '../../Inicio/includes/user.php';
    include_once '../../Inicio/includes/user_session.php';
    
    $userSession = new UserSession();
    $user = new User();

    if (isset($_SESSION['user'])) {
        $user->setUser($userSession->getCurrentUser());
    
    include_once "config.php";

    $outgoing_id = $user->getUniqueId();
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    $sql = "SELECT * FROM usuario WHERE NOT unique_id = {$outgoing_id} AND (nombre LIKE '%{$searchTerm}%' OR apellidos LIKE '%{$searchTerm}%') ";
    $output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }else{
        $output .= 'No user found related to your search term';
    }
    echo $output;
    }
?>