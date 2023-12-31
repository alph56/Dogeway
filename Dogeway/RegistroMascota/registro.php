<?php 
    include_once '../Inicio/includes/user.php';
    include_once '../Inicio/includes/user_session.php';
    
    $userSession = new UserSession();
    $user = new User();

    if(isset($_SESSION['user'])){
    $user->setUser($userSession->getCurrentUser());

    $id_usuario = $user->getuserId();
    
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="../CSS/registroMascota.css" rel="stylesheet" type="text/css" />
        <title>Registro de Mascota</title>

        <script src="../Chat/javascript/jquery-3.3.1.min.js"></script>

        <script>

function validar() {
    var nombreMascota = $('#nombreMascota').val();
    var edad = $('#edad').val();
    var descripcion = $('#descripcion').val();
    var raza = $('#raza').val();
    var especificaciones = $('#especificaciones').val();
    var caracteristicas = $('#caracteristicas').val();
    var especie = $('select[name=especie]').val();
    var archivo = $('#archivo').val();
    var archive = $('#archive').val();
    var categoria = $('select[name=categoria]').val();

    if (nombreMascota == '' || edad == '' || descripcion == '' || raza == '' || especificaciones == '' ||
        caracteristicas == '' || especie == '0' || categoria == '0' || archivo === "" || archive === "") {
        mostrarMensajeError('Faltan campos por llenar');
        return false;
    }

    var regex = /^[1-9]\d*$/;

    if (!regex.test(edad) || parseInt(edad) <= 0 || parseInt(edad) > 20) {
        console.log('Edad:', edad);
        mostrarMensajeError('Ingrese una edad válida');
        return false;
    }

    return true;
}

function mostrarMensajeError(mensaje) {
    $('#mensaje').show().html(mensaje);
    setTimeout(function() {
        $('#mensaje').html('').hide();
    }, 5000);
}

        function handleFileChange() {
            const fileInput = document.getElementById('archivo');
            const selectedImage = document.getElementById('selected-image');

            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];

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
              <li><a href="../Match/lista.php">MATCH</a></li>
              <li><a href="../Adopcion/adopcion.php">ADOPCION</a></li>
              <li><a href="../Perfil/lista.php">PERFIL</a><br>
                  <ul class="submenu">
                      <li> <a href="http://localhost/Dogeway/RegistroMascota/registro.php">Registrar Mascota</a></li>
                  </ul>
              </li>
              <li><a href="../Chat/users.php">CHAT</a></li>
              <li><a href="../index.php">PAGINA PRINCIPAL</a></li>
              <li><a href="../Inicio/includes/logout.php">CERRAR SESION</a></li>
            </ul>
        </ul>
    </nav>

    <div class="registromascota"> 
        <h2 class="titulomasc">REGISTRO DE MASCOTA</h2>
        
        <div id="mensaje"></div>
        
        <form action="altaregistro.php" method="post" enctype= "multipart/form-data">
            <div class="columna">

                <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $id_usuario; ?>">
                <input type="text" id="nombreMascota" name="nombreMascota" value="" placeholder="Nombre de tu mascota"><br><br>
                <input type="number" id="edad" name="edad" value="" placeholder="Edad (En años)"><br><br>
                <input type="text" id="descripcion" name="descripcion" value=""  placeholder="Agrega una descripción"><br><br>
                <input type="text" id="raza" name="raza"  value=""  placeholder="Ingresa la raza"><br><br>
                <input type="text" id="especificaciones" name="especificaciones"  value=""  placeholder="Especificaciones (Sano,sordo...)"><br><br>
                <input type="text" id="caracteristicas" name="caracteristicas"  value=""  placeholder="Caraterísticas (Color,Tamaño...)"><br><br>
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
                        <input type="file" id ="archivo" name="archivo" accept=".jpg, .jpeg, .png" onchange="handleFileChange()"/>
                        <img id="selected-image" class="selected-image" style="display: none;" alt="Imagen seleccionada">
                    </label><br><br>

                <label class="custom-file-upload">
                        <span class="file-upload-text" id="file-text">Subir Foto de tu mascota</span>
                        <input type="file" id ="archive" name="archive" accept=".jpg, .jpeg, .png" onchange="handlFileChange()"/>
                        <img id="select-image" class="select-image" style="display: none;" alt="Imagen seleccionada">
                    </label><br><br>
                    

                <label class="categoria">
                <select name="categoria">
                    <option value="0">Selecciona su categoria</option>
                    <option value="1">Match</option>
                    <option value="2">Adopcion</option>
                </select></label>

            </div>
            
            <input type="submit" name="registrar" onclick=" return validar();" value="Registrar">

        </form>
    </div>

<?php 

} else {header("Location: ../Inicio/index.php");
  exit();
} 
?>

