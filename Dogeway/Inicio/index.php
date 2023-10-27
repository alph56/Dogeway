<?php

include_once 'includes/user.php';
include_once 'includes/user_session.php';

$userSession = new UserSession();
$user = new User();

if(isset($_SESSION['user'])){
    //echo "Hay sesión";
    $user->setUser($userSession->getCurrentUser());
    include_once 'home.php';
}else if(isset($_POST['username']) && isset($_POST['password'])){
    //echo "Validación de login";

    $userForm = $_POST['username'];
    $passForm = $_POST['password'];

    if ($user->userExists($userForm, $passForm) === true) {
        // Usuario válido y verificado
        $userSession->setCurrentUser($userForm);
        $user->setUser($userForm);
        include_once 'home.php';
    } elseif ($user->userExists($userForm, $passForm) === "nover") {
        // El usuario existe pero no está verificado
        $errorLogin = "Tu cuenta no está verificada.";
        include_once 'includes/iniciosesion.php';
       
    } else {
        // El usuario no existe o contraseña incorrecta
        $errorLogin = "Nickname y/o contraseña es incorrecto.";
        include_once 'includes/iniciosesion.php';
    }

}else{
    //echo "Login";
    include_once 'includes/iniciosesion.php';
}


?>