<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    require 'db.php';
    $conexion = conectar();

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }
    	
    $newId = $_POST['id'];
    $newNombreMasc = $_POST['nombreMascota'];
    $newDesc = $_POST['descripcion'];
    $newEspecie = $_POST['especie'];
    $newRaza = $_POST['raza'];
    $newEdad = $_POST['edad'];
    $newEspecificacion = $_POST['especificaciones'];
    $newCaract = $_POST['caracteristicas'];
    $newCategoria = $_POST['categoria'];

    $actualizar="UPDATE mascota SET nombreMascota='$newNombreMasc', descripcion='$newDesc', 
    especie='$newEspecie', raza='$newRaza', edad='$newEdad', especificaciones='$newEspecificacion',
    caracteristicas='$newCaract', categoria='$newCategoria'
    WHERE id= '$newId'";

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