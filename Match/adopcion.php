<?php 
    include_once '../Inicio/includes/user.php';
    include_once '../Inicio/includes/user_session.php';
    include_once '../Inicio/includes/conexion.php';
    
    $userSession = new UserSession();
    $user = new User();

    $bool;

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
        while($consultaUs = mysqli_fetch_array($allUsers)){
            /*
                Ciclos y condiciones
                $band = false; 

                while($consultaMs = mysqli_fetch_array($allMascotas)){
                    while($consultaUs = mysqli_fetch_array($allUsers) || !band){

                        if(consultaMs['id_dueno'] ==  consutaUs['id'] && 
                            consultaMs['id_duenoo'] !=  $user->getUserId() &&
                                consultaMs['status'] == <Que este en adopcion> ){
                            
                                $band = true;
                        }
                    }

                    if(band){ }Esta llave tambien abajo para condicionar 
                }Esta llave estara abajo
             */
            
             if($consultaUs['id'] != $user->getUserId() ){
            //if
            
           
    ?>
       
        <div class="recuadro" >

           <ul class = "tabla">
                <ul>
                    <li class = "c1">
                        <img class = "imgMascota" src="../Registro/archivos/<?php echo $consultaUs['fotografia']?>" class="card-img-top" alt="...">
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

                                ?></p>
                            </div>
                        </ul>
                    </li>
                </ul>
                <ul>
                    <li class = "c3">
                        
                    </li>
                    
                    <li class = "c4">
                        <?php $id = $consultaUs['id']?>

                        <button class ="boton"> 
                            <img class="icono1" src="../Imagenes/crz.png">
                        </button>
                    </li>
                </ul>
           </ul>
            
        </div>

    <?php
             }
        }/*Aqui la primera llave para condicionar todas las mascotas */
    ?>
        
</body>
</html>

<?php 

} else {header("Location: ../Inicio/index.php");
  exit();
} 
?>
