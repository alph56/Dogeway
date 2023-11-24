<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INICIO</title>
    <link rel="stylesheet" href="http://localhost/Dogeway/CSS/index.css">
    <script src="jquery-3.3.1.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        setTimeout(function() {
    
            var alertaMostrada = getCookie("alertaMostrada");

            if (!alertaMostrada && esPrimerDiaDelMes()) {
            alert("¡Es el primer día del mes! Por protocolos de identificacion, es necesario que actualices la informacion ingresada, esto nos ayuda a mantener a los demas usuarios al dia (●'◡'●) .");
            window.location.href = "../RegistroMascota/registro.php"; // Cambiar a la edicion del usuario
            setCookie("alertaMostrada", "true", 30);
            }
        }, 5000);

        function esPrimerDiaDelMes() {
            var fechaActual = new Date();
            return fechaActual.getDate() === 19; // Cambiado a la fecha 18 para pruebas
        }

        function setCookie(nombre, valor, dias) {
            var fechaExpiracion = new Date();
            fechaExpiracion.setDate(fechaExpiracion.getDate() + dias);
            var cookie = nombre + "=" + valor + ";expires=" + fechaExpiracion.toUTCString() + ";path=/";
            document.cookie = cookie;
        }

        function getCookie(nombre) {
            var nombreEQ = nombre + "=";
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i];
            while (cookie.charAt(0) === ' ') cookie = cookie.substring(1, cookie.length);
            if (cookie.indexOf(nombreEQ) === 0) return cookie.substring(nombreEQ.length, cookie.length);
            }
            return null;
        }
        });
    </script>

</head>

<body>
    <header>
        <nav class="nav">
            <div class=ranalogo>
                <img class="rana" src="http://localhost/Dogeway/Imagenes/Rana_blanco.png">
            <div class="logo"> DOGEWAY</div> </div>
            <ul class="menu">
              <li><a href="#">MATCH</a></li>
              <li><a href="http://localhost/Dogeway/Adopcion/adopcion.php">ADOPCION</a>
                    <ul class="submenu">
                        <form enctype= "multipart/form-data" action="http://localhost/Dogeway/Adopcion/adopcion.php" method="post">
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
                              
                            <br><br>
                            <tr><input type="submit" name="filtro" value="  Filtrar busqueda">
                        </form>
                        </ul>
              </li>
              <li><a>PERFIL</a><br>
                  <ul class="submenu">
                      <li><a href="http://localhost/Dogeway/Visualizacion/visualizacion-main.php">Ver Perfil</a></li>
                      <li> <a href="http://localhost/Dogeway/RegistroMascota/registro.php">Registrar Mascota</a></li>
                      <li><a href="#">Editar Perfil</a></li>
                  </ul>
              </li>
              <li><a href="http://localhost/Dogeway/Chat/users.php">CHAT</a></li>
              <li><a href="http://localhost/Dogeway/Inicio/includes/logout.php">CERRAR SESION</a></li>
            </ul>
        </nav>
        <section>
        <h1>Bienvenido <?php echo $user->getNombre(); echo $user->getuserId(); echo $user->getusername(); ?> </h1>
        </section>
    </header>
    
</body>
</html>