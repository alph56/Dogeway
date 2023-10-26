<?php

include_once 'Inicio/includes/user.php';
include_once 'Inicio/includes/user_session.php';

$userSession = new UserSession();
$user = new User();

if(isset($_SESSION['user'])){

    $user->setUser($userSession->getCurrentUser());
    include_once 'Inicio/home.php';
}else{
  
    include_once 'home.php';
}


?>