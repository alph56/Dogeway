<?php
include ("config.php"); 

if ($conn) {
    $curp= $_POST['curp'];

    $query = "SELECT * FROM usuario WHERE curp = '$curp'";
    $sql = $conn->query($query);
    $registro = $sql->num_rows;

    if ($registro){
        echo "curp";  
    }else{
        echo "error";
    }
}
?>

