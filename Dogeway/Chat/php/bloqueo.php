<?php
$idUsuario = $_POST['idUsuario'];
$idBloqueo = $_POST['idBloqueo'];
$idM = $_POST['idM'];

$conn = new mysqli("localhost", "root", "", "dogeway");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "UPDATE `match`
        SET status = 0 
        WHERE (id1 = '$idUsuario' AND id2 = '$idBloqueo') 
           OR (id1 = '$idBloqueo' AND id2 = '$idUsuario')";

$sql1 = "DELETE FROM `adopcion` WHERE id3 = '$idM'";

if ($conn->query($sql1) === TRUE) {

    if ($conn->query($sql) === TRUE) {
        echo "bloqueado";
    } else {
        echo "Error al bloquear: " . $conn->error;
    }
}else {
    echo "Error al bloquear: " . $conn->error;
}


$conn->close();
?>