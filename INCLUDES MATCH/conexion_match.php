<?php
$host = 'localhost';
$bd = 'dogeway';
$user = 'root';
$password = "";

$conexion = new mysqli($host, $user, $password, $bd);

if(!$conexion){
    die("Error al conectar " . mysqli_connect_error());
}

//CONSULTAS  _________________________

$allUsers = mysqli_query($conexion, "SELECT * FROM usuario ");

//$chat = mysqli_query($conexion, "SELECT * FROM chat");

//$match = mysqli_query($conexion, "SELECT * FROM match");

$filtroMascota = 0;

switch($filtroMascota){
    case 0:
        $allMascota = mysqli_query($conexion, "SELECT * FROM mascota");
    break;
    case 1:
        //$allMascota = mysqli_query($conexion, "SELECT * FROM mascota WHERE especie = 'perro' ");
    break;
}

//FUNCIONES _______________________________

// Función para verificar si hay un match entre dos usuarios
function checkMatch($conn, $id1, $id2, $id3, $id4) {
    // Buscar match en ambas direcciones
    $sql = "SELECT * FROM `match` WHERE 
         (id1 = $id3 AND id3 = $id1)"; // PARA QUE SOLO LE APAREZCA LA OPCION AL QUE RECIBIO EL MATCH
    
    $result = $conn->query($sql);

  // Verificar si hay un match
  if ($result->num_rows > 0) {
      return $result->fetch_assoc();  // Devolver los datos del match
  } else {
      return false;  // No hay match
  }
}

//_____________________________FIN FUNCIONES DEL MATCH _____________________
?>
