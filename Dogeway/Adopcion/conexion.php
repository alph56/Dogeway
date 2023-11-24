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

    $adop = mysqli_query($conexion, "SELECT * FROM adopcion");
    
      function filtro( $filt, $conex ){

        switch($filt){
          case 0://Todos los animales en adopcion
            $allMascotaAdop = mysqli_query($conex, "SELECT * FROM mascota WHERE categoria = 2 ");
          break;
          case 1://Perros
            $allMascotaAdop = mysqli_query($conex, "SELECT * FROM mascota WHERE categoria = 2 AND especie = 1");
          break;
          case 2://Gatos
            $allMascotaAdop = mysqli_query($conex, "SELECT * FROM mascota WHERE categoria = 2 AND especie = 2");
          break;
          case 3://Aves
            $allMascotaAdop = mysqli_query($conex, "SELECT * FROM mascota WHERE categoria = 2 AND especie = 3");
          break;
          case 4://Reptiles
            $allMascotaAdop = mysqli_query($conex, "SELECT * FROM mascota WHERE categoria = 2 AND especie = 4");
          break;
          case 5://Acuaticos
            $allMascotaAdop = mysqli_query($conex, "SELECT * FROM mascota WHERE categoria = 2 AND especie = 5");
          break;
          case 6://Roedores
            $allMascotaAdop = mysqli_query($conex, "SELECT * FROM mascota WHERE categoria = 2 AND especie = 6");
          break;
        }
          return $allMascotaAdop;
      }
      

    //FUNCIONES _______________________________
    
    function existAdop($idM , $idU, $adp){

      while($consA = mysqli_fetch_array($adp)){
          
        if($idM == $consA['id3'])
        {
          if($idU == $consA['id2'])
          return 0;
        }
      }
      return 1;

    }
   
  //SCRIPTS ___________________________________________-
?>
<script>

function adopcion(idUs1, idUs2, idM) { 

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200){

    }
    };
    
    xhttp.open("GET", "insAdop.php? id1=" + idUs1 + "&id2=" + idUs2 + "&id3=" + idM, true);
    xhttp.send();
}
</script>