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
    <link rel="stylesheet" href="http://localhost/Dogeway/CSS/adopt.css">
    
</head>
<body>
    <nav class="nav">
        <div class=ranalogo>
                <img class="rana" src="http://localhost/Dogeway/Imagenes/Rana_blanco.png">
                <div class="logo"> DOGEWAY</div>
        </div>
        <ul class="menu">
              <li><a href="../Match/lista.php">MATCH</a></li>
              <li><a href="../Adopcion/adopcion.php">ADOPCION</a></li>
              <li><a href="../Perfil/lista.php">PERFIL</a><br>
                  <ul class="submenu">
                      <li> <a href="../RegistroMascota/registro.php">Registrar Mascota</a></li>
                  </ul>
              </li>
              <li><a href="../Chat/users.php">CHAT</a></li>
              <li><a href="../index.php">PAGINA PRINCIPAL</a></li>
              <li><a href="../Inicio/includes/logout.php">CERRAR SESION</a></li>
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
            <div class="columna_izquierda">
                <img class = "imgMascota" src="../RegistroMascota/archivos/<?php echo $consultaMs['fotografiaMascota']?>" class="card-img-top" alt="...">
                       <div class="texto">
                            <?php
                                    echo $consultaMs['nombreMascota']. ', ' . $consultaMs['edad'] . "<br>";
                                    $idUs1 = $consultaUs['id'];//El usuario dueño de la mascota
                                    $idUs2 = $user->getuserId();//El usuario que quiere adoptar
                                    $idM = $consultaMs['id'];//La mascota 
                                    echo" <br><a href ='../Chat/users.php' class='adopcion' onclick='adopcion($idUs1, $idUs2, $idM)'>ADOPTAR</a><br>";
                                ?>
                       </div> 
            </div>

            <div class="columna_derecha">
                <div class="fila1">
                    <img class = "imgUsuario" src="../Registro/archivos/<?php echo $consultaUs['fotografia']?>" class="card-img-top" alt="...">
                    <div class="texto2">
                    <p>@<?php 
                                echo $consultaUs['nickname'], "<br><br>";
                                echo '● ' . $consultaUs['nombre'] . ' ' . $consultaUs['apellidos'] . "<br><br>";
                                echo '● ' . $consultaUs['municipio'], "<br>";
                        ?></p>
                    </div>

                </div>
<div class = "fila2">
                        <div class="texto3">
                            <p><?php 
                                    echo '(❁) ' . $consultaMs['raza'] . "<br>";
                                    echo '(❁) ' . $consultaMs['especificaciones'],"<br>";
                                    echo '(❁) ' . $consultaMs['caracteristicas'],"<br>";
                                    echo '(❁) ' . $consultaMs['descripcion'], "<br><br>";
                                ?></p>
                        </div>
                    </div>
            </div>
        </div>

    <?php
             }//Condcion para mostrar resultados
             
             mysqli_data_seek($allUsers, 0);
        
            }//fin de la iteracion principal <Mascotas>
        
    ?>
        <?php
        if( $p == 0 )
          {?>
               <h2> No hay mascotas disponibles para adoptar :></h2>
        <?php }?>
            
</body>
</html>

<?php 

} else {header("Location: ../Inicio/index.php");
  exit();
} 
?>
