<?php
    function conectar() {
    $servidor = "localhost";
    $usuario = "root";
    $pass = "";
    $bd = "dogeway";

    $conexion = new mysqli($servidor, $usuario, $pass, $bd);

    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    return $conexion;
}
?>