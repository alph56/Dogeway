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
              <li><a href="#">ADOPCION</a></li>
              <li><a>PERFIL</a><br>
                  <ul class="submenu">
                      <li><a href="http://localhost/Dogeway/Visualizacion/visualizacion-main.php">Ver Perfil</a></li>
                      <li> <a href="http://localhost/Dogeway/RegistroMascota/registro.php">Registrar Mascota</a></li>
                      <li><a href="http://localhost/Dogeway/Visualizacion/visualizacion-main.php">Editar Perfil</a></li>
                  </ul>
              </li>
              <li><a href="http://localhost/Dogeway/Chat/users.php">CHAT</a></li>
              <li><a href="http://localhost/Dogeway/Inicio/includes/logout.php">CERRAR SESION</a></li>
            </ul>
        </nav>
        <section>
        <h1>Bienvenido <?php echo $user->getNombre(); echo $user->getuserId(); echo $user->getusername(); ?> </h1>
          <h2 class="especial">Revisa las funciones en la barra de arriba</h2>
          <img class="subtitulo-main welcome" src="http://localhost/Dogeway/Imagenes/doggy_welcome.png">
        </section>
    </header>
    
</body>
</html>