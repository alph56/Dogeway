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
$id2 = $_GET['id2'];

// Actualizar el estado del match a 2
$updateQuery = "UPDATE `match` SET status = 2 WHERE (id1 = ? AND id2 = ?) OR (id1 = ? AND id2 = ?)";
$stmt = $conn->prepare($updateQuery);
$stmt->bind_param("iiii", $id1, $id2, $id2, $id1);

if ($stmt->execute()) {
    echo "Estado actualizado a 2 correctamente.";
} else {
    echo "Error al ejecutar la actualización: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>