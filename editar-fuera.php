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


  if (isset($_GET['pedido'])) {

    $pedido = $_GET['pedido'];

    $sql4 = "SELECT id, tipo_cliente, solicitante, correo_solicitante, autoriza, correo_autoriza, departamento, area, proyecto, cantidad, sustrato, materiales, tipo_impresion, tintas_impresion, otro, acabado, responsable_diseno, archivo, fecha_requerimiento, obs, folio, fecha_entrega, status FROM pedidos_fuera WHERE id='$pedido' LIMIT 1";

    $result4 = $conn->query($sql4);
    if ($result4->num_rows > 0) {
      while ($row = $result4->fetch_assoc()) {

        $tipo_cliente = $row["tipo_cliente"];
        $solicitante = $row["solicitante"];
        $correo_solicitante = $row["correo_solicitante"];
        $area = $row["area"];
        $departamento = $row["departamento"];
        $autoriza = $row["autoriza"];
        $correo_autoriza = $row["correo_autoriza"];
        $proyecto = $row["proyecto"];
        $cantidad = $row["cantidad"];
        $sustrato = $row["sustrato"];

        $tipo_impresion = $row["tipo_impresion"];
        $materiales = $row["materiales"];
        $tintas_impresion = $row["tintas_impresion"];

        $otro = $row["otro"];
        $acabado = $row["acabado"];
        $responsable_diseno = $row["responsable_diseno"];
        $archivo = $row["archivo"];
        $archivoSolo = explode("/", $archivo);
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
            <br>
            <h4>Editar pedido #<?= $pedido ?></h4>
            <br>
            <p>Solicitud de trabajos fuera de línea</p>
            <br>
            <br>
            <div class="row ">
              <div class="col-sm-2">
                <p class="text-center"><strong>Solicitud elaborada</strong></p>
                <div class="progress" style="height:30px">
                  <div class="progress-bar" style="width:100%;height:30px">
                  </div>
                </div>

                <p class="text-center">27/04/2025</p>
              </div>
              <div class="col-sm-2">
                <p class="text-center"><strong>Autorización</strong></p>
                <br>
                <div class="progress" style="height:30px">
                  <div class="progress-bar" style="width:100%;height:30px">
                  </div>
                </div>

                <p class="text-center">27/04/2025</p>
              </div>
              <div class="col-sm-2">
                <p class="text-center"><strong>Orden de producción</strong></p>
                <div class="progress" style="height:30px">
                  <div class="progress-bar" style="width:100%;height:30px">
                  </div>
                </div>

                <p class="text-center">27/04/2025</p>
              </div>
              <div class="col-sm-4">
                <p class="text-center"><strong>Producción</strong></p>
                <br>
                <div class="progress" style="height:30px">
                  <div class="progress-bar" style="width:100%;height:30px">
                  </div>
                </div>

                <p class="text-center">27/04/2025</p>
              </div>
              <div class="col-sm-2">
                <p class="text-center"><strong>Terminado</strong></p>
                <br>
                <div class="progress" style="height:30px">
                  <div class="progress-bar" style="width:100%;height:30px">
                  </div>
                </div>

                <p class="text-center">27/04/2025</p>
              </div>

            </div>
            <div class="row">

              <div class="col-sm-1"></div>
              <div class="col-sm-10">
                <br>
                <br>

                <div class="row">
                  <div class="col-sm-3">
                    <label for="">Orden de producción</label>
                    <input type="number" class="form-control" id="ordenProduccion" name="ordenProduccion" value="<?= $folio ?>" readonly>
                  </div>
                  <div class="col-sm-3">

                    <label for="">Fecha en que se requiere</label>
                    <input type="date" class="form-control" id="fechaRequerimiento" name="fechaRequerimiento" required value="<?= $fecha_requerimiento ?>">
                  </div>
                  <div class="col-sm-3">
                    <label for="">Fecha de entrega</label>
                    <input type="date" class="form-control" id="fechaEntrega" name="fechaEntrega" required value="<?= $fecha_requerimiento ?>">

                  </div>
                  <div class="col-sm-3">

                    <label for="">Status</label>
                    <input type="text" class="form-control" id="status" name="status" value="<?= $status ?>" readonly>

                  </div>
                </div>

                <br>
                <label for="">Área <span class="opcionObligatorio">*</span></label>
                <select name="areaResponsable" id="areaResponsable" class="form-control" required>
                  <option value="<?= $area ?>"><?= $area ?></option>
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

                <label for="clienteExterno">Cliente externo <span class="opcionObligatorio">*</span></label>
                <input type="text" class="form-control" id="clienteExterno" name="clienteExterno" placeholder="Cliente externo" required>

                <br>
                <label for="departamento">Departamento <span class="opcionObligatorio">*</span></label>
                <select name="departamento" id="departamento" class="form-control">
                  <option value="<?= $departamento ?>"><?= $departamento ?></option>
                </select>
                <br>
                <label for="personaAutoriza">Persona quien autoriza <span class="opcionObligatorio">*</span></label>
                <select name="personaAutoriza" id="personaAutoriza" class="form-control">
                  <option value="<?= $autoriza ?>"><?= $autoriza ?></option>
                </select>

                <br>
                <label for="correoAutoriza">Correo autoriza <span class="opcionObligatorio">*</span></label>
                <input type="email" class="form-control" id="correoAutoriza" name="correoAutoriza" placeholder="Correo autoriza" value="<?= $correo_autoriza ?>">
                <br>
                <label for="solicitante">Solicitante <span class="opcionObligatorio">*</span></label>
                <input type="text" class="form-control" id="solicitante" name="solicitante" placeholder="Solicitante" value="<?= $solicitante ?>">
                <br>
                <label for="correoSolicitante">Correo solicitante <span class="opcionObligatorio">*</span></label>
                <input type="email" class="form-control" id="correoSolicitante" name="correoSolicitante" placeholder="Solicitante" value="<?= $correo_solicitante ?>">
                <br>

              </div>
              <div class="col-sm-3"></div>
            </div>
          </div>

        </div>
        <div class="row">
          <div class="col-sm-12 seccion">
            <h4>Datos del proyecto</h4>
            <br>
            <div class="row">
              <div class="col-sm-2">
              </div>
              <div class="col-sm-4">
                <label for="">Proyecto <span class="opcionObligatorio">*</span></label>
                <input type="text" class="form-control" id="proyecto" name="proyecto" required value="<?= $proyecto ?>">
              </div>
              <div class="col-sm-4">

                <label for="">Cantidad <span class="opcionObligatorio">*</span></label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" required value="<?= $cantidad ?>">
              </div>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 seccion">
            <h4>Indicaciones para producción</h4>
            <div class="row">
              <div class="col-sm-3"></div>
              <div class="col-sm-6">

                <br>
                <label for="">Materiales</label>
                <input type="text" class="form-control" id="materiales" name="materiales" value="<?= $materiales ?>">
                <br>
                <label for="">Tintas de impresión</label>
                <input type="text" class="form-control" id="tintasImpresion" name="tintasImpresion" value="<?= $tintas_impresion ?>">
                <br>
                <label for="">Tipos de impresión</label>
                <input type="text" class="form-control" id="tiposImpresion" name="tiposImpresion" value="<?= $tipo_impresion ?>">
                <br>
                <label for="">Acabados <span class="opcionObligatorio">*</span></label>
                <textarea class="form-control" name="acabados" id="acabados" rows="5" required><?= $acabado ?></textarea>
                <br>
                <label for="">Adjuntar archivo</label>
                <br>
                <a href="<?= $archivo ?>" target="_blank" class="btn btn-primary btn-sm"><?= $archivoSolo[2] ?></a>
                <br>
                <br>
                <input type="file" class="form-control" id="fileToUpload" name="fileToUpload">
                <br>

                <label for="">Observaciones</label>
                <textarea name="obs" id="obs" rows="5" class="form-control"></textarea>
                <br>
                <label for="">Entregar a:</label>
                <select name="entregar" id="entregar" class="form-control">
                  <option value="">Seleccionar</option>
                </select>

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


      $("#personaAutorizacion").change(function(e) {
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