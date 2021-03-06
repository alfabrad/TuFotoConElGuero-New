<?php 
$resultados = Array(); 
$contact_name = trim($_POST['contact_name']);
$contact_mail = trim($_POST['contact_mail']);
$contact_message = trim($_POST['contact_message']);

if(trim($contact_name) == "" ) {
    $resultados['success'] = false;
    $resultados['message'] = "Por favor ingrese  su nombre.";
} else { 
    
    if(trim($contact_mail) == "" ) {
        $resultados['success'] = false;
        $resultados['message'] = "Se nos hara un poco dificil contactarle, sin una dirección de email.";
    } else {
        if(trim($contact_message) == "" ) {
            $resultados['success'] = false;
            $resultados['message'] = "Olvido indicarnos el motivo de su consulta.";
        } else {
            $emailTo = "contacto@tufotoconelguero.com";
            //$emailTo = "ideas.reticular@gmail.com";
            $subject = "Solicitud de contacto!";
            $Message = "{$contact_name} ({$contact_mail})<br /><br />Dice:<br />{$contact_message}";
            $Headers = "From:{$contact_mail}\r\n"; // Asi usaremos la opciones responder
            $Headers .= "Content-type: text/html; charset=utf-8";
            $resultados['success'] = mail( $emailTo, $subject, $Message, $Headers );
            $resultados['message'] = ( $resultados[ 'success' ] ) ? "Se ha enviado la solicitud de contacto" : "Hemos tenido un fallo en nuestros servidores, intentelo en un momento mas..";
        }
    }
}

echo json_encode($resultados);
?>