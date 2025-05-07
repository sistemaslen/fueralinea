<?php
$pedido = $_GET['pedido'];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8' />
    <meta content='en' name='language' />


    <title>Editar pedido #<?= $pedido ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="css/style4.css">
   

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


if(isset($_GET['pedido'])){

    $pedido = $_GET['pedido'];

    $sql4 = "SELECT id,
    tipo_cliente,
    cliente, 
    correo_cliente, 
    autoriza,
    correo_autoriza,
    area,
    proyecto,
    cantidad,
    sustrato,
    tipo_impresion,
    otro,
    acabado, 
    responsable_diseno,
    archivo,
    fecha_requerimiento,
    obs,
    folio,
    fecha_entrega,
    status FROM pedidos_fuera WHERE id='$pedido' AND status='activo' LIMIT 1";
    echo  $sql4;
    $result4 = $conn->query($sql4);
    if ($result4->num_rows > 0) {
        while($row = $result4->fetch_assoc()) {

         $tipo_cliente = $row["tipo_cliente"];
         $cliente = $row["cliente"];
         $correo_cliente = $row["correo_cliente"];
         $area = $row["area"];
         $autoriza = $row["autoriza"];
         $correo_autoriza = $row["correo_autoriza"];
         $proyecto = $row["proyecto"];
         $cantidad = $row["cantidad"];
         $sustrato = $row["sustrato"];

         $tipo_impresion = $row["tipo_impresion"];

         $otro = $row["otro"];
         $acabado = $row["acabado"];
         $responsable_diseno = $row["responsable_diseno"];
         $archivo = $row["archivo"];
         $fecha_requerimiento = $row["fecha_requerimiento"];
         $obs = $row["obs"];
         $status = $row["status"];
         $folio = $row["folio"];
         $fecha_entrega = $row["fecha_entrega"];
         
        }
    }


}

    ?>

<div class="col-sm-12 ">
<div class="container">
  <br>
  <br><br>
<div class="statusMsg"></div>
</div>
</div>
<div class="col-sm-12 seccion">
<div class="container">
    
        <!-- inicio de form -->
        <form id="formPedido" enctype="multipart/form-data">
        <div class="row">
        <div class="col-sm-12 seccion">
        <br><br>
        <h4>Editar pedido #<?= $pedido ?></h4>
        <br>
            <p>Solicitud de trabajos fuera de línea</p>

            <div class="row">

            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <br>
                <label for="">Tipo de cliente <span class="opcionObligatorio">*</span></label>
                <input type="text" class="d-none" id="numeroPedido" name="numeroPedido" value="<?= $pedido ?>">
                <select name="tipoCliente" id="tipoCliente" class="form-control" required>
                 
                    <option value="<?= $tipo_cliente ?>"><?= $tipo_cliente ?></option>
                    <option value="Interno">Interno</option>
                    <option value="Externo">Externo</option>
                </select>

                <br>
                <label for="">Cliente <span class="opcionObligatorio">*</span></label>
                <input type="text" class="form-control" id="cliente" name="cliente" value="<?= $cliente ?>" required>
                <br>
                <label for="">Correo <span class="opcionObligatorio">*</span></label>
                <h5><?= $correo_cliente ?></h5>
                <input type="email" class="form-control d-none" id="correo_cliente" name="correo_cliente"  value="<?= $correo_cliente ?>">
                <br>
                    <label for="">Área <span class="opcionObligatorio">*</span></label>
                    <select name="area" id="area" class="form-control" required>
                    <option value="<?= $area ?>"><?= $area ?></option>

                        <option value="Recursos humanos">Recursos humanos</option>
                        <option value="Comercial">Comercial</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Diseño">Diseño</option>
                        <option value="Externo">Externo</option>

                    </select>

                    <br>
                    <label for="">Persona quien autoriza<span class="opcionObligatorio">*</span></label>
                    <select name="personaAutorizacion" id="personaAutorizacion" class="form-control" required>
                    <option value="<?= $autoriza ?>"><?= $autoriza ?></option>

                        <?php
   $sql = "SELECT * FROM users WHERE tipo_rol = 'Administrador' AND rol_fuera_linea = 'Administrador' AND status = 'activo' ORDER BY nombre ASC";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
       echo "<option correo='".$row["email"]."' value='".$row["nombre"]." ".$row["a_paterno"]."'>".$row["nombre"]." ".$row["a_paterno"]."</option>";
     }
   } else {
     echo "0 results";
   }

                        ?>

                    </select>
                    <br>
                <label for="">Correo autoriza <span class="opcionObligatorio">*</span></label>
                <input type="email" class="form-control" id="correoAutoriza" name="correoAutoriza" required value="<?= $correo_autoriza ?>">

            </div>
            <div class="col-sm-3"></div>
            </div>
        </div>

        </div>
