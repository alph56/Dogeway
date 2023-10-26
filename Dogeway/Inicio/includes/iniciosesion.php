<!DOCTYPE html>
<html>
<head>
    <link href="CSS/style.css" rel="stylesheet" type="text/css" />
    <title>Inicio de sesión</title>
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

<div class= inicio>
    <h2 class="titulo">INICIAR SESIÓN</h2>
    <form action="" method="POST">
        <?php
            if(isset($errorLogin)){
            echo $errorLogin;
            }
        ?>

        <div class=columna> 
            <input type="text" name="username" required placeholder="Ingresa tu nickname"><br><br>
            <input type="password" name="password" required placeholder="Ingresa tu contraseña"><br><br>
        </div>

        <input type="submit" value="Ingresar">
    </form>
    <div class=registro2>
    <a href="../Registro/registro.php" style ="color=#2ca880;">No tienes una cuenta? Registrate</a>
    </div>
</div>
