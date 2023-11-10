<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INICIO</title>
    <link rel="stylesheet" href="http://localhost/Dogeway/CSS/index.css">
</head>
<body>
    <header>
        <nav class="nav">
            <div class=ranalogo>
                <img class="rana" src="http://localhost/Dogeway/Imagenes/Rana_blanco.png">
            <div class="logo"> DOGEWAY</div> </div>
            <ul class="menu">
                <li><a>PERFIL</a><br>
                <li><a>ADOPCION</a><br>
              <li><a>Perfil</a><br>
                  <ul class="submenu">
                      <li><a>Ver Perfiles</a></li>
                      <li><a>Registro de Mascotas</a></li>
                      <li><a>Editar Perfil</a></li>
                  </ul>
              </li>
              <li><a>Adopción</a><br>
                  <ul class="submenu">
                      <li><a>Ver Perfiles</a></li>
                      <li><a>Registro de Adopción</a></li>
                      <li><a>Editar Perfil de Adopción</a></li>
                  </ul>
              </li>
                <li><a href="http://localhost/Dogeway/Inicio/includes/logout.php">CERRAR SESION</a></li>
            </ul>
        </nav>
        <section>
        <h1>Bienvenido <?php echo $user->getNombre(); ?> </h1>
        </section>
    </header>
    
    
</body>
</html>