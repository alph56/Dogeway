<?php 
    //INCLUIR TODO ESTE BLOQUE DE PHP EN CADA archivo con HTML
    include_once '../Inicio/includes/user.php';
    include_once '../Inicio/includes/user_session.php';
    
    $userSession = new UserSession();
    $user = new User();

    if(isset($_SESSION['user'])){
    $user->setUser($userSession->getCurrentUser());
    //ABAJO TMBN ESTA EL OTRO PEDAZO DEL BLOQUE, PONERLO AL FINAL
?>

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
            return fechaActual.getDate() === 18; // Cambiado a la fecha 18 para pruebas
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
              <li><a href="http://localhost/Dogeway/Perfil/perfil.php">PERFIL</a></li>
              <li><a href="http://localhost/Dogeway/Adopcion/adopcion.php">ADOPCION</a></li>
              <li><a href="http://localhost/Dogeway/Inicio/includes/logout.php">CERRAR SESION</a></li>
            </ul>
        </nav>
        <section>
        <h1>Bienvenido <?php echo $user->getNombre(); echo $user->getuserId(); echo $user->getusername(); ?> </h1>
        </section>
    </header>
    

    
</body>
</html>

<?php 

} else {header("Location: ../Inicio/index.php");
  exit();
} 
?>