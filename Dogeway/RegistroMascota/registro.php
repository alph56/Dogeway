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
        <link href="../CSS/registroMascota.css" rel="stylesheet" type="text/css" />
        <title>Registro de Mascota</title>

        <script>

        function handleFileChange() {
            const fileInput = document.getElementById('archivo');
            const selectedImage = document.getElementById('selected-image');

            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];

                // Mostrar la imagen seleccionada
                const reader = new FileReader();
                reader.onload = function (e) {
                    selectedImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
                selectedImage.style.display = 'block';
            } else {
                selectedImage.style.display = 'none';
                selectedImage.src = '';
            }
        }

        function handlFileChange() {
            const fileInput = document.getElementById('archive');
            const selectedImage = document.getElementById('select-image');

            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];

                // Mostrar la imagen seleccionada
                const reader = new FileReader();
                reader.onload = function (e) {
                    selectedImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
                selectedImage.style.display = 'block';
            } else {
                selectedImage.style.display = 'none';
                selectedImage.src = '';
            }
        }
    </script>

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

        <form action="" method="post" enctype= "multipart/form-data">
            <div class="columna">

                <input type="text" id="nombreMascota" name="nombreMascota" required placeholder="Nombre de tu mascota"><br><br>
                <input type="number" name="edad" required placeholder="Ingresa su edad"><br><br>
                <input type="text" id="descripcion" name="descripcion" required placeholder="Agrega una descripción"><br><br>
                <input type="text" id="especie" name="especie" required placeholder="Ingresa la especie"><br><br>
                <input type="text" id="raza" name="raza" required placeholder="Ingresa la raza"><br><br>
                <input type="text" id="especificaciones" name="especificaciones" required placeholder="Ingresa las especificaciones"><br><br>
                <input type="text" id="caracteristicas" name="caracteristicas" required placeholder="Ingresa las caraterísticas"><br><br>
                <label class="categoria">
                <select name="especie">
                    <option value="0">Selecciona su especie</option>
                    <option value="1">Perros</option>
                    <option value="2">Gatos</option>
                    <option value="2">Aves</option>
                    <option value="2">Reptiles</option>
                    <option value="2">Acuaticos</option>
                </select></label>
            </div>

            <div class="columna">

                <label class="custom-file-upload">
                        <span class="file-upload-text" id="file-text">Subir Foto de la cartilla</span>
                        <input type="file" id ="archivo" name="archivo" accept=".jpg, .jpeg, .png" required onchange="handleFileChange()"/>
                        <img id="selected-image" class="selected-image" style="display: none;" alt="Imagen seleccionada">
                    </label><br><br>

                <label class="custom-file-upload">
                        <span class="file-upload-text" id="file-text">Subir Foto de tu mascota</span>
                        <input type="file" id ="archive" name="archive" accept=".jpg, .jpeg, .png" required onchange="handlFileChange()"/>
                        <img id="select-image" class="select-image" style="display: none;" alt="Imagen seleccionada">
                    </label><br><br>
                    

                <label class="categoria">
                <select name="categoria">
                    <option value="0">Selecciona su categoria</option>
                    <option value="1">Match</option>
                    <option value="2">Adopcion</option>
                </select></label>

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

