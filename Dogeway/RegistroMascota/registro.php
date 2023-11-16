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
        <link href="regMasc.css" rel="stylesheet" type="text/css" />
        <title>Registro de Mascota</title>

        <script>
            function mostrarError(mensaje) {
                var errorElement = document.getElementById('error-message');
                if (errorElement) {
                    errorElement.textContent = mensaje;
                    errorElement.style.display = 'block';
                }
            }
        </script>
    </head>
    <body>

    <nav class="nav">
        <div class="ranalogo"> 
            <img class="rana" src="../Imagenes/Rana_blanco.png">
            <div class="logo"> DOGEWAY</div>
        </div>
        <ul class="menu">
            <li><a href="../index.php">PAGINA PRINCIPAL</a></li>
        </ul>
    </nav>

    <div class="registromascota"> 
        <h2 class="titulomasc">REGISTRA A TU MASCOTA</h2>
        
        <div id="error-message" style="color: red; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 12px; margin-bottom: 17px;"></div>
        <?php
            if (isset($_GET['error'])) {
                $errorRegistro = urldecode($_GET['error']);
                echo '<script>';
                echo 'mostrarError("' . $errorRegistro . '");';
                echo '</script>';
            }
        ?>

        <form action="enviar_email.php" method="post">
            <div class="columna">

                <input type="text" name="nombreMascota" required placeholder="Nombre de tu mascota"><br><br>
                <input type="text" name="descripcion" required placeholder="Agrega una descripción"><br><br>
                <input type="text" name="especie" required placeholder="Ingresa la especie">
                <input type="text" name="raza" required placeholder="Ingresa la raza"><br><br>

                <input type="text" name="especificaciones" required placeholder="Ingresa las especificaciones">
                <input type="text" name="caracteristicas" required placeholder="Ingresa las caraterísticas">
                
                <label for="edad">Edad:
                    <input type="number" name="edad" required><br>
                </label>
                
            </div>

            <div class="columna">

                <label for="status"> El animal es: 
                    <select id="opciones" name="status">
                        <option value="0">Mascota</option>
                        <option value="1">Adopción</option>
                    </select>
                </label>

                <label class="custom-file-upload">
                    <span class="file-upload-text" id="file-text">Subir Foto Cartilla</span>
                    <input type="file" id ="archivo" name="archivo" accept=".jpg, .jpeg, .png" required onchange="handleFileChange()"/>
                    <img id="selected-image" class="selected-image" style="display: none;" alt="Imagen seleccionada">
                </label><br>
                
                <label class="custom-file-upload">
                    <span class="file-upload-text" id="file-text">Subir Foto de Mascota</span>
                    <input type="file" id ="archivo" name="archivo" accept=".jpg, .jpeg, .png" required onchange="handleFileChange()"/>
                    <img id="selected-image" class="selected-image" style="display: none;" alt="Imagen seleccionada">
                </label><br>

            </div>
            
            <input type="submit" name="registrar" value="Registrar">
        </form>
    </div>
<?php 
//ESTE BLOQUE ES EL ULTIMO AL FINAL DE CADA PEDAZO DE HTML
} else {header("Location: ../Inicio/index.php");
  exit();
} 
?>

