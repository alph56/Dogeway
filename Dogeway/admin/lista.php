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

$sql = "SELECT usuario.*, COUNT(reporte.idreportado) AS veces_reportado
FROM usuario
LEFT JOIN reporte ON usuario.unique_id = reporte.idreportado
GROUP BY usuario.unique_id
ORDER BY veces_reportado DESC";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    echo "<div class= 'tabla'>
    <h1>LISTA DE USUARIOS</h1>";
    echo "<table border='1'><tr><th>Reportes</th><th>ID</th><th>Nombre</th><th>Nickname</th><th>Restaurar</th><th>Revisar</th></tr>";

    while($row = $result->fetch_assoc()) {
        $report = $row['veces_reportado'];
        $id = $row['id'];
        $nombre = $row['nombre'];
        $apellidos = $row['apellidos'];
        $nickname = $row['nickname'];
        $status = $row['status'];

        echo "
            <tr id='row$id'>
                <td class='$status'>".$report."</td>
                <td class='$status'>".$id."</td>
                <td class='$status'>".$nombre. " " .$apellidos."</td>
                <td class='$status'>".$nickname."</td>
                <td class='$status'><button type='button' class='accion' onclick='ejecutar($id)'>Activar</button></td>
                <td class='$status'><a href='reportes.php?id=$id' button class='accion'>Revisar</a></td>
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
                url         : 'activar.php',
                type        : 'post',
                dataType    : 'text',
                data: {
                id: id,
                },
                success     : function(res) {
                    console.log(res);
                    if (res == "success"){
                      window.location.href = 'lista.php';
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