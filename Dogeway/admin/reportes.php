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

<?php include "config.php"?>
<?php include "header.php"?>

<?php 

$id = $_GET['id'];

$sql = "SELECT *
FROM usuario WHERE id = $id";

$result = $conexion->query($sql);

if ($result->num_rows > 0) {
  echo "<div class= 'tablas'>
  <h1>USUARIO</h1>";
  echo "<table border='1'><tr><th>Fotografia</th><th>Telefono</th><th>Nombre</th><th>Nickname</th><th>Correo</th><th>Eliminar</th></tr>";

  while($row = $result->fetch_assoc()) {
      $idU = $row['id'];
      $nombre = $row['nombre'];
      $apellidos = $row['apellidos'];
      $nickname = $row['nickname'];
      $correo = $row['email'];
      $status = $row['status'];
      $telefono = $row['telefono'];
      $fotografia = $row['fotografia'];
      $idunique = $row['unique_id'];

      echo "
    <tr id='row$id'>
    <td class='$status'><img src='../Registro/Archivos/$fotografia' style='max-width: 100px; height: auto;' alt='Imagen'></td>
    <td class='$status'>".$telefono."</td>
    <td class='$status'>".$nombre. " " .$apellidos."</td>
    <td class='$status'>".$nickname."</td>
    <td class='$status'>".$correo."</td>
    <td> <button type='button' class='accion' onclick='ejecutarActualizacion($idunique)'>Eliminar</button> </td>
    </tr>";
  }

  echo "</table>";
  echo "</div>";
} else {
  echo "No se encontraron resultados";
}

$sql = "SELECT *
FROM reporte WHERE idreportado = $idunique";

$result = $conexion->query($sql);

if ($result->num_rows > 0) {
  echo "<div class= 'tabl1s'>
  <h1></h1>";
  echo "<table border='1'><tr><th>ID Reporte</th><th>Reporto</th><th>motivo</th><th>fecha</th></tr>";

  while($row = $result->fetch_assoc()) {
      $idR = $row['idR'];
      $idreporte = $row['idreporte'];
      $motivo = $row['motivo'];
      $fecha = $row['fecha'];

      $sqlR = "SELECT *
      FROM usuario WHERE unique_id = $idreporte";

      $resultado = $conexion->query($sqlR);
      while($res = $resultado->fetch_assoc()){
      $nombreR = $res['nickname'];
      }
      echo "
          <tr>
              <td >".$idR."</td>
              <td>".$nombreR."</td>
              <td>".$motivo."</td>
              <td>".$fecha."</td>
          </tr>";
  }

  echo "</table>";
  echo "</div>";
} else {
  echo "No se encontraron resultados";
}


?>

<?php 

} else {header("Location: ../Inicio/index.php");
  exit();
} 
?>

<script src="../Chat/javascript/jquery-3.3.1.min.js"></script>

<script>

      function ejecutarActualizacion(id) {
        console.log(id);
        if (confirm("¿Estás seguro de que deseas suspender este usuario?")) {
            $.ajax({
                url         : 'eliminar.php',
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