<?php 
    include_once '../Inicio/includes/user.php';
    include_once '../Inicio/includes/user_session.php';
    
    $userSession = new UserSession();
    $user = new User();

    if(isset($_SESSION['user'])){
    $user->setUser($userSession->getCurrentUser());
    $si = $user->getAdmin();
    if ($si == 0) {
        header("Location: ../Inicio/index.php");  
    }
?>
<html>

<body>
    <?php include "header.php"?>
    <section>
        <h1>Bienvenido <?php echo $user->getNombre() . " " .$user->getApellidos();?> al sistema de administracion</h1>
        <div class = "perro" ><img class='dog' src='../Imagenes/perro.png' alt=''> </div>
    
    </section>

</body>

</html>

<?php 

} else {header("Location: ../Inicio/index.php");
  exit();
} 
?>