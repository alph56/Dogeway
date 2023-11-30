<?php

//Valores de con quien quieres hacer match
$IdMascota = $_POST['idMascota'];
$IdUsuario = $_POST['idUsuario'];
//Value del match
$Match = $_POST['Match'];
//Estos son tus datos
$IdUsuarioP = $_POST['idUsuarioP'];  
$IdMascotaP = $_POST['idMascotaP'];

$conexion = new mysqli("localhost", "root", "", "dogeway");

if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}

$sqlVer = "SELECT * FROM `match` 
WHERE id1 = '$IdUsuarioP' AND idMascota1 = '$IdMascotaP' AND id2 = '$IdUsuario' AND idMascota2 = '$IdMascota'";

$SQLData = "WHERE id1 = '$IdUsuario' AND idMascota1 = '$IdMascota' AND id2 = '$IdUsuarioP' AND idMascota2 = '$IdMascotaP'";

$sqlVerInv1 = "SELECT * FROM `match` $SQLData AND status = 1";
$sqlVerInv2 = "SELECT * FROM `match` $SQLData AND status = 2";
$sqlVerInv3 = "SELECT * FROM `match` $SQLData AND status = 3";
$sqlVerInvD = "SELECT * FROM `match` $SQLData";

$resultado = $conexion->query($sqlVer);
$resultadoInv1 = $conexion->query($sqlVerInv1);
$resultadoInv2 = $conexion->query($sqlVerInv2);
$resultadoInv3 = $conexion->query($sqlVerInv3);
$resultadoInvD = $conexion->query($sqlVerInvD);


if ($resultado->num_rows > 0) {
    echo "realizado";
} elseif ($resultadoInv1->num_rows > 0) {

    $UpdateSQL = "UPDATE `match` SET ";
    $condicion = "WHERE id1 = '$IdUsuario' AND idMascota1 = '$IdMascota' AND id2 = '$IdUsuarioP' AND idMascota2 = '$IdMascotaP'";

    if ($Match == 1) {
        $sqlUpdate = "$UpdateSQL status = '4', fecha = NOW() $condicion";
        $mensaje = "match";
    } elseif ($Match == 2) {
        $sqlUpdate = "$UpdateSQL status = '5', fecha = NOW() $condicion";
        $mensaje = "amistad";
    }elseif ($Match == 3) {
        $sqlUpdate = "$UpdateSQL status = '0', fecha = NOW() $condicion";
        $mensaje = "rechazado";
    }

    if (isset($sqlUpdate)) {
        if ($conexion->query($sqlUpdate) === TRUE) {
            echo $mensaje;
        }
    }

} elseif ($resultadoInv2->num_rows > 0) {

    $UpdateSQL = "UPDATE `match` SET ";
    $condicion = "WHERE id1 = '$IdUsuario' AND idMascota1 = '$IdMascota' AND id2 = '$IdUsuarioP' AND idMascota2 = '$IdMascotaP'";

    if ($Match == 1) {
        $sqlUpdate = "$UpdateSQL status = '5', fecha = NOW() $condicion";
        $mensaje = "amistad";
    } elseif ($Match == 2) {
        $sqlUpdate = "$UpdateSQL status = '5', fecha = NOW() $condicion";
        $mensaje = "amistad";
    }elseif ($Match == 3) {
        $sqlUpdate = "$UpdateSQL status = '0', fecha = NOW() $condicion";
        $mensaje = "rechazado";
    }

    if (isset($sqlUpdate)) {
        if ($conexion->query($sqlUpdate) === TRUE) {
            echo $mensaje;
        }
    }

} elseif ($resultadoInv3->num_rows > 0) {

    $UpdateSQL = "UPDATE `match` SET ";
    $condicion = "WHERE id1 = '$IdUsuario' AND idMascota1 = '$IdMascota' AND id2 = '$IdUsuarioP' AND idMascota2 = '$IdMascotaP'";

    if ($Match == 1) {
        $sqlUpdate = "$UpdateSQL status = '0', fecha = NOW() $condicion";
        $mensaje = "rechazado";
    } elseif ($Match == 2) {
        $sqlUpdate = "$UpdateSQL status = '0', fecha = NOW() $condicion";
        $mensaje = "rechazado";
    }elseif ($Match == 3) {
        $sqlUpdate = "$UpdateSQL status = '0', fecha = NOW() $condicion";
        $mensaje = "rechazado";
    }

    if (isset($sqlUpdate)) {
        if ($conexion->query($sqlUpdate) === TRUE) {
            echo $mensaje;
        }
    }

}elseif ($resultadoInvD->num_rows > 0) {
    echo "realizado";
} else {
    $sql = "INSERT INTO `match` (id1, idMascota1, id2, idMascota2, status, fecha) 
                  VALUES ('$IdUsuarioP', '$IdMascotaP', '$IdUsuario', '$IdMascota', '$Match', NOW())";

    if ($conexion->query($sql) === TRUE) {
        echo "insert";
    } else {
        echo "Error al insertar: " . $conexion->error;
    }
}


$conexion->close();
?>