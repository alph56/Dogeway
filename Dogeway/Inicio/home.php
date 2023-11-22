<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INICIO</title>
    <link rel="stylesheet" href="http://localhost/Dogeway/CSS/home.css">
</head>
<body>
    <header>
        <nav class="nav">
            <div class=ranalogo>
                <img class="rana" src="http://localhost/Dogeway/Imagenes/Rana_blanco.png">
            <div class="logo"> DOGEWAY</div> </div>
            <ul class="menu">
              <li><a>PERFIL</a><br>
                  <ul class="submenu">
                      <li><a href="http://localhost/Dogeway/Match/perfil.php">Ver Perfiles</a></li>
                      <li> <a href="http://localhost/Dogeway/RegistroMascota/registro.php">Registro de Mascotas</a></li>
                      <li><a>Editar Perfil</a></li>
                  </ul>
              </li>
              <li><a>ADOPCION</a><br>
                  <ul class="submenu">
                      <li><a href ="http://localhost/Dogeway/Match/adopcion.php">Ver Perfiles</a></li>
                      <li><a>Registro de Adopción</a></li>
                      <li><a>Editar Perfil de Adopción</a></li>
                      <li><a href ="http://localhost/Dogeway/Mensajes/chat.php">Chat</a></li>
                      <li>
                        <form enctype= "multipart/form-data" action="conexion.php" method="post">
                        <label class="Filtro">
                            <select name ="filt"> 
                            <option value="0">Todas las especies</option>
                            <option value="1">Perros</option>
                            <option value="2">Gatos</option>
                            <option value="3">Aves</option>
                            <option value="4">Reptiles</option>
                            <option value="5">Acuaticos</option>
                            <option value="6">Roedores</option>
                            </select></label>

                            <input type="submit" name="filtro" value="Filtro">
                        </form>
                       </li>
                  </ul>
              </li>
                <li><a href="http://localhost/Dogeway/Inicio/includes/logout.php">CERRAR SESION</a></li>
            </ul>
        </nav>
        <section>
        <h1>Bienvenido <?php echo $user->getNombre(); echo $user->getuserId(); echo $user->getusername(); ?> </h1>
        </section>
    </header>
    
    
</body>
</html>