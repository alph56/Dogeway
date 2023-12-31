<?php 
    //visualizacion-main.php
    //INCLUIR TODO ESTE BLOQUE DE PHP EN CADA archivo con HTML
    include_once '../Inicio/includes/user.php';
    include_once '../Inicio/includes/user_session.php';
    
    $userSession = new UserSession();
    $user = new User();

    require 'db.php';
    $conexion = conectar();
    if(isset($_SESSION['user'])){
        $user->setUser($userSession->getCurrentUser());
        $CurrentUserId = $user->getuserId();
    //ABAJO TMBN ESTA EL OTRO PEDAZO DEL BLOQUE, PONERLO AL FINAL

?>

<!DOCTYPE html>
<html lang = "es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://localhost/Dogeway/CSS/main_view.css">
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
        <h1>Dueño <a href="perfil-edit.php" id=<?php echo $user->getuserId();?> class="title_edit edit">Editar</a></h1> 
        <p>Nombre: <?php echo $user->getNombre();?> <?php echo $user->getApellidos();?></p>
        <p>Username: <?php echo $user->getusername();?></p>
        <p>Correo: <?php echo $user->getuseremail();?></p>
        <p>Telefono: <?php echo $user->getusertel();?></p>
        <p>Municipio: <?php echo $user->getusermun();?></p>
        <p>Fotografia: </p>
        <img class="perfil-principal fotografia" src="../Registro/archivos/<?php echo $user->getFotografia();?>">
        
    </div>
    <?php
        $allpets = mysqli_query($conexion, "SELECT * FROM mascota WHERE id_usuario = '$CurrentUserId'");
        $resultado = mysqli_num_rows($allpets);
        while($consultapets = mysqli_fetch_array($allpets)){
            if($consultapets['id_usuario']){
                $_SESSION['petId'] = $consultapets['id'];
                if($consultapets['categoria'] == 1){$consultapets['categoria'] = 'Mascota';}
                else if($consultapets['categoria'] == 2){$consultapets['categoria'] = 'Adopcion';}

                if($consultapets['especie'] == 1){$consultapets['especie'] = 'Perro';}
                else if($consultapets['especie'] == 2){$consultapets['especie'] = 'Gato';}
                else if($consultapets['especie'] == 3){$consultapets['especie'] = 'Ave';}
                else if($consultapets['especie'] == 4){$consultapets['especie'] = 'Reptil';}
                else if($consultapets['especie'] == 5){$consultapets['especie'] = 'Acuatico';}
                else if($consultapets['especie'] == 6){$consultapets['especie'] = 'Roedor';}
                else{$consultapets['especie'] = 'Desconocido';}
                
                if ($resultado>0){
    ?>
                    <div class="recuadro recuadro-1">
                            <h2><?php echo $consultapets['categoria'];?></h2><a href="masc-edit.php" class="title_edit masc">Editar</a>
                                <p>Id_Masc: <?php echo $consultapets['id'], "<br> <br>";  ?>
                                Nombre: <?php echo $consultapets['nombreMascota'], "<br> ";?>
                                Descripción: <?php echo $consultapets['descripcion'], "<br>";?>
                                Edad: <?php echo $consultapets['edad'], " años <br>";?> 
                                Especie: <?php echo $consultapets['especie'], "<br>";?>
                                Raza: <?php echo $consultapets['raza'],"<br>"; ?>
                                Especificaciones: <?php echo $consultapets['especificaciones'], "<br>";?>
                                Características: <?php echo $consultapets['caracteristicas'], "<br>";?>
                                Fotografía: 
                                <img class="recuadro recuadro-1 fotografia" src="../RegistroMascota/archivos/<?php echo $consultapets['fotografiaMascota'];?>">
                                </p>
                        </div>
    <?php   
                }
            }
        }
    ?>

</body>
</html>

<?php 
//ESTE BLOQUE ES EL ULTIMO AL FINAL DE CADA PEDAZO DE HTML
} else {header("Location: ../Inicio/index.php");
  exit();
} 
?>