<?php 
    //INCLUIR TODO ESTE BLOQUE DE PHP EN CADA archivo con HTML
    include_once 'update-dueno.php';
    include_once '../Inicio/includes/user_session.php';
    include_once '../Inicio/includes/user.php'; 
    
    $userSession = new UserSession();
    $user = new User();

    if(isset($_SESSION['user'])){
    $user->setUser($userSession->getCurrentUser());
    //ABAJO TMBN ESTA EL OTRO PEDAZO DEL BLOQUE, PONERLO AL FINAL
?>

<!DOCTYPE html>
<html lang = "es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://localhost/Dogeway/CSS/dueno-edit.css">
    <title>Actualización de Perfil</title> 
</head>
<body>
    <nav class="nav">
        <div class=ranalogo>
                <img class="rana" src="http://localhost/Dogeway/Imagenes/Rana_blanco.png">
                <div class="logo"> DOGEWAY</div>
        </div>
        <ul class="menu">
        <li><a href="visualizacion-main.php">REGRESAR</a></li>
        </ul>
    </nav>
    
        <div class="edicion">
            <!-- contenido del perfil principal -->
            <h2 class="titulo-edit">Edición del perfil dueño</h2> 

            <div id="error-message" style="color: red; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 12px; margin-bottom: 17px;"></div>
            <?php
                if (isset($_GET['error'])) {
                    $errorRegistro = urldecode($_GET['error']);
                    echo '<script>';
                    echo 'mostrarError("' . $errorRegistro . '");';
                    echo '</script>';
                }
            ?>

            <form action="update-dueno.php" method="post">
                <input type="hidden" value="<?php echo $user->getuserId();?>"  name="id"><br><br>
                <p>Nombre:</p>
                <input type="text" value=" <?php echo $user->getNombre();?>"  name="nombre"><br><br>
                <p>Apellidos:</p>
                <input type="text" value="<?php echo $user->getApellidos();?>" name="apellidos"><br><br>
                <p>Nickname:</p>
                <input type="text" value="<?php echo $user->getusername();?>" name="nickname"><br><br>
                <p>Email:</p>
                <input type="email" value="<?php echo $user->getuseremail();?>" name="email"><br><br>
                <p>Telefono:</p>
                <input type="text" value="<?php echo $user->getusertel();?>" name="telefono"><br><br>
                <p>Municipio:</p>
                <input type="text" value="<?php echo $user->getusermun();?>" name="municipio"><br><br>

                <input type="submit" name="Actualizar" value="Actualizar">
            </form>
        </div>
</body>
</html>

<?php 
//ESTE BLOQUE ES EL ULTIMO AL FINAL DE CADA PEDAZO DE HTML
} else {header("Location: ../Inicio/index.php");
  exit();
} 
?>