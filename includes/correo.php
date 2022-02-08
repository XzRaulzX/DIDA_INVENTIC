<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\SMTP;

	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';
        date_default_timezone_set('Etc/UTC');
	
// -----------------------------------------------------------------------	
// Envio de correo general (sin adjunto)
function Envia_Correo_Simple($destinatario,$asunto,$cuerpo)
// -----------------------------------------------------------------------
{

    $mail = new PHPMailer();
    try 
        {
            //Configuración del servidor SMTP de Correo
            
            //$mail->SMTPDebug = SMTP::DEBUG_CONNECTION;                      //Si queremos ver la depuración de errores

            $mail->Port       = 587;                                    
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com';                    
            $mail->SMTPAuth   = true;                                   
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  
            $mail->CharSet = PHPMailer::CHARSET_UTF8;
            $mail->Username   = 'iesdiegoangulo.tic@gmail.com';                     
            $mail->Password   = 'TICangulo@1.';                               
          

            //Remitente
            $mail->setFrom('iesdiegoangulo.tic@gmail.com', 'Administración TIC');//Modificar
            // Correo destinatario
            $mail->addAddress($destinatario, 'Profesorado');//Modificar
            // Content

            $mail->isHTML(true);                                  // Set email format to HTML
            // ASUNTO
            $mail->Subject = $asunto;//Modificar
            // CUERPO
            $mail->Body = $cuerpo; //Modificar
            $mail->send();
           
        } 
        catch (Exception $e) {
            return $mail->ErrorInfo;
     
        }    
}
// -----------------------------------------------------------------------
// Envio de correo general (sin adjunto)
function Envia_Correo_Adjunto($destinatario,$asunto,$cuerpo,$adjunto,$nombre_adjunto)
// -----------------------------------------------------------------------
{

    $mail = new PHPMailer();
    try 
        {
            //Configuración del servidor SMTP de Correo
            
           // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Si queremos ver la depuración de errores

            $mail->Port       = 587;                                    
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com';                    
            $mail->SMTPAuth   = true;                                   
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        
            $mail->Username   = 'iesdiegoangulo.tic@gmail.com';                     
            $mail->Password   = 'TICangulo@1.';                               
          

            //Remitente
            $mail->setFrom('iesdiegoangulo.tic@gmail.com', 'Administración TIC');//Modificar
            // Correo destinatario
            $mail->addAddress($destinatario, 'Profesorado');//Modificar
            // Content
            
            $mail->isHTML(true);                                  // Set email format to HTML
            // ASUNTO
            $mail->Subject = $asunto;//Modificar
            // CUERPO
            $mail->Body = $cuerpo; //Modificar
            // Attachments (adjuntos)
            if (trim($nombre_adjunto == ""))
                {
                $mail->addAttachment($adjunto);         // adjunto
                }
            else{ 
                 $mail->addAttachment($adjunto,$nombre_adjunto);    // Nombre adjunto
                };
            

            $mail->send();
           
        } 
        catch (Exception $e) {
            return $mail->ErrorInfo;
        }    
}
?>