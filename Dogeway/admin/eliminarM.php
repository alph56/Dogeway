<?php

include "config.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "UPDATE mascota
    SET categoria = 0, estatus = 0
    WHERE id = $id";

    if ($conexion->query($sql) == TRUE) {
        echo 'success';
    } else {
        echo "Error en la actualización: " . $conexion->error;
    }
} else {
    echo "No se proporcionó un ID válido.";
}

?>