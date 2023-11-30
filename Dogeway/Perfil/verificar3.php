<?php
include ("config.php"); 

if ($conn) {
    $ine= $_POST['ine'];

    $query = "SELECT * FROM usuario WHERE ine = '$ine'";
    $sql = $conn->query($query);
    $registro = $sql->num_rows;

    if ($registro){
        echo "ine";  
    }else{
        echo "error";
    }
}
?>

