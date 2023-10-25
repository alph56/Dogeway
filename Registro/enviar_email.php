<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

function comprobar_email($email) {
    return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? 1 : 0;
}

if (isset($_POST['registrar'])) {
    //Comprobar email
   if (comprobar_email($_POST['email'])) {

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $curp = $_POST['curp'];
    $nickname = $_POST['nickname'];
    $fechanac = $_POST['fechanac'];
    $telefono = $_POST['telefono'];
    $municipio = $_POST['municipio'];
    //$ine = $_POST['ine'];
    //$fotografia = $_POST['fotografia']; activar estas variables post cuando se arregle el query abajo.
    $codigo_verificacion = md5(uniqid(rand(), true));

    $smtpHost = 'smtp.gmail.com';
    $smtpUsername = 'dogewaycompany@gmail.com';   //Ingresen estas credenciales para permitir el acceso en google
    $smtpPassword = 'zecfjcjnpwegukuh'; 
    $smtpPort = 587;

    $recipient = $email; 
    $subject = 'Verificar su cuenta de DogeWay';
    $message = "Hola $nombre $apellidos.\n\n";
    $message .= "Por favor, haga clic en el siguiente enlace para verificar su correo electrónico:\n";
    $message .= "http://localhost/dogeway/Registro/verificar.php?email=$email&codigo=$codigo_verificacion";

    $mail = new PHPMailer();

    try {
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->Host = $smtpHost;
        $mail->SMTPAuth = true;
        $mail->Username = $smtpUsername;
        $mail->Password = $smtpPassword;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $smtpPort;

        $mail->setFrom($smtpUsername, 'DOGEWAY by Schildkrote');
        $mail->addAddress($recipient);
        $mail->Subject = $subject;
        $mail->Body = $message;

        if ($mail->send()) {
       
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "mascota";

            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Error de conexión a la base de datos: " . $conn->connect_error);
            }

            $verificado = 0;

            $insertQuery = "INSERT INTO usuario (nombre, email, codigo_verificacion, verificado, pass,
            curp, nickname, apellidos, fechanac, telefono, municipio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; 
            //Agregar ine y fotografia despues aqui tmbn y sus 2 ?, no olvidar agregar el valor abajo del string
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("sssisssssss", $nombre, $email, $codigo_verificacion, $verificado, $pass, 
            $curp, $nickname, $apellidos, $fechanac, $telefono, $municipio);

            // $ine, $fotografia Ingresar estos datos al stmt despues.
            
            if ($stmt->execute()) {
                echo '<script>';
                    echo 'document.getElementById("mensaje-de-exito").innerHTML = "Se ha enviado un correo de verificación a su dirección de correo electrónico. Por favor, verifíquelo para completar el registro.";';
                echo '</script>';
            } else {
                echo '<script>';
                    echo 'document.getElementById("mensaje-de-error").innerHTML = "Error al insertar el usuario en la base de datos";';
                echo '</script>';
            }
            
            $stmt->close();
            $conn->close();
        } else {
            echo 'Error al enviar el correo: ' . $mail->ErrorInfo;
        }
        
    } catch (Exception $e) {
        echo 'Error al enviar el correo: ' . $e->getMessage();
    }
}else { echo '<script>';
    echo 'document.getElementById("mensaje-de-error").innerHTML = "Ingrese un correo valido";';
echo '</script>'; }
}
?>