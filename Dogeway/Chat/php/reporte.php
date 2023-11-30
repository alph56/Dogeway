<?php
$idUsuario = $_POST['idUsuario'];
$idBloqueo = $_POST['idBloqueo'];
$Motivo = $_POST['motivoReporte'];

$conn = new mysqli("localhost", "root", "", "dogeway");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "INSERT INTO reporte (idreporte , idreportado, motivo, fecha)  VALUES ('$idUsuario', '$idBloqueo', '$Motivo', NOW())";

if ($conn->query($sql) === TRUE) {
    echo "reportado";
} else {
    echo "Error al bloquear: " . $conn->error;
}

$conn->close();
?>