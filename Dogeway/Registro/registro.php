<!DOCTYPE html>
<html>
<head>
    <link href="CSS/style.css" rel="stylesheet" type="text/css" />
    <title>Registro de Cuenta</title>
</head>
<body>

<nav class="nav">
    <div class=ranalogo>
<img class="rana" src="../Imagenes/Rana_blanco.png">
        <div class="logo"> DOGEWAY</div> </div>
        <ul class="menu">
            <li><a href="index.html">PAGINA PRINCIPAL</a></li>
            <li><a href="nosotros.html">NOSOTROS</a></li>
        </ul>
</nav>

<div class= registro>
    <h2 class="titulo">REGISTRATE</h2>
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
            <label>Fecha de nacimiento:</label>
            <input type="date" name="fechanac" required><br><br>
        
        </div>

        <!-- <label for="">INE:</label>
        <input type="file" name="ine"><br><br>  -->

        <input type="submit" name="registrar" value="Registrar">
    </form>
    <div class=registro2>
    <a href="../Inicio/inicio.php">Ya tienes una cuenta? Inicia sesión</a>
    </div>
</div>

