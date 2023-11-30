<?php

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $idMascota = $_GET['id'];

    $sql = "UPDATE mascota SET estatus = 0, categoria = 0 WHERE id = $idMascota";

    $sqlEliminarMatch = "DELETE FROM `match` WHERE idMascota1 = '$idMascota' OR idMascota1 = '$idMascota'";

    $sqlEliminarAdopciones = "DELETE FROM adopcion WHERE id3 = $idMascota";

    

    if ($conn->query($sql) === TRUE) {
        $conn->query($sqlEliminarMatch);
        $conn->query($sqlEliminarAdopciones);
        echo 'success';
    } else {
        echo 'Error al eliminar la mascota: ' . $conn->error;
    }
} else {
    echo 'ID de mascota no válido';
}
?>
