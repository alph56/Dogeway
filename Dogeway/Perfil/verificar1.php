<?php
include ("config.php"); 

if ($conn) {
    $nickname= $_POST['nickname'];

    $query = "SELECT * FROM usuario WHERE nickname = '$nickname'";
    $sql = $conn->query($query);
    $registro = $sql->num_rows;

    if ($registro){
        echo "nickname";  
    }else{
        echo "error";
    }
}
?>