<?php 
    include_once '../Inicio/includes/user.php';
    include_once '../Inicio/includes/user_session.php';
    
    $userSession = new UserSession();
    $user = new User();

    if(isset($_SESSION['user'])){
    $user->setUser($userSession->getCurrentUser());

?>

<!DOCTYPE html>
<html>

    <head>

    <title>Edición de Perfil</title>
        <link href="../CSS/registro1.css" rel="stylesheet" type="text/css" />
        <script src="jquery-3.3.1.min.js"></script>

        <script>

            variable1 = 0;
            variable2 = 0;
            variable3 = 0;
    
            function validarN() {
            var nickname = $('#nickname').val();
            $.ajax({
                url         : 'verificar1.php',
                type        : 'post',
                dataType    : 'text',
                data: {
                nickname: nickname,
                },
                success     : function(res) {
                    console.log(res);
                    if (res = "nickname"){
                        variable1 = 1;
                    } else{  
                        variable1 = 0;  
                    }
                    
                },error: function() {
                    alert ('Error');
                }
            });
            } 

            function validarC() {
            var curp = $('#curp').val();
            $.ajax({
                url         : 'verificar2.php',
                type        : 'post',
                dataType    : 'text',
                data: {
                curp : curp,
                },
                success     : function(res) {
                    console.log(res);
                    if (res = "curp"){
                        variable2 = 1;
                    } else {
                        variable2 = 0;
                    }
                    
                },error: function() {
                    alert ('Error');
                }
            });
            } 

            function validarI() {
            var ine = $('#ine').val();
            $.ajax({
                url         : 'verificar3.php',
                type        : 'post',
                dataType    : 'text',
                data: {
                    ine: ine,
                },
                success     : function(res) {
                    console.log(res);
                    if (res = "ine"){
                        variable3 = 1;
                    } else {
                        variable3 = 0;
                    }
                    
                },error: function() {
                    alert ('Error');
                }
            });
            }

            function validar() {
                var nombre = $('#nombre').val();
                var apellidos = $('#apellidos').val();
                var nickname = $('#nickname').val();
                var pass = $('#pass').val();
                var municipio = $('#municipio').val();
                var telefono = $('#telefono').val();
                var curp = $('#curp').val();
                var ine = $('#ine').val();
                var archivo = $('#archivo').val();

                if (nombre == '' || apellidos == '' || nickname == '' || municipio == '' || telefono == '' ||
                    curp == '' || ine == '') {
                    mostrarMensajeError('Faltan campos por llenar');
                    return false;
                }else if (variable1 == 1){
                    mostrarMensajeError('El nickname esta en uso');
                    return false;
                }else if (variable2 == 1){
                    mostrarMensajeError('Ese CURP ya esta en uso');
                    return false;
                }else if (variable3 == 1){
                    mostrarMensajeError('Ese INE ya esta en uso');
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
        </script>

    </head>
    
    <body>

<nav class="nav">
    <div class=ranalogo>
<img class="rana" src="../Imagenes/Rana_blanco.png">
        <div class="logo"> DOGEWAY</div> </div>
        <ul class="menu">
            <li><a href="../index.php">PAGINA PRINCIPAL</a></li>
        </ul>
</nav>

    <div class= registro>
        <h2 class="titulo">EDITAR PERFIL</h2>

        <form enctype= "multipart/form-data" action="enviarEditar.php" method="post">
            
            <div id="mensaje"></div>
            <div id="message"></div>
            <div class=columna>
                <input type="hidden" name="iduser" value="<?php echo $user->getuserId();?>">
                <input type="text" id="nombre" name="nombre" value = "<?php echo $user->getNombre();?>" placeholder="Editar tu nombre(s)"><br><br>
                <input type="text" id="apellidos" name="apellidos" value = "<?php echo $user->getApellidos();?>" placeholder="Editar tus apellidos"><br><br>
                <input type="text" id="nickname" name="nickname"  value = "<?php echo $user->getUsername();?>" placeholder="Editar nickname" onblur="validarN();"><br><br>
                <input type="password" name="pass" placeholder="Editar contraseña"><br><br>
                <input type="text" id="municipio" name="municipio" value = "<?php echo $user->getMunicipio();?>" placeholder="Ingresa tu municipio"><br><br>
            </div>
            
            <div class=columna>

                <input type="text" id="telefono" name="telefono" value = "<?php echo $user->getusertel();?>" placeholder="Editar tu telefono"><br><br>
                <input type="text" id="curp" name="curp" value = "<?php echo $user->getCurp();?>" placeholder="Editar tu curp" onblur="validarC();"><br><br>
                <input type="text" id="ine" name="ine" value = "<?php echo $user->getINE();?>" placeholder="Editar tu INE" onblur="validarI();"><br><br>
                
                <label>
        
                </label>

                <label class="custom-file-upload">
                    <span class="file-upload-text" id="file-text">Editar Foto</span>
                    <input type="file" id ="archivo" name="archivo" accept=".jpg, .jpeg, .png" onchange="handleFileChange()"/>
                    <img id="selected-image" class="selected-image" style="display: none;" alt="Imagen seleccionada">
                </label><br>
                
            </div>

            <input type="submit" onclick=" return validar();" name="registrar" value="Editar">
        </form>
    </div>

</body>

<?php 

} else {header("Location: ../Inicio/index.php");
  exit();
} 
?>