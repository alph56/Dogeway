<?php
$idUsuario = $_POST['idUsuario'];
$Rating = $_POST['rating'];

$conn = new mysqli("localhost", "root", "", "dogeway");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "INSERT INTO rating (idUser , rating)  VALUES ('$idUsuario', '$Rating')";

if ($conn->query($sql) === TRUE) {
    echo "rating";
} else {
    echo "Error al bloquear: " . $conn->error;
}

$conn->close();
?>