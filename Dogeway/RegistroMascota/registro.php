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
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Agregar Mascota</title>
    </head>
    <body>
    
    <h2>Formulario de Mascotas</h2>
    <h1>Bienvenido <?php echo $user->getNombre(); echo $user->getuserId(); echo $user->getusername(); ?> </h1>
    
    <form action="" method="post">
        <label for="nombreMascota">Nombre de la Mascota:</label>
        <input type="text" name="nombreMascota" required><br>
    
        <label for="edad">Edad:</label>
        <input type="number" name="edad" required><br>
    
        <input type="submit" value="Enviar">
    </form>
    
    </body>
    </html>

<?php 
//ESTE BLOQUE ES EL ULTIMO AL FINAL DE CADA PEDAZO DE HTML
} else {header("Location: ../Inicio/index.php");
  exit();
} 
?>

