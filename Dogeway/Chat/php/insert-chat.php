<?php 
    include_once '../../Inicio/includes/user.php';
    include_once '../../Inicio/includes/user_session.php';
    
    $userSession = new UserSession();
    $user = new User();
    
    
    if (isset($_SESSION['user'])) {
        $user->setUser($userSession->getCurrentUser());
        include_once "config.php";
        $outgoing_id = $user->getUniqueId();
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die();
        }
    }else{
        header("location: ../../Inicio/index.php");
    }


    
?>