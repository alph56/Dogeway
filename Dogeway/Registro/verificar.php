<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "dogeway";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

if (isset($_GET['email']) && isset($_GET['codigo'])) {
    $email = $_GET['email'];
    $codigo_verificacion = $_GET['codigo'];

    $query = "SELECT * FROM usuario WHERE email = ? AND codigo_verificacion = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $codigo_verificacion);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $updateQuery = "UPDATE usuario SET verificado = 1 WHERE email = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("s", $email);
    
        if ($stmt->execute()) {

                echo "Su cuenta ha sido verificada con éxito. Ahora puede iniciar sesión."; 

        } else {
        
             echo "Error al actualizar la cuenta" . $stmt->error;
        
        }
    } else {
    
        echo "La verificacion ha fallado, verifique su link";

    }

    $stmt->close();
} else {
  
    echo "Su cuenta ha sido verificada con éxito. Ahora puede iniciar sesión.";
  
}

$conn->close();
?>