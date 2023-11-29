<?php 
    //masc-edit.php
    //INCLUIR TODO ESTE BLOQUE DE PHP EN CADA archivo con HTML
    include_once 'visualizacion-main.php';

    if(isset($_SESSION['user'])){
    $user->setUser($userSession->getCurrentUser());    
    $IDMASC = $_SESSION['petId'];
    //ABAJO TMBN ESTA EL OTRO PEDAZO DEL BLOQUE, PONERLO AL FINAL
?>

<!DOCTYPE html>
<html lang = "es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://localhost/Dogeway/CSS/dueno-edit.css">
    <title>Actualización de Perfil de Mascota</title> 
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
            <h2 class="titulo-edit">Edición de mascota</h2> 

            <div id="error-message" style="color: red; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 12px; margin-bottom: 17px;"></div>
            <?php
                if (isset($_GET['error'])) {
                    $errorRegistro = urldecode($_GET['error']);
                    echo '<script>';
                    echo 'mostrarError("' . $errorRegistro . '");';
                    echo '</script>';
                }
            ?>
            <?php
                $allpets = mysqli_query($conexion, "SELECT * FROM mascota WHERE id = '$IDMASC'");
                $resultado = mysqli_num_rows($allpets);
                while($consultapets = mysqli_fetch_array($allpets)){
                    if($consultapets['id_usuario']){
                        if($consultapets['categoria'] == 1){$Categoria = 'Mascota';}
                        else if($consultapets['categoria'] == 2){$Categoria = 'Adopcion';}

                        if($consultapets['especie'] == 1){$Especie = 'Perros';}
                        else if($consultapets['especie'] == 2){$Especie = 'Gatos';}
                        else if($consultapets['especie'] == 3){$Especie = 'Aves';}
                        else if($consultapets['especie'] == 4){$Especie = 'Reptiles';}
                        else if($consultapets['especie'] == 5){$Especie = 'Acuaticos';}
                        else if($consultapets['especie'] == 6){$Especie = 'Roedores';}
                        else{$consultapets['especie'] = 'Desconocido';}
            ?>        
                    
                    <form action="update-pet.php" method="post"><p>
                        <?php $IDMASC ?></p>
                        <input type="hidden" value="<?php echo $consultapets['id'];?>" name="id">
                        <p>Nombre de la mascota: </p>
                        <input type="text" value="<?php echo $consultapets['nombreMascota'];?>" name="nombreMascota" required placeholder="Nombre de tu mascota"><br><br>
                        <p>Descripción: </p>
                        <input type="text" value="<?php echo $consultapets['descripcion'];?>" name="descripcion" required placeholder="Descripcion"><br><br>
                        <p>Edad: </p>
                        <input type="number" value="<?php echo $consultapets['edad'];?>" name="edad" required placeholder="Edad (En años)"><br><br>
                        <p>Especie: </p>
                        <label class="categoria">
                        <select name="especie" >
                            <option value="<?php echo $consultapets['especie'];?>"> <?php echo $Especie;?> </option>
                            <option value="1">Perros</option>
                            <option value="2">Gatos</option>
                            <option value="3">Aves</option>
                            <option value="4">Reptiles</option>
                            <option value="5">Acuaticos</option>
                            <option value="6">Roedores</option>
                        </select></label>
                        <br><br>
                        <p>Raza: </p>
                        <input type="text" value="<?php echo $consultapets['raza'];?>" name="raza" required placeholder="Raza"><br><br>
                        <p>Especificaciones: </p>
                        <input type="text" value="<?php echo $consultapets['especificaciones'];?>" name="especificaciones" required placeholder="Especificaciones"><br><br>
                        <p>Características: </p>
                        <input type="text" value="<?php echo $consultapets['caracteristicas'];?>" name="caracteristicas" required placeholder="Características"><br><br>
                        <p>Categoría: </p>
                        <label class="categoria">
                        <select name="categoria">
                            <option value="<?php echo $consultapets['categoria'];?>"> <?php echo $Categoria;?> </option>
                            <option value="1">Match</option>
                            <option value="2">Adopcion</option>
                        </select></label>

                        <br><br>
                        <input type="submit" name="Actualizar" value="Actualizar"><br><br>
                    </form>
        </div>
</body>
</html>

<?php 
                    }
                }
//ESTE BLOQUE ES EL ULTIMO AL FINAL DE CADA PEDAZO DE HTML
} else {header("Location: ../Inicio/index.php");
  exit();
} 
?>
