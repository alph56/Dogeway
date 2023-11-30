<?php 
    include_once '../Inicio/includes/user.php';
    include_once '../Inicio/includes/user_session.php';
    
    $userSession = new UserSession();
    $user = new User();

    if(isset($_SESSION['user'])){
    $user->setUser($userSession->getCurrentUser());
    $si = $user->getAdmin();
    if ($si == 0) {
        header("Location: ../Inicio/index.php");  
    }
?>

<?php include "header.php"?>

<?php
include "config.php";

$sql = "SELECT mascota.*, usuario.nombre AS nombre, usuario.apellidos as apellidos, usuario.nickname as nickname FROM mascota
        INNER JOIN usuario ON mascota.id_usuario = usuario.id";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    echo "<div class= 'tabla'>
    <h1>LISTA DE MASCOTAS</h1>";
    echo "<table border='1'><tr><th>ID</th><th>Dueño</th><th>Nombre Mascota</th><th>Eliminar</th><th>Restaurar</th></tr>";

    while($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $nickname = $row['nickname'];
        $nombreMascota = $row['nombreMascota'];
        $status = $row['estatus'];
        echo "
        <tr id='row$id'>
                <td class='M$status'>".$id."</td>
                <td class='M$status'>".$nickname."</td>
                <td class='M$status'>".$nombreMascota."</td>
                <td class='M$status'><button type='button' class='accion' onclick='ejecutar($id)'>Activar</button></td>
                <td class='M$status'><button type='button' class='accion' onclick='ejecutarE($id)'>Eliminar</button></td>
            </tr>";
    }

    echo "</table>";
    echo "</div>";
} else {
    echo "No se encontraron resultados";
}

$conexion->close();
?> 

<?php 

} else {header("Location: ../Inicio/index.php");
  exit();
} 
?>

<script src="../Chat/javascript/jquery-3.3.1.min.js"></script>

<script>
function ejecutar(id) {
        console.log(id);
        if (confirm("¿Estás seguro de activar este usuario?")) {
            $.ajax({
                url         : 'activarM.php',
                type        : 'post',
                dataType    : 'text',
                data: {
                id: id,
                },
                success     : function(res) {
                    console.log(res);
                    if (res == "success"){
                      window.location.href = 'listaMascota.php';
                    } else{  
                        alert('error'); 
                    }
                    
                },error: function() {
                    alert ('Error');
                }
            });
          }
      } 

      function ejecutarE(id) {
        console.log(id);
        if (confirm("¿Estás seguro de activar este usuario?")) {
            $.ajax({
                url         : 'eliminarM.php',
                type        : 'post',
                dataType    : 'text',
                data: {
                id: id,
                },
                success     : function(res) {
                    console.log(res);
                    if (res == "success"){
                      window.location.href = 'listaMascota.php';
                    } else{  
                        alert('error'); 
                    }
                    
                },error: function() {
                    alert ('Error');
                }
            });
          }
      } 
</script>