<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    require 'db.php';
    $conexion = conectar();

    if(!$conexion){
        die("Error al conectar " . mysqli_connect_error());
    }

    $newId = $_POST['id'];

    function vermasc($newId, $conexion){
        $allpets = mysqli_query($conexion, "SELECT * FROM mascota WHERE id_dueno = '$newId'");
    }
    
    // Cerrar la conexión
    $conexion->close();

}
?>