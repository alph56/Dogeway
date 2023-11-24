<?php
include_once 'conexion.php';


$id1 = $_GET['id1'];//El id del usuario que da en adopcion
$id2 = $_GET['id2'];//El id del usuario que quiere adoptar
$id3 = $_GET['id3'];//EL id de la mascota en adopcion

$p = existAdop($id3, $id2,$adop);

if($p == 1)
{
    $stmt = $conexion->prepare("INSERT INTO `adopcion`(id1, id2, id3) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $id1, $id2, $id3);

    if ($stmt->execute()) {
        echo "Match insertado correctamente.";
    } else {
        echo "Error al insertar el match: " . $stmt->error;
    }
}
    $stmt->close();
    $conexion->close();

?>