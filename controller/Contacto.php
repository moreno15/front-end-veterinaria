<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require_once 'PHPMailer/Exception.php';
require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';

Class Contacto {
	//Implementamos nuestro constructor
	public function __construct() {

	}

    public function enviarmensaje($nombre,$correo,$asunto,$descripcion){


      $mail = new PHPMailer(true);
       try {
         //Server settings
         $mail->SMTPDebug = 0;                      // Enable verbose debug output
         $mail->isSMTP();                                            // Send using SMTP
         $mail->Host       = 'smtp.gmail.com ';                    // Set the SMTP server to send through
         $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
         $mail->Username   = 'ronald.27unsch@gmail.com';                     // SMTP username
         $mail->Password   = 'llueqmhtxeqlzbgk';                               // SMTP password
         $mail->SMTPSecure = 'ssl';    // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
         $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
         $mail->CharSet = 'UTF-8';
         //Recipients
         $mail->setFrom('ronald.27unsch@gmail.com', 'Clinica San Critobal');  //rmh27130572
         $mail->addAddress($correo);

         // Content
         $mail->isHTML(true);                                  // Set email format to HTML
         $mail->Subject = $asunto;
         $mail->Body    = $nombre ."<br>". $correo."<br><br>". $descripcion;

         $mail->send();
         echo 'se  envio correctamente su consulta ';
       } catch (Exception $e) {
         echo "error en enviar la consulta: {$mail->ErrorInfo}" ;
       }


    }// Enviar


}
 ?>
