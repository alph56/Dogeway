<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INICIO</title>
    <link rel="stylesheet" href="http://localhost/Dogeway/CSS/indexs.css">
    <script src="http://localhost/Dogeway/Inicio/jquery-3.3.1.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        setTimeout(function() {
    
            var alertaMostrada = getCookie("alertaMostrada");

            if (!alertaMostrada && esPrimerDiaDelMes()) {
            alert("¡Es el primer día del mes! Por protocolos de identificacion, es necesario que actualices la informacion ingresada, esto nos ayuda a mantener a los demas usuarios al dia (●'◡'●) .");
            window.location.href = "../Perfil/lista.php";
            setCookie("alertaMostrada", "true", 30);
            }
        }, 5000);

        function esPrimerDiaDelMes() {
            var fechaActual = new Date();
            return fechaActual.getDate() === 29; // Cambiado a la fecha 18 para pruebas
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
            <?php 
            $adminson = $user->getAdmin();
            if ($adminson == 1) {?>
              <li><a href="http://localhost/Dogeway/admin/home.php">ADMIN</a></li>
              <?php } ?>
              <li><a href="http://localhost/Dogeway/Match/lista.php">MATCH</a></li>
              <li><a href="http://localhost/Dogeway/Adopcion/adopcion.php">ADOPCION</a></li>
              <li><a href="http://localhost/Dogeway/Perfil/lista.php">PERFIL</a><br>
                  <ul class="submenu">
                      <li> <a href="http://localhost/Dogeway/RegistroMascota/registro.php">Registrar Mascota</a></li>
                  </ul>
              </li>
              <li><a href="http://localhost/Dogeway/Chat/users.php">CHAT</a></li>
              <li><a href="http://localhost/Dogeway/Inicio/includes/logout.php">CERRAR SESION</a></li>
            </ul>
        </nav>
        <section>
        <h1>Bienvenido, @<?php echo $user->getUsername();?> !</h1>
        <div class="recuadro">
            <div class="columna_izquierda">
                <div class="fila1">
                <img class="subtitulo-main welcome" src="http://localhost/Dogeway/Imagenes/doggy_welcome.png">
                </div>
            </div>

            <div class="columna_derecha">
                <div class="fila2">
                    <div class="notificaciones">
                        <p>¡Aqui se mostraran algunas notificaciones para actualizaciones futuras!</p>
                        (❁´◡`❁)
                    </div>
                </div>
            </div>
        </div>
        </section>
    </header>
    
</body>
</html>