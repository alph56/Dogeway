<?php
include_once 'conexion.php';
include_once '../Chat/php/config.php';

$id1 = $_GET['id1'];//El id del usuario que da en adopcion
$id2 = $_GET['id2'];//El id del usuario que quiere adoptar
$id3 = $_GET['id3'];//EL id de la mascota en adopcion

$sql1 = "SELECT * FROM usuario WHERE id ='$id1'";
$sql2 = "SELECT * FROM usuario WHERE id ='$id2'";

$resultado1 = $conn->query($sql1);
$resultado2 = $conn->query($sql2);

$fila1 = $resultado1->fetch_assoc();
$fila2 = $resultado2->fetch_assoc();

$UniqueID1 = $fila1['unique_id'];  
$UniqueID2 = $fila2['unique_id'];

$sql3 = "INSERT INTO `match` (id1, id2, status, idMascota1, idMascota2, fecha) VALUES ('$UniqueID1', '$UniqueID2', '6', '$id3', '77', NOW())";

$resultado = $conn->query($sql3);

if ($resultado === TRUE) {
    echo "La inserción fue exitosa.";
} else {
    echo "Error: " . $conn->error;
}

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