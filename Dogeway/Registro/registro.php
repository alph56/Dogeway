<!DOCTYPE html>
<html>
<head>
    <link href="../CSS/register.css" rel="stylesheet" type="text/css" />
    <title>Registro de Cuenta</title>

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

    <form action="enviar_email.php" method="post">
         <!-- <label for="">Fotografia:</label>
        <input type="file" name="fotografia"><br><br>  -->

        <div class=columna>

            <input type="text" name="nombre" required placeholder="Ingresa tu nombre(s)"><br><br>
            <input type="text" name="apellidos" required placeholder="Ingresa tus apellidos"><br><br>
            <input type="text" name="nickname" required placeholder="Ingresa tu nickname"><br><br>
            <input type="email" name="email" required placeholder="Ingresa tu correo"><br><br>
            <input type="password" name="pass" required placeholder="Ingresa tu contraseña"><br><br>
            <input type="text" name="municipio" required placeholder="Ingresa tu municipio"><br><br>

        </div>
        
        <div class=columna>

            <input type="text" name="telefono" required placeholder="Introduce tu telefono"><br><br>
            <input type="text" name="curp" required placeholder="Introduce tu curp"><br><br>
            <input type="text" name="ine" required placeholder="Introduce tu INE"><br><br>
            <label>Fecha de nacimiento:</label>
            <input type="date" name="fechanac" required><br><br>
        
        </div>

        <input type="submit" name="registrar" value="Registrar">
    </form>
    <div class=registro2>
    <a href="../Inicio/index.php">Ya tienes una cuenta? Inicia sesión</a>
    </div>
</div>

