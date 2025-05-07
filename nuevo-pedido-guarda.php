<?php

require_once 'conn.php';

$tipoCliente = $_POST["tipoCliente"];
$tipoCliente= str_replace("'", "´", $tipoCliente);

$cliente = $_POST["cliente"];
$cliente= str_replace("'", "´", $cliente);

$correo_cliente = $_POST["correo_cliente"];
$correo_cliente= str_replace("'", "´", $correo_cliente);

$personaAutorizacion = $_POST["personaAutorizacion"];
$personaAutorizacion= str_replace("'", "´", $personaAutorizacion);

$correoAutoriza = $_POST["correoAutoriza"];
$correoAutoriza= str_replace("'", "´", $correoAutoriza);

$proyecto = $_POST["proyecto"];
$proyecto= str_replace("'", "´", $proyecto);

$cantidad = $_POST["cantidad"];
$cantidad= str_replace("'", "´", $cantidad);

$sustrato = $_POST["sustrato"];
$sustrato= str_replace("'", "´", $sustrato);

$acabado = $_POST["acabado"];
$acabado= str_replace("'", "´", $acabado);

$disenoResposanble = $_POST["disenoResposanble"];
$disenoResposanble= str_replace("'", "´", $disenoResposanble);

$areaResponsable = $_POST["areaResponsable"];
$areaResponsable= str_replace("'", "´", $areaResponsable);

$tipo_impresion = isset($_POST['tipo_impresion']) ? implode(', ', $_POST['tipo_impresion']) : '';

$otro = $_POST["otro"];
$otro= str_replace("'", "´", $otro);

$fechaRequerimiento = $_POST["fechaRequerimiento"];
$fechaRequerimiento= str_replace("'", "´", $fechaRequerimiento);

$obs = $_POST["obs"];
$obs= str_replace("'", "´", $obs);


if(isset($_POST["tipoCliente"]) && isset($_POST["cliente"]) && isset($_POST["proyecto"]) && isset($_POST["cantidad"])){
/*------------Insertar pedidos--------*/

$query2 = "INSERT INTO pedidos_fuera (tipo_cliente, cliente, correo_cliente, area, proyecto, cantidad, sustrato, tipo_impresion, otro, acabado, responsable_diseno, fecha_requerimiento, obs, status, autoriza, correo_autoriza)
  VALUES ('$tipoCliente', '$cliente', '$correo_cliente', '$areaResponsable', '$proyecto', '$cantidad', '$sustrato', '$tipo_impresion', '$otro','$acabado', '$disenoResposanble', '$fechaRequerimiento', '$obs', 'activo', '$personaAutorizacion', '$correoAutoriza' )";
 if ($conn->query($query2) === TRUE) {
}



if ($result = $conn->query("SELECT id FROM pedidos_fuera")) {
  $row_cnt = $result->num_rows;
  $num_pedido = $row_cnt;
  $result->close();
}

$adjunto_archivo = basename($_FILES["fileToUpload"]["name"]);

if(isset($_FILES["fileToUpload"]["name"])){

//subir archivo
/*------archivo adjunto------*/
$rutaArchivo = 'uploads/fuera/';
$adjunto_archivo = basename($_FILES["fileToUpload"]["name"]);
$adjunto_archivo = str_replace("'", "", $adjunto_archivo);

$adjuntoname = explode(".", $adjunto_archivo);
$adjuntoname[0] = $num_pedido.'-'.$proyecto;

$target_file_archivo = "";

if ($adjunto_archivo==="") {

} else {

$temp = str_replace("'", "", $adjunto_archivo);
$temp = explode(".", $temp);
$adjunto_archivo = round(microtime(true)) . '.' . end($temp);
$adjunto_archivo = $adjuntoname[0].$adjunto_archivo;

$target_dir = $rutaArchivo;

$target_file_archivo = $target_dir . $adjunto_archivo;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file_archivo,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
         $response= 'File is an image - ' . $check["mime"] . '.';
        $uploadOk = 1;
    } else {
         $response= 'File is not an image.';
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 200097152) {
     $response= 'Lo sentimos, su archivo es muy pesado , maximo 20 mb.';
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "zip" && $imageFileType != "pdf" ) {
     $response= 'Lo sentimos, su formato de archivo no se acepta , eliga JPG, JPEG, PNG, ZIP, PDF .';
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
     $response= 'Lo sentimos, su archivo no ha sido enviado.';
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file_archivo)) {
       
       $response= 'Tu archivo '. $adjunto_archivo. ' se guardo correctamente!';
      
    } else {
         $response= 'Lo sentimos, ha sucedido un error en la carga de archivo.';
    }
}
$target_file_archivo = 'uploads/fuera/'.$adjunto_archivo;



$sql89 = "UPDATE pedidos_fuera SET  archivo='$target_file_archivo' WHERE id='$num_pedido'";
if ($conn->query($sql89) === TRUE) {

}

}


}


if(isset($adjunto_archivo) && $adjunto_archivo !=""){
    include 'notificacion-autorizacion.php';
}

include 'notificacion-nuevo-pedido.php';

}

?>