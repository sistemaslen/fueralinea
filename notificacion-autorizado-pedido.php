<?php 

if($respuesta_autorizacion == "SI"){
  $mensaje ='Se autorizo el pedido fuera de la línea';
} else {
  $mensaje ='No se autorizo el pedido fuera de la línea';
}


date_default_timezone_set('America/Mazatlan');
$fecha = date("d-m-Y G:i");


require_once 'swiftmailer/vendor/autoload.php';
 
// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
  ->setUsername('noreply@len.com.mx')
  ->setPassword('WSlt17kl')
;
 
// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);
 
// Create a message
$body = '

<html>
<head>
<meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=gb18030">
  <title>Nueva guia</title>
</head>
<body>

<div style="background-color: #ddd;padding-top: 15px;padding-right: 5%;padding-bottom: 15px;padding-left: 5%">
<table style="background-color: white;width: 100%;">
  <tr>
    <td style="text-align: center;border-bottom: 1px solid #eee;padding-top: 10px;padding-bottom: 10px">
      <img src="https://len.com.mx/exclusiva/tienda/images/len.png" style="height: 3em">
    </td>
  </tr>
</table>

<table style="background-color: white;width: 100%">
  <tr>
    <td style="border-bottom: 1px solid #eee;padding-top: 15px;padding-left: 15px;padding-right: 15px;padding-bottom: 15px">
      <h2 style="margin-top: 0px;margin-bottom: 0px;text-align:center;font-family:Roboto,sans-serif;margin-top: 0px;margin-bottom: 0px;">'.$mensaje.' #'.$pedido.'</h2>
      <h4 style="font-family:Roboto,sans-serif;text-align:center;color:gray;margin-top: 0px;margin-bottom: 0px;"> Sistema de Administración de Pedidos Personalizados</h4>
     
      
    </td>
  </tr>
</table>

<table style="background-color: white;width: 100%">
  <tr>
    <td style="border-bottom: 1px solid #eee;padding-top: 15px;padding-left: 15px;padding-left: 15px;padding-bottom: 15px">
      <h3 style="font-family:Roboto,sans-serif;margin-top: 0px;margin-bottom: 0px;">Proyecto: '.$proyecto.'</h3>
      <h3 style="font-family:Roboto,sans-serif;margin-top: 0px;margin-bottom: 0px;">Cantidad: '.$cantidad.'</h3>
      <br>
      <h3 style="font-family:Roboto,sans-serif;margin-top: 0px;margin-bottom: 0px;">Comentarios de autorización: '.$obs_autorizacion.'</h3>

      <hr>
      <br>

     
      <br>
      

        
      
    </td>
  </tr>
</table>


<table style="background-color: white;width: 100%;padding-left: 15px;padding-right: 15px;font-family:Roboto,sans-serif;padding-top: 15px;padding-bottom: 15px">
  <tr>
    <td style="background-color: #e5e5e5;padding-left: 15px;padding-right: 15px;padding-top: 15px;padding-bottom: 15px">
      <p style="font-size:11px;margin-top: 0px;margin-bottom: 0px;font-family:Roboto,sans-serif">Copyright (C) 2020. CALENDARIOS LEN. Todos los derechos reservados.</p>
      
    </td>
  </tr>
</table>
  
</div>


</body>
</html>

';
 
$message = (new Swift_Message(''.$mensaje.' #'.$pedido.' '))
  ->setFrom(['noreply@len.com.mx' => 'Fuera de Línea'])
 ->setTo(['ksanchez@len.com.mx', 'arios@len.com.mx', 'fueralinea@len.com.mx', $correo_cliente])
 //->setTo(['pruebas@len.com.mx', $correo_cliente])


  ->setBody($body)
  ->setContentType('text/html')
;
 
// Send the message
$mailer->send($message);



 ?>