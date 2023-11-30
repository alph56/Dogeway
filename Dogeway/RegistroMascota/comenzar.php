<?php 
    //INCLUIR TODO ESTE BLOQUE DE PHP EN CADA archivo con HTML
    include_once '../Inicio/includes/user.php';
    include_once '../Inicio/includes/user_session.php';
    
    $userSession = new UserSession();
    $user = new User();

    if(isset($_SESSION['user'])){
    $user->setUser($userSession->getCurrentUser());
    //ABAJO TMBN ESTA EL OTRO PEDAZO DEL BLOQUE, PONERLO AL FINAL
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mascota registrada</title>
    <link rel="stylesheet" href="../CSS/comenzar.css">
</head>

<body>
    <div class="mensaje">
        <br>
        <p class="texto">"¡Has registrado correctamente a tu mascota, ahora sera visible para los demas usuarios!"</p><br>
        <p class="texto">( •̀ ω •́ )✧</p>
        <br>
    </div>

    <div class="btn-container">
        <a class="boton" href="../Match/lista.php">Ir a conocer mascotas</a>
        <a class="boton" href="../index.php">Volver a la pagina principal</a>
    </div>
    
    
</body>
</html>

<?php 

} else {header("Location: ../index.php");
  exit();
} 
?>