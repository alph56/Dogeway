<?php
include_once '../Inicio/includes/user.php';
include_once '../Inicio/includes/user_session.php';
include_once '../Inicio/includes/conexion.php';


$userSession = new UserSession();
$user = new User();

$bool;

if (isset($_SESSION['user'])) {
    $user->setUser($userSession->getCurrentUser());

    // Obtener la lista de las mascotas excluyendo a la usuario actual
    $userId = $user->getUserId();
    $allUsersQuery ="SELECT usuario.*, mascota.* 
                  FROM usuario 
                  LEFT JOIN mascota ON usuario.id = mascota.id_usuario 
                  WHERE usuario.id != $userId AND mascota.id IS NOT NULL AND mascota.categoria = 1";
                  
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
        <ul class="tabla">
            <ul>
                <li class="c1">
                    <img class="imgMascota" src="../Registro/archivos/<?php echo $consultaUs['fotografia']?>" class="card-img-top" alt="...">
                </li>

                <li class="c2">
                    <ul class="u1">
                        <img class="imgUsuario" src="../Registro/archivos/<?php echo $consultaUs['fotografia']?>" class="card-img-top" alt="...">
                    </ul>

                    <ul class="u2">    
                        <div class="textoUsuario">
                            <p><?php echo $consultaUs['nickname'], "<br> ";
                                    echo $consultaUs['municipio'], "<br><br>";
                                    echo $consultaUs['nombreMascota'],"<br>";
                                    echo $consultaUs['descripcion'], "<br>";
                            ?></p>
                        </div>
                    </ul>
                </li>
            </ul>
            <ul>
                <li class="c3">
                </li>

                <li class="c4">
                    <?php $id = $consultaUs['id']?>
                    <?php
                        $id1 = $user->getUserId();// Obtener el ID del usuario LOGEADO
                        $id2 = $user->getMascotaId();// Obtener el ID de la mascota del usuario logeado
                        $id3 = $consultaUs['id_usuario']; // Obtener el ID del usuario a hacer match
                        $id4 = $consultaUs['id']; // Obtener el ID de la mascota del usuario del match
                        
                        // Mostrar botones según el estado del match
                        $existingMatch = checkMatch($conexion, $id1, $id2, $id3, $id4);

                        if ($existingMatch !== false) {
                            if ($existingMatch['status'] == 2) {
                                echo '<p>MATCH</p>';
                                echo '<button id="googleButton" onclick="goToGoogle()">CHAT</button>';
                            } else {
                                
                               echo "<button class='aceptarmatch' onclick='aceptarmatch($id1, $id2, $id3, $id4)' " . (($existingMatch['status'] == 1) ? '' : 'disabled') . ">aceptar match</button>"; // acepta el match
                                echo "<button class='rechazo' onclick='rechazo($id1, $id2, $id3, $id4)' " . (($existingMatch['status'] == 1) ? '' : 'disabled') . ">rechazado</button>"; // rechaza
                               echo "<button class='aceptaramistad' onclick='aceptaramistad($id1, $id2, $id3, $id4)' " . (($existingMatch['status'] == 1) ? '' : 'disabled') . ">aceptar amistad</button>"; // acepta el match
                            }
                        } else {
                            echo "<button class='corazon' onclick='match($id1, $id2, $id3, $id4)'>Match</button>";
                            echo "<button class='rechazar' onclick='rechazar($id1, $id2,$id3, $id4)'>Rechazar</button>";
                            echo "<button class='amistad' onclick='amistad($id1, $id2,$id3, $id4)'>Amigos</button>";
                        }
                        
                        // echo "<button class='rechazar' onclick='rechazar($id1, $id2,$id3, $id4)'>Rechazar</button>";
                         //echo "<button class='amigos' onclick='amigos($id1, $id2,$id3, $id4)'>Amigos</button>";
                    ?>
                </li>
            </ul>
        </ul>
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
        // BOTON CHAT
 function goToGoogle() { // AQUI TE DEBE LLEVAR AL CHAT
    // Redirigir a Google
    window.location.href = 'https://www.google.com.mx/';
}
// FIN CHAT

// FUNCIONES MATCH
function match(id1, id2, id3, id4) {
    var status = 1; // Definir el estado del match 1 es esperando respuesta
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Manejar la respuesta si es necesario
           
        }
    };
    xhttp.open("GET", "insertar_match.php?id1=" + id1 + "&id2=" + id2 + "&id3=" + id3 + "&id4=" + id4 + "&status=" + status, true);
    xhttp.send();
    alert("Match enviado");
}

function aceptarmatch(id1, id2, id3, id4) {
    var status = 2; // Cambiar el estado del match 2
    insertOrUpdateMatch(id1, id2, id3, id4, status); // Cambiado a insertOrUpdateMatch
    alert("Hicieron match");
}

function insertOrUpdateMatch(id1, id2, id3, id4, status) { // Cambiado a insertOrUpdateMatch
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Manejar la respuesta si es necesario
        }
    };
    xhttp.open("GET", "actualizar_status.php?id1=" + id1 + "&id2=" + id2 + "&id3=" + id3 + "&id4=" + id4 + "&status=" + status, true);
    xhttp.send();
}
// FIN FUNCIONES MATCH

// INICIO FUNCIONES AMISTAD
function amistad(id1, id2, id3, id4) {
    var status = 1; // Definir el estado del match 1 es esperando respuesta
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Manejar la respuesta si es necesario
           
        }
    };
    xhttp.open("GET", "insertar_match.php?id1=" + id1 + "&id2=" + id2 + "&id3=" + id3 + "&id4=" + id4 + "&status=" + status, true);
    xhttp.send();
    alert("Amistad enviada");
}

function aceptaramistad(id1, id2, id3, id4) {
    var status = 2; // Cambiar el estado de la amistad a 2
    insertOrUpdateMatch(id1, id2, id3, id4, status); // Cambiado a insertOrUpdateMatch
    alert("Hay una amistad");
}

function insertOrUpdateMatch(id1, id2, id3, id4, status) { // Cambiado a insertOrUpdateMatch
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Manejar la respuesta si es necesario
        }
    };
    xhttp.open("GET", "actualizar_status.php?id1=" + id1 + "&id2=" + id2 + "&id3=" + id3 + "&id4=" + id4 + "&status=" + status, true);
    xhttp.send();
}
// FIN FUNCIONES AMISTAD

// INICIO FUNCIONES RECHAZAR
function rechazar(id1, id2, id3, id4) {
    var status = 0; // Definir el estado del match 1 es esperando respuesta
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Manejar la respuesta si es necesario
           
        }
    };
    xhttp.open("GET", "rechazar.php?id1=" + id1 + "&id2=" + id2 + "&id3=" + id3 + "&id4=" + id4 + "&status=" + status, true);
    xhttp.send();
    alert("Rechazaste este perfil");
}
function rechazo(id1, id2, id3, id4) {
    var status = 2; // Cambiar el estado de la amistad a 2
    inserteMatch(id1, id2, id3, id4, status); // Cambiado a insertOrUpdateMatch
    alert("Rechazaste este perfil");
}

function inserteMatch(id1, id2, id3, id4, status) { // Cambiado a insertOrUpdateMatch
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Manejar la respuesta si es necesario
        }
    };
    xhttp.open("GET", "actualizar_rechazado.php?id1=" + id1 + "&id2=" + id2 + "&id3=" + id3 + "&id4=" + id4 + "&status=" + status, true);
    xhttp.send();
}

// FIN FUNCIONES RECHAZAR


</script>
</body>
</html>
