<?php 
    include_once '../Inicio/includes/user.php';
    include_once '../Inicio/includes/user_session.php';
    include_once '../Inicio/Includes/conexion.php';
    
    $userSession = new UserSession();
    $user = new User();

    

    if(isset($_SESSION['user'])){
    $user->setUser($userSession->getCurrentUser());
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>ADOPCION</title>
    <link rel="stylesheet" href="http://localhost/Dogeway/CSS/match.css">
    
</head>
<body>
    <nav class="nav">
        <div class=ranalogo>
                <img class="rana" src="http://localhost/Dogeway/Imagenes/Rana_blanco.png">
                <div class="logo"> DOGEWAY</div>
        </div>
        <ul class="menu">
        <li><a href="../index.php">REGRESAR</a></li>
        </ul>
    </nav>
        

        
    <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {//Si se recibe el parametro para filtrar
            
            $filtro = $_POST['filt'];//lo guardas en esta variable
          }
          else{
            $filtro = 0;
          } 

          $mascotas = filtro($filtro, $conexion);

          $p = 0;
        while($consultaMs = mysqli_fetch_array($mascotas)){
           
                while($consultaUs = mysqli_fetch_array($allUsers) ){

                    if($consultaMs['id_usuario'] == $consultaUs['id'] ){                                                            
                        break;
                    }         
                }
                
                mysqli_data_seek($adop, 0);//Se reinicia el puntero de la consulta en la tabla adocion

                $band = existAdop($consultaMs['id'], $user->getuserId(), $adop);//Se verifica que el usuario activo no tenga "adopcion" con esa mascota
                
            
            if($band == 1  && $consultaMs['id_usuario'] != $user->getuserId() ){

                $p = 1;//Si entra en la condicion indica que hay al menos un resultado en la consulta
             
    ?>
       
        <div class="recuadro" >

           <ul class = "tabla">
                <ul>
                    <li class = "c1">
                    <img class = "imgMascota" src="../RegistroMascota/archivos/<?php echo $consultaMs['fotografiaMascota']?>" class="card-img-top" alt="...">
                    </li>

                    <li class = "c2">
                        <ul class ="u1">
                        <img class = "imgUsuario" src="../Registro/archivos/<?php echo $consultaUs['fotografia']?>" class="card-img-top" alt="...">

                        </ul>

                        <ul class ="u2">    
                            <div class ="textoUsuario">
                                <p><?php echo $consultaUs['nombre'], "<br> ";
                                         echo $consultaUs['apellidos'],"<br><br>";
                                         echo $consultaUs['municipio'], "<br>";
                                         echo $consultaUs['fechanac'], "<br>";
                                         echo $consultaUs['id'], "<br>";

                                ?></p>
                            </div>
                        </ul>
                    </li>
                </ul>
                <ul>
                    <li class = "c3">
                        <div class = "textoMascota">
                            <p><?php echo $consultaMs['nombreMascota'], "<br><br> ";
                                     echo $consultaMs['raza'],"<br><br>";
                                     echo $consultaMs['edad'], " Año(s)<br><br>";
                                     echo $consultaMs['descripcion'], "<br>";
                                     echo $consultaMs['id'], "<br>";
                            ?></p>
                        </div>
                        
                    </li>
                    
                    <li class = "c4">
                        <?php 
                            $idUs1 = $consultaUs['id'];//El usuario dueño de la mascota                            
                            $idUs2 = $user->getuserId();//El usuario que quiere adoptar
                            $idM = $consultaMs['id'];//La mascota 

                                echo"
                                <div class ='boton'>
                                    <button  onclick='adopcion($idUs1, $idUs2, $idM)'> 
                                        ADOPTAR
                                    </button>
                                </div>";
                        
                        ?>
                    </li>
                </ul>
           </ul>
            
        </div>

    <?php
             }//Condcion para mostrar resultados
             
             mysqli_data_seek($allUsers, 0);
        
            }//fin de la iteracion principal <Mascotas>
        
    ?>
         <?php
        if( $p == 0 )
          {?>
            
            <div class = "Empty">
               <p class = "unu"> No hay mascotas papu unu</p>
            </div>

        <?php }?>
            
</body>
</html>

<?php 

} else {header("Location: ../Inicio/index.php");
  exit();
} 
?>
