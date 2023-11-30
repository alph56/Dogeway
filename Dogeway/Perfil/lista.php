<?php 
    include_once '../Inicio/includes/user.php';
    include_once '../Inicio/includes/user_session.php';
    
    $userSession = new UserSession();
    $user = new User();

    if(isset($_SESSION['user'])){
    $user->setUser($userSession->getCurrentUser());
    $nombre = $user->getNombre();
    $apellidos = $user->getApellidos();
    $nickname = $user->getusername();
    $municipio = $user->getMunicipio();
    $telefono = $user->getusertel();
    $email = $user->getuseremail();
    $curp = $user->getCurp();
    $ine = $user->getIne();
    $fotografia = $user->getFotografia();
    $idUsuario = $user->getUserId();
    $Unique = $user->getUniqueId();

?>

<?php 
include 'config.php';

include 'header.php';

$sql = "SELECT * FROM mascota WHERE id_usuario = $idUsuario AND estatus!= 0";
       
$result = $conn->query($sql);

$rondas = $result->num_rows;

$sqlRating = mysqli_query($conn, "SELECT ROUND(AVG(rating), 1) as promedio FROM rating WHERE idUser = {$Unique}");
          
    if ($sqlRating) {
        $fila = mysqli_fetch_assoc($sqlRating);
        $rating = $fila['promedio'];
    } else {
        echo "Error" . mysqli_error($conn);
    }

?>

<div class=space>
    <div id="perfil">
        <div class="columna1">
            <img src="../Registro/archivos/<?php echo $fotografia; ?>" alt="Foto de perfil">
            <p class="numero-rondas"><?php echo $rondas; ?></p>
            <p class="texto-mascotas">Mascotas</p>
            <div class="estrelas"> 
            <?php
            $rating_rounded = ($rating - floor($rating) > 0.5) ? ceil($rating) : floor($rating);

            echo '<div class="rating-star" onmouseover="showRatingTooltip(' . $rating . ')" onmouseout="hideRatingTooltip()">';
                switch ($rating_rounded) {
                    case 0:
                        echo '<i class="fas fa-star small-star"></i>';
                        echo '<i class="fas fa-star small-star"></i>';
                        echo '<i class="fas fa-star small-star"></i>';
                        echo '<i class="fas fa-star small-star"></i>';
                        echo '<i class="fas fa-star small-star"></i>';
                        break;
                    case 1:
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star small-star"></i>';
                        echo '<i class="fas fa-star small-star"></i>';
                        echo '<i class="fas fa-star small-star"></i>';
                        echo '<i class="fas fa-star small-star"></i>';
                        break;
                    case 2:
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star small-star"></i>';
                        echo '<i class="fas fa-star small-star"></i>';
                        echo '<i class="fas fa-star small-star"></i>';
                        break;
                    case 3:
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star small-star"></i>';
                        echo '<i class="fas fa-star small-star"></i>';
                        break;
                    case 4:
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star small-star"></i>';
                        break;
                    case 5:
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        echo '<i class="fas fa-star"></i>';
                        break;

                    default:
    
                }

            echo '<div class="rating-tooltip" id="rating-tooltip">Puntaje: ' . $rating . '</div>';
            echo '</div>';
            ?>
            </div>
            <p class="rating">Rating</p>
        </div>
        <div class="columna2">
            <p class="nombre-apellido"><?php echo $nombre . " " . $apellidos; ?></p>
            <p class="nickname">@<?php echo $nickname; ?></p>
            <p class="ubicacion">Jalisco / <?php echo $municipio; ?></p>
            <p class="datos-privados">Estos datos solo tú los ves:</p>
            <p class="dato">Teléfono: <?php echo $telefono; ?></p>
            <p class="dato">Email: <?php echo $email; ?></p>
            <p class="dato">CURP: <?php echo $curp; ?></p>
            <p class="datos">INE: <?php echo $ine; ?></p>
            <button class="boton-editar" onclick="redirigirU()">Editar</button>
        </div>
    </div>

    <div id="mascota">
       <?php
       if ($result->num_rows > 0) {
           while ($row = $result->fetch_assoc()) {
            $category = $row["categoria"];
            $especies = $row["especie"];
            echo "<div id='resultado". $row["id"] ."' class='resultado'>";
            echo '<img class="imagen-mascota" src="../RegistroMascota/archivos/' . $row["fotografiaMascota"] . '" alt="fotografia">';
            echo "<div class='info-mascota'>";
            echo "<p class='nombre'>Nombre: " . $row["nombreMascota"] . "</p>";
            switch ($especies) {
                case 1:
                    echo "<p class='especies'>Especie: Perro</p>";
                    break;
                case 2:
                    echo "<p class='especies'>Especie: Gato</p>";
                    break;
                case 3:
                    echo "<p class='especies'>Especie: Ave</p>";
                    break;
                case 4:
                    echo "<p class='especies'>Especie: Reptil</p>";
                    break;
                case 5:
                    echo "<p class='especies'>Especie: Acuatico</p>";
                    break;
                case 6:
                    echo "<p class='especies'>Especie: Roedor</p>";
                    break;
                default:
                    echo "<p class='especies'>Especie: No reconocida</p>";
            }
            if ($category == 1) {
                echo "<p class='estado'>Estado: Match</p>";
            } elseif ($category == 2) {
                echo "<p class='estado'>Estado: Adopción</p>";
            }
            echo "</div>";
            echo "<div class='botones-mascota'>";
            echo '<button class="boton-detalles" onclick="mostrarDetalles('. $row["id"] .')"><i class="fas fa-info-circle"></i></button>';
            echo '<button class="boton-icono boton-editar" onclick="redirigir( '. $row["id"] .' )"><i class="fas fa-edit"></i></button>';
            echo '<button class="boton-icono boton-eliminar" onclick="confirmarEliminar(' . $row["id"] . ')"><i class="fas fa-trash-alt"></i></button>';
            echo "</div>";
            echo "</div>";
            
            echo "<div class='overlay' id='overlay". $row["id"] ."'>";
            echo '<div class="overlayBackground"></div>';
            echo '<div class="detallesMascota">';
            echo '<h2>Detalles de la Mascota</h2>';
            echo '<p class="data">Nombre: ' . $row["nombreMascota"] . '</p>';
            echo '<p class="data">Edad: ' . $row["edad"] . ' año(s)</p>';
            echo '<p class="data">Raza: ' . $row["raza"] . '</p>';
            echo '<p class="data">Descripción: ' . $row["descripcion"] . '</p>';
            echo '<p class="data">Especificaciones: ' . $row["especificaciones"] . '</p>';
            echo '<p class="data">Caracteristicas: ' . $row["caracteristicas"] . '</p>';
            switch ($especies) {
                case 1:
                    echo "<p class='data'>Especie: Perro</p>";
                    break;
                case 2:
                    echo "<p class='data'>Especie: Gato</p>";
                    break;
                case 3:
                    echo "<p class='data'>Especie: Ave</p>";
                    break;
                case 4:
                    echo "<p class='data'>Especie: Reptil</p>";
                    break;
                case 5:
                    echo "<p class='data'>Especie: Acuatico</p>";
                    break;
                case 6:
                    echo "<p class='data'>Especie: Roedor</p>";
                    break;
                default:
                    echo "<p class='data'>Especie: No reconocida</p>";
            }
            if ($category == 1) {
                echo "<p class='data'>Estado: Match</p>";
            } elseif ($category == 2) {
                echo "<p class='data'>Estado: Adopción</p>";
            }
            echo '<p class="data">Cartilla:</p>';
            echo '<img class="cartilla" src="../RegistroMascota/archivos/' . $row["cartilla"] . '" alt=""><br>';
            echo '<button class="btnCerrarDetalles" onclick="cerrarDetalles('. $row["id"] .')">Cerrar</button>';
            echo '</div>';
            echo '</div>';
        ?>

       <?php
        }
       } else {
           echo "No tiene mascotas agregadas";
       }
       ?>

       <a href="../RegistroMascota/registro.php" class="agregar"><i class="fas fa-plus"></i></a>

    </div>

</div>

<?php 

} else {header("Location: ../Inicio/index.php");
  exit();
} 
?>

