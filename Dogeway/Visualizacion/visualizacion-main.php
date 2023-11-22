<?php 
    //INCLUIR TODO ESTE BLOQUE DE PHP EN CADA archivo con HTML
    include_once '../Inicio/includes/user.php';
    include_once '../Inicio/includes/user_session.php';
    include_once 'db.php';
    
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
    <link rel="stylesheet" href="main_view.css">
    <title>Visualización de Perfil</title> 
</head>
<body>
    <nav class="nav">
        <div class=ranalogo>
                <img class="rana" src="http://localhost/Dogeway/Imagenes/Rana_blanco.png">
                <div class="logo"> DOGEWAY</div>
        </div>
        <ul class="menu">
        <li><a href="../index.php">REGRESAR</a></li>
        </ul>
    </nav>

    <div class="perfil-principal">
        <!-- contenido del perfil principal -->
        <h1>Dueño <a href="perfil-edit.php" id=<?php echo $user->getuserId();?> class="title_edit">Editar</a></h1> 
        <p>Nombre: <?php echo $user->getNombre();?> <?php echo $user->getuserlastname();?></p>
        <p>Username: <?php echo $user->getusernickname();?></p>
        <p>Correo: <?php echo $user->getuseremail();?><p>
        <p>Telefono: <?php echo $user->getusertel();?><p>
        <p>Municipio: <?php echo $user->getusermun();?><p>
        <table>
        <tr>
            <th>Fotografia</th>
        </tr>
        <tr>
            <td><img height="50px" src="data:image/<?php echo $user->getuserImage();?>;base64, <?php echo base64_encode($user->getuserImage()); ?>"></td>
        </tr>
        </table>
    </div>
    <div class="recuadro recuadro-1">
        <!-- Contenido del primer recuadro -->
        <h2>Mascota 1</h2>
        <p>Contenido del recuadro 1....</p> 
    </div>

    <div class="recuadro recuadro-2">
        <!-- Contenido del segundo recuadro -->
        <h2>Mascota 2</h2>
        <p>Contenido del recuadro 2....<P>
    </div>

    <div class="recuadro recuadro-3">
        <!-- Contenido del tercer recuadro -->
        <h2>Mascota 3</h2>
        <p>Contenido del recuadro 3....<P>
    </div>

</body>
</html>

<?php 
//ESTE BLOQUE ES EL ULTIMO AL FINAL DE CADA PEDAZO DE HTML
} else {header("Location: ../Inicio/index.php");
  exit();
} 
?>