<div class="row">
        <div class="col-sm-12 seccion">
            <h4>Datos del proyecto</h4>
            <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <label for="">Proyecto <span class="opcionObligatorio">*</span></label>
                <input type="text" class="form-control" id="proyecto" name="proyecto" required value="<?= $proyecto ?>">
                <br>
                <label for="">Cantidad <span class="opcionObligatorio">*</span></label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" required value="<?= $cantidad ?>">
            </div>

            </div>
        </div>
        </div>
        <div class="row">
        <div class="col-sm-12 seccion">
            <h4>Tipo de impresión</h4>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                
                <br>
                <label for="">Sustrato <span class="opcionObligatorio">*</span></label>
                <input type="text" class="form-control" id="sustrato" name="sustrato" required value="<?= $sustrato ?>">
             <br>
            <div class="row">
                    <div class="col-sm-2 ">
    <label for="">Offset</label>
    <input type="checkbox" class="form-control" name="tipo_impresion[]" value="Offset" <?php if(strpos($tipo_impresion, 'Offset') !== false) echo 'checked'; ?>>
</div>
<div class="col-sm-2 ">
    <label for="">Digital</label>
    <input type="checkbox" class="form-control" name="tipo_impresion[]" value="Digital" <?php if(strpos($tipo_impresion, 'Digital') !== false) echo 'checked'; ?>>
</div>
<div class="col-sm-2 ">
    <label for="">G.F.</label>
    <input type="checkbox" class="form-control" name="tipo_impresion[]" value="G.F." <?php if(strpos($tipo_impresion, 'G.F.') !== false) echo 'checked'; ?>>
</div>
<div class="col-sm-2 ">
    <label for="">1 Tinta</label>
    <input type="checkbox" class="form-control" name="tipo_impresion[]" value="1 Tinta" <?php if(strpos($tipo_impresion, '1 Tinta') !== false) echo 'checked'; ?>>
</div>
<div class="col-sm-2 ">
    <label for="">2 Tintas</label>
    <input type="checkbox" class="form-control" name="tipo_impresion[]" value="2 Tintas" <?php if(strpos($tipo_impresion, '2 Tintas') !== false) echo 'checked'; ?>>
</div>
<div class="col-sm-2 ">
    <label for="">Color</label>
    <input type="checkbox" class="form-control" name="tipo_impresion[]" value="Color" <?php if(strpos($tipo_impresion, 'Color') !== false) echo 'checked'; ?>>
</div>

                    </div>
                        <br>
                        <label for="">Otro</label>
                        <input type="text" class="form-control" id="nombre" name="otro" value="<?= $otro ?>">
                 
<br>
                    <label for="">Acabados <span class="opcionObligatorio">*</span></label>
                    <textarea name="acabado" id="acabado"  rows="5" class="form-control" required><?= $acabado ?></textarea>
                    

                    <br>
<label for="">Responsable de la entrega de archivos <span class="opcionObligatorio">*</span></label>
                    <select name="disenoResposanble" id="disenoResposanble" class="form-control" required>
                        <option value="<?= $responsable_diseno ?>"><?= $responsable_diseno ?></option>
                        <option value="Nancy Rosas">Nancy Rosas</option>
                        <option value="Javier Alonso">Javier Alonso</option>
                        <option value="Silvia de Jesus">Silvia de Jesus</option>
                        <option value="Mario Amador">Mario Amador</option>
                    </select>

                    <br>
                    <label for="">Adjuntar archivo</label>
                   
                    <?php
                    if($archivo !=''){
echo '<br><a class="btn btn-link" target="_blank" href="'.$archivo.'">'.$archivo.'</a>';
                    }
                    ?>
                    
                    <input type="file" class="form-control" id="fileToUpload" name="fileToUpload">
                    <br>
                    <label for="">Fecha en que se requiere <span class="opcionObligatorio">*</span></label>
                    <input type="date" class="form-control" id="fechaRequerimiento" name="fechaRequerimiento" required value="<?= $fecha_requerimiento ?>">
                    <br>

    <label for="">Observaciones</label>
    <textarea name="obs" id="obs" rows="5" class="form-control"><?= $obs ?></textarea>
    <br>


    <div class="col-sm-12">

<div class="progress d-none">
  <div class="progress-bar"></div>
</div>

<div class="form-group" style="margin-top: 15px;text-align:right">
  <button class="btn btn-warning submitBtn" type="submit">
      <span id="txtgu">Guardar el pedido</span>
  </button>
</div>
</div>


                </div>
                </div>



        </div>
        </div>
        </form>
<!-- fin de form -->

    </div>
    </div>

    </div>





    </div>
    </div>


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
          url: 'editar-fuera-linea-guarda.php',
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
            $(".statusMsg").html('<h4>Pedido guardado exitosamente!</h4><br>' + response);
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