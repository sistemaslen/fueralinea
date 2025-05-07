

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8' />
    <meta content='en' name='language' />


    <title>Nuevo pedido | fuera de línea</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>


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



    ?>




<div class="col-sm-12 ">
<div class="container">
  <br>
  <br>
  <br>
  <br>
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
        <h4>Nuevo pedido fuera de línea</h4>
        <br>
            <p>Solicitud de trabajos fuera de línea</p>

            <div class="row">

            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <br>
                <label for="">Tipo de cliente <span class="opcionObligatorio">*</span></label>
                <select name="tipoCliente" id="tipoCliente" class="form-control" required>
                    <option value="">Seleccionar</option>
                    <option value="Interno">Interno</option>
                    <option value="Externo">Externo</option>
                </select>

                <br>
                <label for="">Cliente <span class="opcionObligatorio">*</span></label>
                <input type="text" class="form-control" id="cliente" name="cliente" required>
                <br>
                <label for="">Correo <span class="opcionObligatorio">*</span></label>
                <input type="email" class="form-control" id="correo_cliente" name="correo_cliente" required>
                <br>
                    <label for="">Área <span class="opcionObligatorio">*</span></label>
                    <select name="areaResponsable" id="areaResponsable" class="form-control" required>
                        <option value="">Seleccionar</option>
                        <option value="ACABADO">ACABADO</option>
                        <option value="ARTE, DISEÑO Y CREATIVIDAD">ARTE, DISEÑO Y CREATIVIDAD</option>
                        <option value="CONTABILIDAD">CONTABILIDAD</option>
                        <option value="DESARROLLO DE NEGOCIOS">DESARROLLO DE NEGOCIOS</option>
                        <option value="MERCADOTECNIA Y COMUNICACIÓN">MERCADOTECNIA Y COMUNICACIÓN</option>
                        <option value="OPERACIONES">OPERACIONES</option>
                        <option value="PRESIDENCIA">PRESIDENCIA</option>
                        <option value="PRODUCCIÓN">PRODUCCIÓN</option>
                        <option value="GRAN FORMATO">GRAN FORMATO</option>
                        <option value="DESARROLLO DE RECURSOS HUMANOS">DESARROLLO DE RECURSOS HUMANOS</option>
                        <option value="EXTERNO">EXTERNO</option>

                    </select>

                    <br>
                    <label for="">Persona quien autoriza<span class="opcionObligatorio">*</span></label>
                    <select name="personaAutorizacion" id="personaAutorizacion" class="form-control" required>
                        <option value="">Seleccionar</option>

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
                <label for="">Correo Autoriza <span class="opcionObligatorio">*</span></label>
                <input type="email" class="form-control" id="correoAutoriza" name="correoAutoriza" required>

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
                <input type="text" class="form-control" id="proyecto" name="proyecto" required>
                <br>
                <label for="">Cantidad <span class="opcionObligatorio">*</span></label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" required>
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
                <input type="text" class="form-control" id="sustrato" name="sustrato" required>
             <br>
            <div class="row">
                    <div class="col-sm-2 ">
                        <label for="">Offset</label>
                        <input type="checkbox" class="form-control" name="tipo_impresion[]"  value="Offset">
                    </div>
                    <div class="col-sm-2 ">
                        <label for="">Digital</label>
                        <input type="checkbox" class="form-control" name="tipo_impresion[]" value="Digital">
                    </div>
                    <div class="col-sm-2 ">
                        <label for="">G.F.</label>
                        <input type="checkbox" class="form-control" name="tipo_impresion[]" value="G.F.">
                    </div>
                    <div class="col-sm-2 ">
                        <label for="">1 Tinta</label>
                        <input type="checkbox" class="form-control" name="tipo_impresion[]" value="1 Tinta">
                    </div>
                    <div class="col-sm-2 ">
                        <label for="">2 Tintas</label>
                        <input type="checkbox" class="form-control" name="tipo_impresion[]" value="2 Tintas">
                    </div>
                    <div class="col-sm-2 ">
                        <label for="">Color</label>
                        <input type="checkbox" class="form-control" name="tipo_impresion[]" value="Color">
                    </div>

                    </div>
                        <br>
                        <label for="">Otro</label>
                        <input type="text" class="form-control" id="nombre" name="otro">
                 
<br>
                    <label for="">Acabados <span class="opcionObligatorio">*</span></label>
                    <textarea name="acabado" id="acabado"  rows="5" class="form-control" required></textarea>
                    

                    <br>
<label for="">Responsable de la entrega de archivos <span class="opcionObligatorio">*</span></label>
                    <select name="disenoResposanble" id="disenoResposanble" class="form-control" required>
                        <option value="">Seleccionar</option>
                        <option value="Nancy Rosas">Nancy Rosas</option>
                        <option value="Javier Alonso">Javier Alonso</option>
                        <option value="Silvia de Jesus">Silvia de Jesus</option>
                        <option value="Mario Amador">Mario Amador</option>
                        <option value="Eduardo Iturbide">Eduardo Iturbide</option>
                    </select>

                    <br>
                    <label for="">Adjuntar archivo</label>
                    <input type="file" class="form-control" id="fileToUpload" name="fileToUpload">
                    <br>
                    <label for="">Fecha en que se requiere <span class="opcionObligatorio">*</span></label>
                    <input type="date" class="form-control" id="fechaRequerimiento" name="fechaRequerimiento" required>
                    <br>

    <label for="">Observaciones</label>
    <textarea name="obs" id="obs" rows="5" class="form-control"></textarea>
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