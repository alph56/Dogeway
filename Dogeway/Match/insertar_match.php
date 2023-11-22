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
$status = $_GET['status'];

// Insertar match en la base de datos
$stmt = $conn->prepare("INSERT INTO `match` (id1, id2, status) VALUES (?, ?, ?)");
$stmt->bind_param("iii", $id1, $id2, $status);
$stmt->execute();
$stmt->close();

// Enviar notificación al usuario destinatario


?>
