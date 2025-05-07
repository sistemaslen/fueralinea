<?php 



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
      <h2 style="margin-top: 0px;margin-bottom: 0px;text-align:center;font-family:Roboto,sans-serif;margin-top: 0px;margin-bottom: 0px;">Autorizar pedido #'.$num_pedido.'</h2>
      <h4 style="font-family:Roboto,sans-serif;text-align:center;color:gray;margin-top: 0px;margin-bottom: 0px;"> Sistema de Administración de Pedidos Personalizados</h4>
     
      
    </td>
  </tr>
</table>

<table style="background-color: white;width: 100%">
  <tr>
    <td style="border-bottom: 1px solid #eee;padding-top: 15px;padding-left: 15px;padding-left: 15px;padding-bottom: 15px">
      <h3 style="font-family:Roboto,sans-serif;margin-top: 0px;margin-bottom: 0px;">Proyecto: '.$proyecto.'</h3>
      <h3 style="font-family:Roboto,sans-serif;margin-top: 0px;margin-bottom: 0px;">Cantidad: '.$cantidad.'</h3>
      <hr>
      <br>

      <h4 style="font-family:Roboto,sans-serif;margin-top: 0px;margin-bottom: 0px;">Tipo de cliente: '.$tipoCliente.'</h4>
      <h4 style="font-family:Roboto,sans-serif;margin-top: 0px;margin-bottom: 0px;">Área: '.$areaResponsable.'</h4>
      <h4 style="font-family:Roboto,sans-serif;margin-top: 0px;margin-bottom: 0px;">Persona quien autoriza: '.$personaAutorizacion.'</h4>
      <h4 style="font-family:Roboto,sans-serif;margin-top: 0px;margin-bottom: 0px;">Sustrato: '.$sustrato.'</h4>
      <h4 style="font-family:Roboto,sans-serif;margin-top: 0px;margin-bottom: 0px;">Tipo de impresión: '.$tipo_impresion.'</h4>
      <h4 style="font-family:Roboto,sans-serif;margin-top: 0px;margin-bottom: 0px;">Otro: '.$otro.'</h4>
      <h4 style="font-family:Roboto,sans-serif;margin-top: 0px;margin-bottom: 0px;">Acabado: '.$acabado.'</h4>
      <h4 style="font-family:Roboto,sans-serif;margin-top: 0px;margin-bottom: 0px;">Entrega de archivos: '.$disenoResposanble.'</h4>
      <h4 style="font-family:Roboto,sans-serif;margin-top: 0px;margin-bottom: 0px;">Fecha de requerimiento: '.$fechaRequerimiento.'</h4>
      
      <h4 style="font-family:Roboto,sans-serif;margin-top: 0px;margin-bottom: 0px;">Archivo de diseño: <a href="https://lenpersonalizado.com/fueralinea/'.$target_file_archivo.'" style="color:blue">Archivo</a></h4>


      <h4 style="font-family:Roboto,sans-serif;margin-top: 0px;margin-bottom: 0px;">Observaciones: '.$obs.'</h4>
      <hr>
      <br>
      <h4 style="font-family:Roboto,sans-serif;margin-top: 0px;margin-bottom: 0px;">Entrar a la siguiente ruta para autorizar pedido: <a href="https://lenpersonalizado.com/fueralinea/autorizacion-pedido?pedido='.$num_pedido.'" style="color:blue">Link</a></h4>

        
      
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
 
$message = (new Swift_Message('Autorización de pedido fuera de línea #'.$num_pedido.' '))
  ->setFrom(['noreply@len.com.mx' => 'Fuera de Línea'])
 ->setTo(['fueralinea@len.com.mx',$correo_cliente])
 ->setCc([$correoAutoriza])

  ->setBody($body)
  ->setContentType('text/html')
;
 
// Send the message
$mailer->send($message);



 ?>