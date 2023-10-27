<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require 'db.php';

$errorRegistro = '';

function comprobar_email($email) {
    return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? 1 : 0;
}

function duplicadocorreo($correo) {

    $conexion = conectar();
    $correo = $conexion->real_escape_string($correo);

    $consulta = "SELECT email FROM usuario WHERE email = '$correo'";
    $resultado = $conexion->query($consulta);

    if ($resultado->num_rows > 0) {
        $conexion->close();
        return false;
    } else {
        $conexion->close();
        return true;
    }
}

function duplicadonick($nick) {

    $conexion = conectar();
    $nick = $conexion->real_escape_string($nick);

    $consulta = "SELECT nickname FROM usuario WHERE nickname = '$nick'";
    $resultado = $conexion->query($consulta);

    if ($resultado->num_rows > 0) {
        $conexion->close();
        return false;
    } else {
        $conexion->close();
        return true;
    }
}

function duplicadoine($ine) {

    $conexion = conectar();
    $ine = $conexion->real_escape_string($ine);

    $consulta = "SELECT ine FROM usuario WHERE ine = '$ine'";
    $resultado = $conexion->query($consulta);

    if ($resultado->num_rows > 0) {
        $conexion->close();
        return false;
    } else {
        $conexion->close();
        return true;
    }
}

function duplicadocurp($curp) {

    $conexion = conectar();
    $curp = $conexion->real_escape_string($curp);

    $consulta = "SELECT curp FROM usuario WHERE curp = '$curp'";
    $resultado = $conexion->query($consulta);

    if ($resultado->num_rows > 0) {
        $conexion->close();
        return false;
    } else {
        $conexion->close();
        return true;
    }
}

if (isset($_POST['registrar'])) {
    //Comprobar email
   if (comprobar_email($_POST['email'])) {
        if (duplicadocorreo($_POST['email']) && duplicadonick($_POST['nickname'])) {
            if (duplicadocurp($_POST['curp'])) {
                if (duplicadoine($_POST['ine'])) {
                    $nombre = $_POST['nombre'];
                    $apellidos = $_POST['apellidos'];
                    $email = $_POST['email'];
                    $pass = $_POST['pass'];
                    $curp = $_POST['curp'];
                    $nickname = $_POST['nickname'];
                    $fechanac = $_POST['fechanac'];
                    $telefono = $_POST['telefono'];
                    $municipio = $_POST['municipio'];
                    $ine = $_POST['ine'];
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
                    $message .= "\n(❁´◡❁)(❁´◡❁)(❁´◡`❁)";

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
                            $database = "dogeway";

                            $conn = new mysqli($servername, $username, $password, $database);

                            if ($conn->connect_error) {
                                die("Error de conexión a la base de datos: " . $conn->connect_error);
                            }

                            $verificado = 0;

                            $insertQuery = "INSERT INTO usuario (nombre, email, codigo_verificacion, verificado, pass,
                            curp, nickname, apellidos, fechanac, telefono, municipio, ine) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; 
                            //Agregar ine y fotografia despues aqui tmbn y sus 2 ?, no olvidar agregar el valor abajo del string
                            $stmt = $conn->prepare($insertQuery);
                            $stmt->bind_param("sssissssssss", $nombre, $email, $codigo_verificacion, $verificado, $pass, 
                            $curp, $nickname, $apellidos, $fechanac, $telefono, $municipio, $ine);

                            // $ine, $fotografia Ingresar estos datos al stmt despues.
                            
                            if ($stmt->execute()) {
                        
                                echo "Se ha enviado un correo de verificación a su dirección de correo electrónico. Por favor, verifíquelo para completar el registro.";
                        
                            } else {
                                //Este no mostrar, solo raro caso de error puede pasar para verificar la insercion
                                echo "Error al insertar el usuario en la base de datos";
                            }
                            
                            $stmt->close();
                            $conn->close();
                        } else {

                            echo'Error al enviar el correo: ' . $mail->ErrorInfo; 
                           
                        }
                        
                    } catch (Exception $e) {
                        echo 'Error al enviar el correo: ' . $e->getMessage(); 

                    }
                }else{ $errorRegistro ="El INE ingresado ya esta en uso";}
            }else{ $errorRegistro ="El CURP ingresado ya esta en uso";}
        }else{ $errorRegistro ="El usuario y/o correo ya estan en uso";}
    }else{$errorRegistro = "Ingrese un correo válido";}

    if (!empty($errorRegistro)) {
        header('Location: registro.php?error=' . urlencode($errorRegistro));
        exit;
    }
}
?>