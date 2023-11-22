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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $filtroMascAdop = $_POST['filt'];
    }

    $filtroMascAdop = 1;

    switch($filtroMascAdop){
      case 0://Todos los animales en adopcion
        $allMascotaAdop = mysqli_query($conexion, "SELECT * FROM mascota WHERE categoria = 2");
      break;
      case 1://Perros
        $allMascotaAdop = mysqli_query($conexion, "SELECT * FROM mascota WHERE categoria = 2 AND especie = 1");
      break;
      case 2://Gatos
        $allMascotaAdop = mysqli_query($conexion, "SELECT * FROM mascota WHERE categoria = 2 AND especie = 2");
      break;
      case 3://Avez
        $allMascotaAdop = mysqli_query($conexion, "SELECT * FROM mascota WHERE categoria = 3 AND especie = 3");
      break;
      case 4://Reptiles
        $allMascotaAdop = mysqli_query($conexion, "SELECT * FROM mascota WHERE categoria = 2 AND especie = 4");
      break;
      case 5://Acuaticos
        $allMascotaAdop = mysqli_query($conexion, "SELECT * FROM mascota WHERE categoria = 2 AND especie = 5");
      break;
      case 6://Roedores
        $allMascotaAdop = mysqli_query($conexion, "SELECT * FROM mascota WHERE categoria = 2 AND especie = 6");
      break;
    }
    
    $filtroMascMatch = 1;

    switch($filtroMascMatch){
      case 0://Todos los animales en adopcion
        $allMascotaMat = mysqli_query($conexion, "SELECT * FROM mascota WHERE categoria = 1");
      break;
      case 1://Perros
        $allMascotaMat = mysqli_query($conexion, "SELECT * FROM mascota WHERE categoria = 1 AND especie = 1");
      break;
      case 2://Gatos
        $allMascotaMat = mysqli_query($conexion, "SELECT * FROM mascota WHERE categoria = 1 AND especie = 2");
      break;
      case 3://Avez
        $allMascotaMat = mysqli_query($conexion, "SELECT * FROM mascota WHERE categoria = 1 AND especie = 3");
      break;
      case 4://Reptiles
        $allMascotaMat = mysqli_query($conexion, "SELECT * FROM mascota WHERE categoria = 1 AND especie = 4");
      break;
      case 5://Acuaticos
        $allMascotaMat = mysqli_query($conexion, "SELECT * FROM mascota WHERE categoria = 1 AND especie = 5");
      break;
      case 6://Roedores
        $allMascotaMat = mysqli_query($conexion, "SELECT * FROM mascota WHERE categoria = 1 AND especie = 6");
      break;
    }

    //FUNCIONES _______________________________
    





    
//_____________________________TODAS LAS FUNCIONES DEL MATCH AQUI EMPIEZAN_____________________
// Función para verificar si hay un match entre dos usuarios
function checkMatch($conn, $id1, $id2) {
  // Buscar match en ambas direcciones
  $sql = "SELECT * FROM `match` WHERE (id1 = $id1 AND id2 = $id2) OR (id1 = $id2 AND id2 = $id1)";
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