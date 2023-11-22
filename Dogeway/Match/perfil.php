<?php
include_once '../Inicio/includes/user.php';
include_once '../Inicio/includes/user_session.php';
include_once '../Inicio/includes/conexion.php';

$userSession = new UserSession();
$user = new User();

$bool;

if (isset($_SESSION['user'])) {
    $user->setUser($userSession->getCurrentUser());

    // Obtener la lista de usuarios excluyendo al usuario actual
    $userId = $user->getUserId();
    $allUsersQuery = "SELECT * FROM usuario WHERE id != $userId";
    $allUsers = mysqli_query($conexion, $allUsersQuery);

    if ($allUsers) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERFILES</title>
    <link rel="stylesheet" href="http://localhost/Dogeway/CSS/match.css">
</head>
<body>
    <nav class="nav">
    <div class=ranalogo>
                <img class="rana" src="http://localhost/Dogeway/Imagenes/Rana_blanco.png">
                <div class="logo"> DOGEWAY</div>
        </div>
        <ul class="menu">
        <li><a href="../index.php">REGRESAR</a></li>
        <li><a href="#">MENSAJES</a></li>
        </ul>
    </nav>

    <?php
        while ($consultaUs = mysqli_fetch_array($allUsers)) {
            if ($consultaUs['id'] != $user->getUserId()) {
    ?>
    <div class="recuadro">
    <ul class = "tabla">
                <ul>
                    <li class = "c1">
                        <img class = "imgMascota" src="../Registro/archivos/<?php echo $consultaUs['fotografia']?>" class="card-img-top" alt="...">
                    </li>

                    <li class = "c2">
                        <ul class ="u1">
                        <img class = "imgUsuario" src="../Registro/archivos/<?php echo $consultaUs['fotografia']?>" class="card-img-top" alt="...">

                        </ul>

                        <ul class ="u2">    
                            <div class ="textoUsuario">
                                <p><?php echo $consultaUs['nombre'], "<br> ";
                                         echo $consultaUs['apellidos'],"<br><br>";
                                         echo $consultaUs['municipio'], "<br>";
                                         echo $consultaUs['fechanac'], "<br>";

                                ?></p>
                            </div>
                        </ul>
                    </li>
                </ul>
                <ul>
                    <li class = "c3">
                        
                    </li>
                    
                    <li class = "c4">
                        <?php $id = $consultaUs['id']?>
                        <?php
        
        $id1 = $user->getUserId();
        $id2 = $consultaUs['id'];
        
        // Mostrar botones según el estado del match
        $existingMatch = checkMatch($conexion, $id1, $id2);
        
        if ($existingMatch !== false) {
            if ($existingMatch['status'] == 2) {
                echo '<p>MATCH</p>';
                echo '<button id="googleButton" onclick="goToGoogle()">CHAT</button>';
            } else {
                echo "<button class='corazon' onclick='match($id1, $id2)'>Match</button>";
                echo "<button class='aceptarmatch' onclick='aceptarmatch($id1, $id2)' " . ($existingMatch['status'] == 1 ? '' : 'disabled') . ">aceptar match</button>";
            }
        } else {
            echo "<button class='corazon' onclick='match($id1, $id2)'>Match</button>";
        }
        
        echo "<button class='rechazar' onclick='rechazar($id1, $id2)'>Rechazar</button>";
        echo "<button class='amigos' onclick='amigos($id1, $id2)'>Amigos</button>";
        
  ?>
                       
                    </li>
                </ul>
           </ul>
            
        </div>


    </div>

    <?php
            }
        }

    } else {
        echo "Error en la consulta a la base de datos.";
    }
} else {
    header("Location: ../Inicio/index.php");
    exit();
}
?>
<script>
    // IR AL CHAT
    function goToGoogle() { // AQUI TE DEBE LLEVAR AL CHAT
    // Redirigir a Google
    window.location.href = 'https://www.google.com';
}
   //FUNCION DE MATCH SIN DESHABILITAR EL BOTON MATCH 

   function match(id1, id2) {
    var status = 1; // Definir el estado del match 1 es esperando respuesta
    var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Manejar la respuesta si es necesario
            if (status === 2) {
                // Redirigir a ambas personas a Google
                window.location.href = 'https://www.google.com';
            }
        }
    };
   xhttp.open("GET", "insertar_match.php?id1=" + id1 + "&id2=" + id2 + "&status=" + status, true);
    xhttp.send();
    //notificarMatchPendiente(id2);
    alert("Match enviado");

    // Habilitar el botón de aceptar match en el lado del remitente
    var aceptarmatchButto = document.getElementById('aceptarmatchButto_' + id1);
    if (aceptarmatchButto) {
        aceptarmatchButto.disabled = false;
    }
}
   // BOTON ACEPTAR MATCH
    function aceptarmatch(id1, id2) {
    var status = 2; // Cambiar el estado de la amistad a 2
    insertOrUpdateMatch(id1, id2, status); // Cambiado a insertOrUpdateMatch
    alert("Solicitud de amor");

    // Habilitar el boton match
    var aceptarmatchButton = document.getElementById('aceptarmatchButton');
    if (aceptarmatchButton) {
        aceptarmatchButton.disabled = false;
    }
}
    // INSERTA MATCH
    function insertOrUpdateMatch(id1, id2, status) { // Cambiado a insertOrUpdateMatch
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // Manejar la respuesta si es necesario
            }
        };
        xhttp.open("GET", "actualizar_status.php?id1=" + id1 + "&id2=" + id2 + "&status=" + status, true);
        xhttp.send();
    }
</script>

</body>
</html>
