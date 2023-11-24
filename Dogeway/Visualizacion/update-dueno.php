<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    require 'db.php';
    $conexion = conectar();

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $newId = $_POST['id'];
    $newNombre = $_POST['nombre'];
    $newApellidos = $_POST['apellidos'];
    $newNickname = $_POST['nickname'];
    $newTelefono = $_POST['telefono'];
    $newMunicipio = $_POST['municipio'];

    $actualizar="UPDATE usuario SET nombre='$newNombre', apellidos='$newApellidos', 
    nickname='$newNickname', municipio='$newMunicipio' WHERE id= '$newId' ";

    // Ejecutar la consulta
    if ($conexion->query($actualizar) === TRUE) {
        header("Location: update-successfully.php");
    } else {
        echo "Error al actualizar: " . $conexion->error;
    }
    
    // Cerrar la conexión
    $conexion->close();

}
?>