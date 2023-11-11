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
    $curpsin = '/^[A-Z]{4}[0-9]{6}[HM][A-Z]{6}[0-9]$/';
    $telefonosin = '/^(\d{10})?$/';
    $inesin= '/^[A-Z]{6}[0-9]{8}[HM][0-9]{3}$/';

    $curpValido = preg_match($curpsin, $_POST['curp']);
    $telefonoValido = preg_match($telefonosin, $_POST['telefono']);
    $ineValido = preg_match($inesin, $_POST['ine']);

   if (comprobar_email($_POST['email'])) {
        if ($curpValido){
            if ($telefonoValido){
                if ($ineValido){
                    if (duplicadocorreo($_POST['email']) && duplicadonick($_POST['nickname'])) {
                        if (duplicadocurp($_POST['curp'])) {
                            if (duplicadoine($_POST['ine'])) {
                                $nombre = $_POST['nombre'];
                                $apellidos = $_POST['apellidos'];
                                $email = $_POST['email'];
                                $pass = $_POST['pass'];
                                $passEnc = md5($pass);
                                $curp = $_POST['curp'];
                                $nickname = $_POST['nickname'];
                                $fechanac = $_POST['fechanac'];
                                $telefono = $_POST['telefono'];
                                $municipio = $_POST['municipio'];
                                $ine = $_POST['ine'];
                                $codigo_verificacion = md5(uniqid(rand(), true));

                                $file_name = $_FILES['archivo'] ['name'];

                                //FOTOGRAFIA DATOS
                                    $file_tmp = $_FILES['archivo'] ['tmp_name'];
                                    $arreglo = explode(".", $file_name);
                                    $len = count($arreglo);
                                    $pos = $len-1;
                                    $ext = $arreglo[$pos];
                                    $dir = "archivos/";
                                    $file_enc = md5_file($file_tmp);

                                    if ($file_name != ''){
                                        $file_name1 = "$file_enc.$ext";
                                        copy($file_tmp, $dir.$file_name1);
                                    }
                                
                                $fotografia = $file_name1;
                                $archivo_n = $file_name;

                                $smtpHost = 'smtp.gmail.com';
                                $smtpUsername = 'dogewaycompany@gmail.com';   //Ingresen estas credenciales para permitir el acceso en google
                                $smtpPassword = 'zecfjcjnpwegukuh'; 
                                $smtpPort = 587;

                                $recipient = $email; 
                                $subject = 'Verificar su cuenta de DogeWay';
                                $message = "Hola, $nombre $apellidos.\n\n";
                                $message .= "¡Gracias por registrarte en Dogeway!\n\n";
                                $message .= "Dale click al siguiente enlace para verificar tu cuenta:\n";
                                $message .= "  ∧,,,∧\n";
                                $message .= "(  ̳• · • ̳)\n";
                                $message .= "/    づ♡ http://localhost/dogeway/Registro/verificar.php?email=$email&codigo=$codigo_verificacion";
                    

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
                                        curp, nickname, apellidos, fechanac, telefono, municipio, ine, fotografia, archivo_n) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; 
                                        $stmt = $conn->prepare($insertQuery);
                                        $stmt->bind_param("sssissssssssss", $nombre, $email, $codigo_verificacion, $verificado, $passEnc, 
                                        $curp, $nickname, $apellidos, $fechanac, $telefono, $municipio, $ine, $fotografia, $archivo_n);

                                        
                                        if ($stmt->execute()) {

                                            header('Location: mensajes/mensaje_verificacion.php');
                                    
                                        } else {
                                
                                            header('Location: mensajes/mensaje_error.php');
                                        }
                                        
                                        $stmt->close();
                                        $conn->close();
                                    } else {

                                        echo "Error al enviar el correo:" . $mail->ErrorInfo;
                                        
                                    
                                    }
                                    
                                } catch (Exception $e) {
                                    echo  "Error al enviar el correo:" . $e->getMessage(); 
                                }
                            }else{ $errorRegistro ="El INE ingresado ya esta en uso";}
                        }else{ $errorRegistro ="El CURP ingresado ya esta en uso";}
                    }else{ $errorRegistro ="El usuario y/o correo ya estan en uso";}
                }else{$errorRegistro = "Ingrese un ine Valido";}
            }else{$errorRegistro = "Ingrese un telefono Valido";}
        }else{$errorRegistro = "Ingrese un curp Valido";}
    }else{$errorRegistro = "Ingrese un correo válido";}

    if (!empty($errorRegistro)) {
        header('Location: registro.php?error=' . urlencode($errorRegistro));
        exit;
    }
}
?>