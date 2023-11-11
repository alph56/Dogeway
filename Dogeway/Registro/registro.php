<!DOCTYPE html>
<html>
<head>
    <link href="../CSS/registro.css" rel="stylesheet" type="text/css" />
    <title>Registro de Cuenta</title>

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
    <div class=ranalogo>
<img class="rana" src="../Imagenes/Rana_blanco.png">
        <div class="logo"> DOGEWAY</div> </div>
        <ul class="menu">
            <li><a href="../index.php">PAGINA PRINCIPAL</a></li>
        </ul>
</nav>

<div class= registro>
    <h2 class="titulo">REGISTRATE</h2>
    
        <div id="error-message" style="color: red; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 12px; margin-bottom: 17px;"></div>
        <?php
            if (isset($_GET['error'])) {
                $errorRegistro = urldecode($_GET['error']);
                echo '<script>';
                echo 'mostrarError("' . $errorRegistro . '");';
                echo '</script>';
            }
        ?>

    <form id="registroform" enctype= "multipart/form-data" action="enviar_email.php" method="post">
        

        <div class=columna>

            <input type="text" id="nombre" name="nombre" required placeholder="Ingresa tu nombre(s)"><br><br>
            <input type="text" id="apellidos" name="apellidos" required placeholder="Ingresa tus apellidos"><br><br>
            <input type="text" id="nickname" name="nickname" required placeholder="Ingresa tu nickname"><br><br>
            <input type="email" id="email" name="email" required placeholder="Ingresa tu correo"><br><br>
            <input type="password" name="pass" required placeholder="Ingresa tu contraseña"><br><br>
            <input type="text" id="municipio" name="municipio" required placeholder="Ingresa tu municipio"><br><br>

        </div>
        
        <div class=columna>

            <input type="text" id="telefono" name="telefono" required placeholder="Introduce tu telefono"><br><br>
            <input type="text" id="curp" name="curp" required placeholder="Introduce tu curp"><br><br>
            <input type="text" id="ine" name="ine" required placeholder="Introduce tu INE"><br><br>
            <label>Fecha de nacimiento:
            <input type="date" name="fechanac" required>
            </label>

            <label class="custom-file-upload">
                <span class="file-upload-text" id="file-text">Subir Foto</span>
                <input type="file" id ="archivo" name="archivo" accept=".jpg, .jpeg, .png" required onchange="handleFileChange()"/>
                <img id="selected-image" class="selected-image" style="display: none;" alt="Imagen seleccionada">
            </label><br>
            
        </div>

            

        <input type="submit" name="registrar" value="Registrar">
    </form>
    <div class=registro2>
    <a href="../Inicio/index.php">Ya tienes una cuenta? Inicia sesión</a>
    </div>
</div>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var savedFormData = localStorage.getItem('registroFormData');

        if (savedFormData) {
            var formData = JSON.parse(savedFormData);
            document.getElementById('nombre').value = formData.nombre || '';
            document.getElementById('apellidos').value = formData.apellidos || '';
            document.getElementById('nickname').value = formData.nickname || '';
            document.getElementById('email').value = formData.email || '';
            document.getElementById('municipio').value = formData.municipio || '';
            document.getElementById('telefono').value = formData.telefono || '';
            document.getElementById('ine').value = formData.ine || '';
            document.getElementById('curp').value = formData.curp || '';
        }

        document.getElementById('registroform').addEventListener('submit', function () {
            var formData = {
                nombre: document.getElementById('nombre').value,
                apellidos: document.getElementById('apellidos').value,
                nickname: document.getElementById('nickname').value,
                email: document.getElementById('email').value,
                municipio: document.getElementById('municipio').value,
                telefono: document.getElementById('telefono').value,
                ine: document.getElementById('ine').value,
                curp: document.getElementById('curp').value,
            };

            localStorage.removeItem('registroFormData');

            localStorage.setItem('registroFormData', JSON.stringify(formData));

        });
    });
</script>

