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
$id3 = $_GET['id3'];
$id4 = $_GET['id4'];
$status = $_GET['status'];

// Insertar match en la base de datos
$stmt = $conn->prepare("INSERT INTO `match` (id1, id2, id3, id4, status) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("iiiii", $id1, $id2, $id3, $id4, $status);

if ($stmt->execute()) {
    echo "Match insertado correctamente.";
} else {
    echo "Error al insertar el match: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>