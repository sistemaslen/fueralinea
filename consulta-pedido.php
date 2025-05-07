

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8' />
    <meta content='en' name='language' />


    <title>Consulta de pedidos | Fuera de línea</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="css/style4.css">
    <style type="text/css">
  .linkSimple{
    color: blue;
  }
      
    </style>

</head>

<body>

    <?php
    require_once 'conn.php';
    require_once 'menu.php';

    date_default_timezone_set('America/Mazatlan');
    $fecha = date("Y-m-d");
    $date = new DateTime($fecha);
    $week = $date->format("W");
    $periodo = date("Y");


if(isset($_GET['correo'])){
  $correo = $_GET['correo'];
} else {
  $correo='';
}


    ?>


<div class="col-sm-12 seccion">

    
        <div class="row">
          <div class="col-sm-1"></div>
        <div class="col-sm-10 seccion">
        <br><br>
        <h4>Consulta de pedidos</h4>
        <br>
        <form action="consulta-pedido" method="get">
        <div class="row">
          
        <div class="col-sm-4">
        <input type="email" class="form-control" placeholder="Escribe tu correo" name="correo" id="correo" required>
        </div>
        <div class="col-sm-2">
        <button class="btn btn-primary">Consultar</button>
        </div>
      
        </div>
        </form>
        <div class="row">
          <div class="col-sm-12">
            <br><br>
            <table class="table table-sm table-hover table-bordered">
<thead>
  <tr>
    <th>ID</th>
    <th></th>
    <th>Fecha</th>
    <th>Tipo de cliente</th>
    <th>Cliente</th>
    <th>Proyecto</th>
    <th>Cantidad</th>
    <th>Archivo</th>
    <th>Requerimiento</th>
    <th>Autorización</th>
    <th>Entrega</th>
    <th>Status</th>
    <th class="text-center">Solicitar envio</th>
  </tr>
</thead>
<tbody>

<?php

$sql8 = "SELECT id, fecha, tipo_cliente, cliente, area, proyecto, cantidad, sustrato, tipo_impresion, acabado, responsable_diseno, archivo, fecha_requerimiento, autorizacion,  inicio_proceso, fin_proceso, fecha_entrega, status  FROM pedidos_fuera WHERE correo_cliente='$correo' ORDER BY id DESC";

$result8 = $conn->query($sql8);
if ($result8->num_rows > 0) {
  $numeroRegistros = $result8->num_rows;
    while ($row = $result8->fetch_assoc()) {
        $id = $row["id"];
        $fecha = $row["fecha"];
        $fecha = date("d/m/Y", strtotime($fecha));
        $tipo_cliente = $row["tipo_cliente"];
        $cliente = $row["cliente"];
        $proyecto = $row["proyecto"];
        $cantidad = $row["cantidad"];
        $sustrato = $row["sustrato"];
        $tipo_impresion = $row["tipo_impresion"];
        $acabado = $row["acabado"];
        $responsable_diseno = $row["responsable_diseno"];
       
        $fecha_requerimiento = $row["fecha_requerimiento"];
        $fecha_requerimiento = date("d/m/Y", strtotime($fecha_requerimiento));

    
 $autorizacion = $row["autorizacion"];
        if($autorizacion == "0000-00-00"){
            $autorizacion = "";
        } else {
            $autorizacion = date("d/m/Y", strtotime($autorizacion));
        }
      

        $fecha_entrega = $row["fecha_entrega"];
        if($fecha_entrega == "0000-00-00"){
            $fecha_entrega = "";
        } else {
            $fecha_entrega = date("d/m/Y", strtotime($fecha_entrega));
        }

        $status = $row["status"];

 if($row["archivo"] !=""){
  $archivo = $row["archivo"];
  $archivoSolo = explode("/", $archivo);
  $archivoS = $archivoSolo[2];
 } else {
  $archivo = "#";
  $archivoS = "";
 }
        

if ($status == "terminado"){
  $btnEditar='<td></td>';
  $btnEnvio='<td class="text-center"><a href="https://lenpersonalizado.com/solicitud-transporte/" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-mail-forward"></i></a></td>';

} else {
  $btnEditar='<td class="text-center"><a type="button" class="btn btn-success btn-sm" href="editar-fuera?pedido='.$id.'"><i class="fa fa-pencil"></i></a></td>';
  $btnEnvio='<td></td>';
}

        
        echo '<tr>
        <th>'.$id.'</th>
        '.$btnEditar.'
        <td>'.$fecha.'</td>
        <td>'.$tipo_cliente.'</td>
        <td>'.$cliente.'</td>
        <td>'.$proyecto.'</td>
        <td>'.$cantidad.'</td>
        <td><a class="linkSimple" target="_blank" href="'.$archivo.'">'.$archivoS.'</a></td>
        <td>'.$fecha_requerimiento.'</td>
        <td>'.$autorizacion.'</td>
        <td>'.$fecha_entrega.'</td>
        <td>'.$status.'</td>
        '.$btnEnvio.'
      </tr>';
    }
}

?>


  <tr>
    <td></td>
  </tr>
</tbody>
            </table>
          </div>
        </div>
        </div>



        </div>
   



    </div>
    </div>

    <?php
   // require_once 'footer.php';
    ?>

    <script type="text/javascript">
        $(document).ready(function() {

$("#personaAutorizacion").change(function (e) { 
let correoAutoriza = $("#personaAutorizacion option:selected").attr('correo');
$("#correoAutoriza").val(correoAutoriza);
});


            $("#formPedido").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
          xhr: function() {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function(evt) {
              if (evt.lengthComputable) {
                var percentComplete = ((evt.loaded / evt.total) * 100);
                $(".progress-bar").width(percentComplete + '%');
                $(".progress-bar").html(percentComplete + '%');
              }
            }, false);
            return xhr;
          },
          type: 'POST',
          url: 'nuevo-pedido-guarda.php',
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function() {
            $(".progress-bar").width('0%');
            $(".progress").removeClass('d-none');
            $('.submitBtn').attr("disabled", "disabled");
            $("#txtgu").text("Por favor espere...");

          },
          success: function(response) {
            console.log(response);
            $(".statusMsg").html('');
            $("#formPedido").trigger("reset");
            $(".seccion").addClass('d-none');
            $(".statusMsg").html(`<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>¡Se guardo el pedido correctamente!</strong>
  </div><br> ${response}`);
            $(".submitBtn").removeAttr("disabled");
            $("#txtgu").text("Guardar el pedido");
            $(".progress").addClass('d-none');
            $(".submitBtn").addClass('d-none');

          }
        });
      });



      $("#fileToUpload").change(function() {
        var file = this.files[0];
        var fileType = file.type;
        var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg', 'application/x-zip-compressed'];
        if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]) || (fileType == match[6]))) {
          alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');
          $("#fileToUpload").val('');
          return false;
        }
      });

        });
    </script>



    



   
</body>

</html>