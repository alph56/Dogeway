<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    require 'db.php';
    $conexion = conectar();

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $file_name = $_FILES['archivo'] ['name'];

    $file_tmp = $_FILES['archivo'] ['tmp_name'];
    $arreglo = explode(".", $file_name);
    $len = count($arreglo);
    $pos = $len-1;
    $ext = $arreglo[$pos];
    $dir = "archivos/";
    $file_enc = md5_file($file_tmp);

    if ($file_name != ''){
        $file_name1 = "$file_enc.$ext";
        copy($file_tmp, $dir.$file_name1);
    }

    $cartilla = $file_name1;

    $file_name2 = $_FILES['archive'] ['name'];

    $file_tmp2 = $_FILES['archive'] ['tmp_name'];
    $arreglo2 = explode(".", $file_name2);
    $len2 = count($arreglo2);
    $pos2 = $len2-1;
    $ext2 = $arreglo2[$pos2];
    $dir2 = "archivos/";
    $file_enc2 = md5_file($file_tmp2);

    if ($file_name2 != ''){
        $file_name12 = "$file_enc2.$ext2";
        copy($file_tmp2, $dir2.$file_name12);
    }
    
    $fotografiaMascota = $file_name12;
    

    $categoria = $_POST['categoria'];
    $especie = $_POST['especie'];
    $caracteristicas = $_POST['caracteristicas'];
    $especificaciones = $_POST['especificaciones'];
    $edad = $_POST['edad'];
    $raza = $_POST['raza'];
    $descripcion = $_POST['descripcion'];
    $nombreMascota = $_POST['nombreMascota'];
    $id_usuario = $_POST['id_usuario']; 

    // Consulta de inserción
    $sql = "INSERT INTO mascota (categoria, fotografiaMascota, cartilla, especie, caracteristicas, especificaciones, edad, raza, descripcion, nombreMascota, id_usuario, fecha)
            VALUES ('$categoria', '$fotografiaMascota', '$cartilla', '$especie', '$caracteristicas', '$especificaciones', '$edad', '$raza', '$descripcion', '$nombreMascota', $id_usuario, NOW())";

    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        header("Location: comenzar.php");
    } else {
        echo "Error al insertar el registro: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
}

?>