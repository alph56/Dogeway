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
        <link href="../CSS/registroMascot.css" rel="stylesheet" type="text/css" />
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
        
        <div id="mensaje"></div>
        
        <form action="altaregistro.php" method="post" enctype= "multipart/form-data">
            <div class="columna">

                <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $user->getuserId(); ?>">
                <input type="text" id="nombreMascota" name="nombreMascota" required placeholder="Nombre de tu mascota"><br><br>
                <input type="number" name="edad" required placeholder="Edad (En años)"><br><br>
                <input type="text" id="descripcion" name="descripcion" required placeholder="Agrega una descripción"><br><br>
                <input type="text" id="raza" name="raza" required placeholder="Ingresa la raza"><br><br>
                <input type="text" id="especificaciones" name="especificaciones" required placeholder="Especificaciones (Sano,sordo...)"><br><br>
                <input type="text" id="caracteristicas" name="caracteristicas" required placeholder="Caraterísticas (Color,Tamaño...)"><br><br>
                <label class="categoria">
                <select name="especie">
                    <option value="0">Selecciona su especie</option>
                    <option value="1">Perros</option>
                    <option value="2">Gatos</option>
                    <option value="3">Aves</option>
                    <option value="4">Reptiles</option>
                    <option value="5">Acuaticos</option>
                    <option value="6">Roedores</option>
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

} else {header("Location: ../Inicio/index.php");
  exit();
} 
?>

