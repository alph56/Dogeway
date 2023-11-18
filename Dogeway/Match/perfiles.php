<?php
 include_once '../Inicio/includes/user.php';
 include_once '../Inicio/includes/user_session.php';
$userSession = new UserSession();
$user = new User();
$servername = "localhost";
$username = "root";
$password = "";
$database = "dogeway";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
if(isset($_SESSION['user'])){
    $user->setUser($userSession->getCurrentUser());

// obtiene el id donde de la cuenta que estas usando
$userId = $user->getUserId();

// Consulta para obtener todos los datos de la tabla usuario excluyendo al usuario logeado
$sql = "SELECT * FROM usuario WHERE id != $userId";
$result = $conn->query($sql);

// Función para verificar si hay un match entre dos usuarios
function checkMatch($conn, $id1, $id2) {
    $sql = "SELECT * FROM `match` WHERE (id1 = $id1 AND id2 = $id2) OR (id1 = $id2 AND id2 = $id1)";
    $result = $conn->query($sql);

    // Verificar si hay un match
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();  // Devolver los datos del match
    } else {
        return false;  // No hay match
    }
}

// Función para insertar un nuevo match en la tabla
function insertMatch($conn, $id1, $id2, $status) {
    $stmt = $conn->prepare("INSERT INTO `match` (id1, id2, status) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $id1, $id2, $status);
    $stmt->execute();
    $stmt->close();
}
} else {header("Location: ../Inicio/index.php");
    exit();
  } 
  // Función para eliminar un match de la tabla

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="http://localhost/Dogeway/CSS/nosotros.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfiles</title>
    <style>
        /* Estilos CSS aquí ... */

        .tarjeta {
            background-color: white;
            border: 10px solid #ddd;
            padding: 70px; /* Ajusta el tamaño de padding  */
            margin-bottom: 30px;
            text-align: center;
            max-width: 500px; /* Ancho máximo de la tarjeta */
            margin: 0 auto; /* Centra la tarjeta en el contenedor */
        }

        img {
            max-width: 200px; /* Establece el ancho máximo de las imágenes */
            max-height: 200px; /* Establece la altura máxima de las imágenes */
            border: none; /* Elimina el borde de las imágenes */
            display: block; /* Alinea la imagen en el centro */
            margin: 0 auto; /* Centra la imagen en la celda */
        }

        .nickname {
            text-align: center; /* Alinea el texto en el centro */
        }

        .match,
        .amigos,
        .rechazar,
        .amistad {
            cursor: pointer;
            border: none;
            background: none;
            padding: 0;
            display: inline;
            margin: 30px;
        }
    </style>
</head>

<body>
<h1>Bienvenido <?php echo $user->getNombre(); echo $user->getuserId(); echo $user->getusername(); ?> </h1>
    <header>
   
        <!-- ... tu código HTML existente ... -->

        <?php
        
        // Verificar si hay datos en la tabla
        if ($result->num_rows > 0) {
            // Mostrar los datos en una tarjeta
            while ($row = $result->fetch_assoc()) {
                echo '<div class="tarjeta">';
                $imagenPath = 'http://localhost/Dogeway/Registro/archivos/' . $row['fotografia'];
                echo '<img src="' . $imagenPath . '" alt="fotografía">';
                echo '<p class="nickname">' . $row['nickname'] . '</p>';

                $id1 = $user->getUserId(); //Cuenta desde la cual mandas match
                $id2 =  $row['id'];  // Persona a la que mandas el match

                
         // Mostrar botones según el estado del match
          // Verificar si ya hay un match
$existingMatch = checkMatch($conn, $id1, $id2);

// Mostrar botones según el estado del match
if ($existingMatch !== false) {
    if ($existingMatch['status'] == 2) {
        echo '<p>Ya hay un match</p>';
        echo '<button id="googleButton" onclick="goToGoogle()">CHAT</button>';
         
      
    } else {
         // Si no hay match existente, mostrar el botón de match y deshabilitar el botón de amistad
        echo "<button class='corazon' onclick='match($id1, $id2)'><img src='http://localhost/Dogeway/Imagenes/hearth.png' alt='match' style='width:30px; height:30px;'></button>";
        echo "<button class='amistad' onclick='amistad($id1, $id2)' id='amistadButton' " . ($existingMatch['status'] == 1 ? '' : 'disabled') . "><img src='http://localhost/Dogeway/Imagenes/Rana_logo.png' alt='amistad' style='width:35px; height:35px;'></button>";

    }
} else {
    // Si no hay match existente, mostrar el botón para cualquier combinación de id1 e id2
    echo "<button class='corazon' onclick='match($id1, $id2)'><img src='http://localhost/Dogeway/Imagenes/hearth.png' alt='match' style='width:30px; height:30px;'></button>";
}           echo "<button class='rechazar' onclick='rechaza($id1, $id2)'><img src='http://localhost/Dogeway/Imagenes/x.png' alt='rechazar' style='width:30px; height:30px;'></button>";
                echo "<button class='amigos' onclick='amigos($id1, $id2)'><img src='http://localhost/Dogeway/Imagenes/manos.png' alt='amigos' style='width:35px; height:35px;'></button>";
                echo '</div>';
            }
        } else {
            echo 'No hay perfiles por mostrar';
        }

        // Cerrar la conexión
        $conn->close();
        ?>
        
    </header>
 
    <script>
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
    notificarMatchPendiente(id2);
    alert("Match enviado");

    // Habilitar el botón de amistad en el lado del remitente
    var amistadButton = document.getElementById('amistadButton_' + id1);
    if (amistadButton) {
        amistadButton.disabled = false;
    }
}
   // AMIGOS Y AMISTAD ES DIFERENTE, AMISTAD VA JUNTO A MATCH Y AMIGOS ES DIFERENTE

    function rechaza(id1, id2) {
        alert("Perfil rechazado");
    }
    function amigos(id1, id2) {
        alert("Solicitud de friendzone");
    }

    function amistad(id1, id2) {
    var status = 2; // Cambiar el estado de la amistad a 2
    insertMatch(id1, id2, status);
    alert("Solicitud de amistad enviada");

    // Habilitar el botón de amistad
    var amistadButton = document.getElementById('amistadButton');
    if (amistadButton) {
        amistadButton.disabled = false;
    }
}



    // Habilitar el botón de aceptar el match
    function habilitarAmistadButton() {
        var amistadButton = document.getElementById('amistadButton');
        if (amistadButton) {
            amistadButton.disabled = false;
        }
    }
    function insertMatch(id1, id2, status) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // Manejar la respuesta si es necesario
            }
        };
        xhttp.open("GET", "insertar_match.php?id1=" + id1 + "&id2=" + id2 + "&status=" + status, true);
        xhttp.send();
    }

</script>

</body>
</html>