<script>

function mostrarDetalles(id) {
        var overlay = document.getElementById('overlay' + id);
        overlay.style.display = 'block';
    }

    function cerrarDetalles(id) {
        var overlay = document.getElementById('overlay' + id);
        overlay.style.display = 'none';
    }

</script>

<script src="../Chat/javascript/jquery-3.3.1.min.js"></script>
<script>
function confirmarEliminar(id) {
    var confirmacion = confirm("¿Estás seguro de que quieres eliminar esta mascota?");
    if (confirmacion) {
        $.ajax({
            type: 'GET',
            url: 'eliminar.php',
            data: { id: id },
            success: function(response) {
                if (response == 'success') {
                    $('#resultado' + id).hide();
                    alert('La mascota se eliminó exitosamente.');
        } else {
            console.error('Respuesta inesperada del servidor:', response);
        }
            },
            error: function(error) {
                console.error('Error al eliminar la mascota', error);
            }
        });
    }
}

function redirigir(id) {
        window.location.href = 'editar.php?id=' + id;
    }

    function redirigirU() {
    window.location.href = "editarRegistro.php";
}



function showRatingTooltip(rating) {
    document.getElementById('rating-tooltip').innerText = 'Puntaje: ' + rating;
}

function hideRatingTooltip() {
    document.getElementById('rating-tooltip').innerText = '';
}
    
</script>