<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mascota";

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
            echo '<script>';
                echo 'document.getElementById("mensaje-de-exito").innerHTML = "Su cuenta ha sido verificada con éxito. Ahora puede iniciar sesión.";';
            echo '</script>';
        } else {
            echo '<script>';
             echo 'document.getElementById("mensaje-de-error").innerHTML = "Error al actualizar la cuenta";' . $stmt->error;
            echo '</script>';
        }
    } else {
        echo '<script>';
        echo 'document.getElementById("mensaje-de-error").innerHTML = "La verificacion ha fallado, verifique su link";';
        echo '</script>';
    }

    $stmt->close();
} else {
    echo '<script>';
    echo 'document.getElementById("mensaje-de-error").innerHTML = "Su cuenta ha sido verificada con éxito. Ahora puede iniciar sesión.";';
    echo '</script>';
}

$conn->close();
?>