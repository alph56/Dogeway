<?php
    $host = 'localhost';
    $bd = 'dogeway';
    $user = 'root';
    $password = "";

    $conexion = new mysqli($host, $user, $password, $bd);

    if(!$conexion){
        die("Error al conectar " . mysqli_connect_error());
    }

    //CONSULTAS  _________________________

    $allUsers = mysqli_query($conexion, "SELECT * FROM usuario ");

    //$chat = mysqli_query($conexion, "SELECT * FROM chat");

    //$match = mysqli_query($conexion, "SELECT * FROM match");

    $filtroMascota = 0;

    switch($filtroMascota){
      case 0:
        $allMascota = mysqli_query($conexion, "SELECT * FROM mascota");
      break;
      case 1:
        //$allMascota = mysqli_query($conexion, "SELECT * FROM mascota WHERE especie = 'perro' ");
      break;
    }
    
    //FUNCIONES _______________________________
    
    
    
?>