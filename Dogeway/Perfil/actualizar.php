<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    require 'config.php';

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    if (!empty($_FILES['archivo']['name'])) {
    $file_name = $_FILES['archivo'] ['name'];
    $file_tmp = $_FILES['archivo'] ['tmp_name'];
    $arreglo = explode(".", $file_name);
    $len = count($arreglo);
    $pos = $len-1;
    $ext = $arreglo[$pos];
    $dir = "../RegistroMascota/archivos/";
    $file_enc = md5_file($file_tmp);

    if ($file_name != ''){
        $file_name1 = "$file_enc.$ext";
        copy($file_tmp, $dir.$file_name1);
    }
    $cartilla = $file_name1;
    }
    if (!empty($_FILES['archive']['name'])) {
    $file_name2 = $_FILES['archive'] ['name'];

    $file_tmp2 = $_FILES['archive'] ['tmp_name'];
    $arreglo2 = explode(".", $file_name2);
    $len2 = count($arreglo2);
    $pos2 = $len2-1;
    $ext2 = $arreglo2[$pos2];
    $dir2 = "../RegistroMascota/archivos/";
    $file_enc2 = md5_file($file_tmp2);

    if ($file_name2 != ''){
        $file_name12 = "$file_enc2.$ext2";
        copy($file_tmp2, $dir2.$file_name12);
    }
    
    $fotografiaMascota = $file_name12;
    }

    $categoria = $_POST['categoria'];
    $especie = $_POST['especie'];
    $caracteristicas = $_POST['caracteristicas'];
    $especificaciones = $_POST['especificaciones'];
    $edad = $_POST['edad'];
    $raza = $_POST['raza'];
    $descripcion = $_POST['descripcion'];
    $nombreMascota = $_POST['nombreMascota'];
    $id_mascota = $_POST['id_Mascota']; 

    // Consulta
    if (!empty($_FILES['archivo']['name']) && !empty($_FILES['archive']['name'])) {

        $sql = "UPDATE mascota SET categoria = '$categoria', especie = '$especie', fecha = NOW(), 
        caracteristicas = '$caracteristicas', especificaciones = '$especificaciones',
        edad = '$edad', raza = '$raza', descripcion = '$descripcion', fotografiaMascota = '$fotografiaMascota', cartilla = '$cartilla',
        nombreMascota = '$nombreMascota' WHERE id = '$id_mascota'";

    } elseif (!empty($_FILES['archive']['name']) && empty($_FILES['archivo']['name'])) {

        $sql = "UPDATE mascota SET categoria = '$categoria', especie = '$especie', fecha = NOW(), 
        caracteristicas = '$caracteristicas', especificaciones = '$especificaciones',
        edad = '$edad', raza = '$raza', descripcion = '$descripcion', fotografiaMascota = '$fotografiaMascota',
        nombreMascota = '$nombreMascota' WHERE id = '$id_mascota'";

    } elseif (!empty($_FILES['archivo']['name']) && !empty($_FILES['archive']['name'])) {

        $sql = "UPDATE mascota SET categoria = '$categoria', especie = '$especie', fecha = NOW(), 
        caracteristicas = '$caracteristicas', especificaciones = '$especificaciones',
        edad = '$edad', raza = '$raza', descripcion = '$descripcion', fotografiaMascota = '$fotografiaMascota', cartilla = '$cartilla',
        nombreMascota = '$nombreMascota' WHERE id = '$id_mascota'";
    } else {
    // Ninguno
        $sql = "UPDATE mascota SET categoria = '$categoria', especie = '$especie', fecha = NOW(), 
        caracteristicas = '$caracteristicas', especificaciones = '$especificaciones',
        edad = '$edad', raza = '$raza', descripcion = '$descripcion',
        nombreMascota = '$nombreMascota' WHERE id = '$id_mascota'";
    }

    // Ejecutar la consulta
    if ($conn->query($sql) == TRUE) {
        header("Location: lista.php");
    } else {
        echo "Error al insertar el registro: " . $conn->error;
    }

    $conn->close();
}

?>