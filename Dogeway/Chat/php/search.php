<?php
    include_once '../../Inicio/includes/user.php';
    include_once '../../Inicio/includes/user_session.php';
    
    $userSession = new UserSession();
    $user = new User();

    if (isset($_SESSION['user'])) {
        $user->setUser($userSession->getCurrentUser());
    
    include_once "config.php";

    $outgoing_id = $user->getUniqueId();
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    $sql = "SELECT usuario.*
        FROM usuario
        JOIN (
          SELECT idmatch, MAX(fecha) AS ultima_fecha
          FROM (
            SELECT id1 AS idmatch, fecha
            FROM `match`
            WHERE id2 = {$outgoing_id} AND (status = 4 OR status = 5 OR status = 6)
            UNION
            SELECT id2 AS idmatch, fecha
            FROM `match`
            WHERE id1 = {$outgoing_id} AND (status = 4 OR status = 5 OR status = 6)
          ) AS subquery
          GROUP BY idmatch
        ) AS subquery ON usuario.unique_id = subquery.idmatch
        WHERE NOT usuario.unique_id = {$outgoing_id} AND usuario.verificado = 1
        AND (nombre LIKE '%{$searchTerm}%' OR apellidos LIKE '%{$searchTerm}%')
        ORDER BY subquery.ultima_fecha DESC";

    $output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }else{
        $output .= 'Sin resultados :(';
    }
    echo $output;
    }
?>