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

<?php
$nuevoMascotaId = isset($_GET['selectedMascotaId']) ? $_GET['selectedMascotaId'] : '';
$nuevoMascota = isset($_GET['selectedMascota']) ? $_GET['selectedMascota'] : '';

$nombreMascota = isset($_GET['nombreMascota']) ? $_GET['nombreMascota'] : '';
$descripcion = isset($_GET['descripcion']) ? $_GET['descripcion'] : '';
$nombreArchivo = isset($_GET['nombreArchivo']) ? $_GET['nombreArchivo'] : '';

if (empty($nuevoMascotaId)) {
    $nuevoMascotaId = '';
    $nombreMascota = '';
    $descripcion = '';
    $nombreArchivo = 'default.jpg';
}

echo "<script>console.log('Valor de nuevoMascotaId:', '$nuevoMascota');</script>";
echo "<script>console.log('Valor de nuevoMascota:', '$nuevoMascotaId');</script>";

include ('header.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dogeway";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


$id = $user->getUserId();
$unique_id = $user->getUniqueId();

$query1 = "SELECT * FROM mascota WHERE id_usuario = $id AND categoria = 1";
$resultado1 = $conn->query($query1);

if ($resultado1) {
    $mascotasDisponibles = $resultado1->fetch_all(MYSQLI_ASSOC);
} else {
    echo "Error en la consulta: " . $conn->error;
}

$idUsuarioActual = $user->getUserId();
if ($nuevoMascotaId !== "") {
    $query = "SELECT mascota.id AS idMascota, 
                 usuario.unique_id AS idUsuario,
                 usuario.municipio AS municipio,
                 mascota.nombreMascota AS nombreMascota,
                 usuario.nombre AS nombre,
                 usuario.apellidos AS apellidos,
                 mascota.fotografiaMascota,
                 mascota.descripcion, 
                 mascota.especie,
                 usuario.fotografia
          FROM mascota
          JOIN usuario ON mascota.id_usuario = usuario.id
          WHERE mascota.id_usuario != $idUsuarioActual AND mascota.categoria = 1 AND mascota.especie = $nuevoMascota
          ORDER BY RAND();";
} else {
    $query = "SELECT mascota.id AS idMascota, 
                 usuario.unique_id AS idUsuario,
                 usuario.municipio AS municipio,
                 mascota.nombreMascota AS nombreMascota,
                 usuario.nombre AS nombre,
                 usuario.apellidos AS apellidos,
                 mascota.fotografiaMascota,
                 mascota.descripcion, 
                 mascota.especie,
                 usuario.fotografia
          FROM mascota
          JOIN usuario ON mascota.id_usuario = usuario.id
          WHERE mascota.id_usuario != $idUsuarioActual AND mascota.categoria = 1
          ORDER BY RAND();";
}

$result = $conn->query($query);
if ($result) {

?>
            <select id="mascotaSelect" name="mascotaSelect" onchange="actualizarContenido(event)">
                    <option value="" disabled selected>Selecciona una mascota</option>
                    <?php foreach ($mascotasDisponibles as $mascota) : ?>
                        <option value="<?php echo $mascota['id']; ?>" data-fotografia="<?php echo $mascota['fotografiaMascota'];  ?>" data-nombre="<?php echo $mascota['nombreMascota']; ?> " data-descripcion="<?php echo $mascota['descripcion']; ?> " data-especie="<?php echo $mascota['especie']; ?>">
                            <?php echo $mascota['nombreMascota']; ?>
                        </option>
                    <?php endforeach; ?>
            </select>

            <div class=seleccion id="imagenMascota"></div>
            
            <div class="profiles">
               
                <div id='nombreMascota'></div>
                <div id='ubicacion'></div>
                <div id='descripcion'></div>
             
            </div>

<ul id="efecto">           
    <?php $indiceResultadoActual = 1;
     while ($row = $result->fetch_assoc()) : ?>
        <div class="content visible" id="resultados_<?php echo $indiceResultadoActual; ?>">
            <div class="card">
                <div class="user">
                    <?php 
                        echo "<img class='user' src='../RegistroMascota/archivos/" . $row["fotografiaMascota"] . "' alt=''>";
                        $idMascota = $row["idMascota"];
                        $idUsuario = $row["idUsuario"];
                    ?>
                    <div class="profile">
                        <div class="name">
                            <p><?php echo $row["nombreMascota"]; ?></p>
                                
                        </div>
                        <div class="ubicacion">
                                <p>Ubicación: <?php echo $row["municipio"];?></p>
                        </div>

                        <div class="descripcion">
                            <p><?php echo $row["descripcion"];?></p>
                        </div>
                    
                    </div>
                    
                </div>
                <?php echo "<img id='fotografiass' src='../Registro/archivos/" . $row["fotografia"] . "' alt=''width='100' height='100'>"; ?>
            </div>
            <div class="buttons">
                <div class="heart">
                    <i class="fas fa-heart" onclick="enviarDatos(<?php echo $idMascota . ', ' . $idUsuario . ', ' . $unique_id; ?>, 1, document.getElementById('mascotaSelect').value)"></i>
                </div>
                <div class="no">
                    <i class="fas fa-times" onclick="enviarDatos(<?php echo $idMascota . ', ' . $idUsuario . ', ' . $unique_id; ?>, 3, document.getElementById('mascotaSelect').value,)"></i>
                </div>
                <div class="star">
                    <i class="fas fa-star fa" onclick="enviarDatos(<?php echo $idMascota . ', ' . $idUsuario . ', ' . $unique_id; ?>, 2, document.getElementById('mascotaSelect').value,)"></i>
                </div>
            </div>
        </div>

        <?php
        $indiceResultadoActual++;
        ?>
    <?php endwhile; ?>

    <div id="popupContainer">
        <p>No hay más coincidencias :(</p>
        <button id="closeButton" onclick="cerrarPopup()"><img src="../Imagenes/perrosad.png" alt=""></button>
    </div>

</ul>

    <?php

    $result->free();
} else {
    echo "Error en la consulta: " . $conn->error;
}

?>

<?php 

} else {header("Location: ../Inicio/index.php");
  exit();
} 
?>

<script src="jquery-3.3.1.min.js"></script>

<script>
    function enviarDatos(idMascota, idUsuario, idUsuarioP, Match, idMascotaP) {
        console.log('El match está pendiente para IdMascota:', idMascota, ', IdUsuario:', idUsuario, ', Match:', Match, ', IdTuyo:', idUsuarioP, ', IdMascotaTuyo:', idMascotaP);
        if (idMascotaP !== "") {
        $.ajax({
            type: 'POST', 
            url: 'match.php',
            data: {
                idMascota: idMascota,
                idUsuario: idUsuario,
                Match: Match,
                idUsuarioP: idUsuarioP,
                idMascotaP: idMascotaP
            },
            success: function(response) {
                console.log('Respuesta del servidor:', response);

                if (response == 'insert') {
                    alert('Match pendiente');
                    mostrarSiguiente();
                } else if (response == 'match'){
                    alert('ES UN MATCH');
                    mostrarSiguiente();
                } else if (response == 'amistad'){
                    alert('ES UN AMISTAD');
                    mostrarSiguiente();
                }else if (response == 'rechazado'){
                    alert('RECHAZADO');
                    mostrarSiguiente();
                }else {
                    alert('Ya enviaste solicitud');
                    mostrarSiguiente();
                }
            },
            error: function(error) {
                console.error('Error en la solicitud AJAX ', error);
            }
        });
        }else {
            console.error('Error en la solicitud AJAX ');
        }
    }
</script>

<script>
    var indiceResultadoActual = 0;

    document.addEventListener('DOMContentLoaded', function() {
        mostrarSiguiente();
    });

    function mostrarSiguiente() {
        var resultados = document.querySelectorAll('.content');
        var resultadoActual = resultados[indiceResultadoActual];

        if (resultadoActual) {
            resultados.forEach(function(resultado) {
                resultado.classList.remove('visible');
            });
            resultadoActual.classList.add('visible');
            indiceResultadoActual++;
        } else {
            mostrarPopup();
        }
    }

    function mostrarPopup() {
        var popupContainer = document.getElementById('popupContainer');
        popupContainer.style.display = 'block';
    }

    function cerrarPopup() {
        var popupContainer = document.getElementById('popupContainer');
        popupContainer.style.display = 'none';
    }


    $(document).ready(function() {
        var nombreArchivo = "<?php echo $nombreArchivo; ?>";
        var nombreMascota = "<?php echo $nombreMascota; ?>";
        var descripcion = "<?php echo $descripcion; ?>";
        
        var rutaRelativa = "../RegistroMascota/archivos/";
        var imagenUrl = rutaRelativa + nombreArchivo;
        var ubicacion = "<?php echo $user->getMunicipio(); ?>";
        var foto = "<?php echo "../Registro/archivos/" . $user->getFotografia(); ?>";

        $("#nombreMascota").html(nombreMascota);
        $("#ubicacion").html('Ubicación: ' + ubicacion);
        $("#descripcion").html(descripcion);
        $("#foto").html("<img src='" + foto + "' alt='' width='100' height='100'>").find('img').css('border-radius', '50%');
        $("#imagenMascota").html('<img src="' + imagenUrl + '" alt="Imagen de mascota">');
        $("#nombreMascota, #ubicacion, #imagenMascota, #descripcion, #foto").addClass("animated fadeIn");
    
    });

    $(document).ready(function() {
        $("#efecto").addClass("visible");
    });

    function actualizarContenido(event) {
    var selectedMascotaId = $("#mascotaSelect").val();
    var selectedMascota = $(event.target).find(":selected").data("especie");
    var nombreArchivo = $(event.target).find(":selected").data("fotografia");
    var nombreMascota = $(event.target).find(":selected").data("nombre");
    var descripcion = $(event.target).find(":selected").data("descripcion");

    localStorage.setItem("selectedMascotaId", selectedMascotaId);
    localStorage.setItem("selectedMascota", selectedMascota);
    localStorage.setItem("nombreArchivo", nombreArchivo);
    localStorage.setItem("nombreMascota", nombreMascota);
    localStorage.setItem("descripcion", descripcion);
    location.href = 'lista.php?selectedMascotaId=' + selectedMascotaId + '&selectedMascota=' + selectedMascota+ '&nombreMascota=' + nombreMascota+ '&descripcion=' + descripcion+ '&nombreArchivo=' + nombreArchivo;
    }

    function restaurarSeleccion() {
    var urlParams = new URLSearchParams(window.location.search);

    if (urlParams.has('selectedMascotaId')) {
    var selectedMascotaId = localStorage.getItem("selectedMascotaId");
    var selectedMascota = localStorage.getItem("selectedMascota");
    var nombreArchivo = localStorage.getItem("nombreArchivo");
    var nombreMascota = localStorage.getItem("nombreMascota");
    var descripcion = localStorage.getItem("descripcion");

    window.mascotaData = {
        selectedMascotaId: selectedMascotaId,
        selectedMascota: selectedMascota,
        nombreArchivo: nombreArchivo,
        nombreMascota: nombreMascota,
        descripcion: descripcion
    };

    $("#mascotaSelect").val(selectedMascotaId);
    }
    }

    $(document).ready(restaurarSeleccion);

</script>

