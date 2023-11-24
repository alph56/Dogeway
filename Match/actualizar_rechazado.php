<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "dogeway";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recibir parámetros desde la URL
$id1 = $_GET['id1'];
$id3= $_GET['id3'];

// Actualizar el estado del match a 2
$updateQuery = "UPDATE `match` SET status = 0 WHERE (id1 = ? AND id3 = ?) OR (id1 = ? AND id3 = ?)";
$stmt = $conn->prepare($updateQuery);
$stmt->bind_param("iiii", $id3, $id3, $id3, $id1);

if ($stmt->execute()) {
    echo "Estado actualizado a 0 correctamente.";
} else {
    echo "Error al ejecutar la actualización: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>