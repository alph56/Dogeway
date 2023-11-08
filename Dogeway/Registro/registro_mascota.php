<!DOCTYPE html>
<html>
<head>
    <link href="../CSS/regMasc.css" rel="stylesheet" type="text/css" />
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

            <input type="text" name="nombreMascota" required placeholder="Ingresa el nombre de tu mascota"><br><br>
            <input type="text" name="descripcion" required placeholder="Agrega una descripción"><br><br>
            <input type="text" name="raza" required placeholder="Ingresa la raza"><br><br>
            <input type="text" name="edad" required placeholder="Ingresa la edad"><br><br>

        </div>

        <div class="columna">

            <input type="text" name="cartilla" required placeholder="Sube la cartilla de tu mascota"><br><br>
            <input type="text" name="curp" required placeholder="Sube la fotografía de tu mascota"><br><br>

        </div>
        
        <input type="submit" name="registrar" value="Registrar">
    </form>
</div>
