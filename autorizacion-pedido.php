<?php

if (isset($_GET['pedido'])) {
    $pedido = $_GET['pedido'];
} else {
    $pedido = $_POST['pedido'];
}


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

    <style>
        .tcaja {
            background-color: #8076fd;
            color: #ffffff;
            margin-top: -15px;
            margin-bottom: 10px;
            padding-top: 5px;
            padding-left: 10px;
            padding-right: 10px;
            padding-bottom: 5px;
        }

        .tcaja>h5 {
            margin: 0px;
        }

        .link {
            color: blue;
            text-decoration: underline;
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


    if (isset($_POST['pedido'])) {

        $pedido = $_POST['pedido'];

        $proyecto = $_POST['proyecto'];
        $cantidad = $_POST['cantidad'];
        $autorizacion = $_POST['autorizacion'];
        $respuesta_autorizacion = $_POST['respuesta_autorizacion'];
        $obs_autorizacion = $_POST['obs_autorizacion'];
        $correo_cliente = $_POST['correo_cliente'];

            if($respuesta_autorizacion == "SI"){
            $sql2 = "UPDATE pedidos_fuera SET autorizacion='$fecha', respuesta_autorizacion = 'SI' , comentario_autorizacion = '$obs_autorizacion' WHERE id='$pedido'";
            if ($conn->query($sql2) === TRUE) {
                require_once 'notificacion-autorizado-pedido.php';
            }
        } else {
            $sql2 = "UPDATE pedidos_fuera SET  respuesta_autorizacion = 'NO', comentario_autorizacion = '$obs_autorizacion' WHERE id='$pedido'";
            if ($conn->query($sql2) === TRUE) {
                require_once 'notificacion-autorizado-pedido.php';
            }
        }
    }


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
    autorizacion,
    respuesta_autorizacion,
    comentario_autorizacion,
    status FROM pedidos_fuera WHERE id='$pedido' AND status='activo' LIMIT 1";

    $result4 = $conn->query($sql4);
    if ($result4->num_rows > 0) {
        while ($row = $result4->fetch_assoc()) {

            $correo_cliente = $row["correo_cliente"];
            $fecha_requerimiento = $row["fecha_requerimiento"];
            $fecha_requerimiento = date("d/m/Y", strtotime($fecha_requerimiento));
            $autoriza = $row["autoriza"];
            $tipo_cliente = $row["tipo_cliente"];
            $area = $row["area"];
            $proyecto = $row["proyecto"];
            $cantidad = $row["cantidad"];
            $autorizacion = $row["autorizacion"];
            $respuesta_autorizacion = $row["respuesta_autorizacion"];
            $comentario_autorizacion = $row["comentario_autorizacion"];
            $sustrato = $row["sustrato"];
            $tipo_impresion = $row["tipo_impresion"];
            $otro = $row["otro"];
            $acabado = $row["acabado"];
            $responsable_diseno = $row["responsable_diseno"];
            $archivo = $row["archivo"];
            $archivoSolo = explode("/", $archivo);

            $obs = $row["obs"];
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
            <form action="autorizacion-pedido" method="post">

                <input type="text" class="d-none" value="<?= $pedido ?>" id="pedido" name="pedido">
                <input type="text" class="d-none" value="<?= $proyecto ?>" id="proyecto" name="proyecto">
                <input type="text" class="d-none" value="<?= $cantidad ?>" id="cantidad" name="cantidad">
                <input type="text" class="d-none" value="<?= $autorizacion ?>" id="autorizacion" name="autorizacion">
                <input type="text" class="d-none" value="<?= $correo_cliente ?>" id="correo_cliente" name="correo_cliente">


                <div class="row">
                    <div class="col-sm-6 seccion">
                        <div class="row tcaja">
                            <h5>Requerimiento</h5>
                        </div>

                        <h5>Tipo de cliente: <span class="font-weight-bold"><?= $tipo_cliente ?></span></h5>
                        <h5>Área: <span class="font-weight-bold"><?= $area ?></span></h5>
                        <h5>Persona quien autoriza: <span class="font-weight-bold"><?= $autoriza ?></span></h5>
                        <h5>Fecha de requerimiento: <span class="font-weight-bold"><?= $fecha_requerimiento ?></span></h5>



                    </div>
                    <div class="col-sm-6 seccion">
                        <div class="row tcaja">
                            <h5>Diseño</h5>
                        </div>
                        <h5>Sustrato: <span class="font-weight-bold"><?= $sustrato ?></span></h5>
                        <h5>Tipo de impresión: <span class="font-weight-bold"><?= $tipo_impresion ?></span></h5>
                        <h5>Otro: <span class="font-weight-bold"><?= $otro ?></span></h5>
                        <h5>Acabado: <span class="font-weight-bold"><?= $acabado ?></span></h5>
                        <h5>Entrega de archivos: <span class="font-weight-bold"><?= $responsable_diseno ?></span></h5>
                        <h5>Observaciones: <span class="font-weight-bold"><?= $obs ?></span></h5>
                        <h5>Archivo de diseño: <span class="font-weight-bold link"><a target="_blank" href=" <?= $archivo ?>"><?= $archivoSolo[2] ?></a></span></h5>

                    </div>
                </div>


                <diw class="row">

                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <br>
                        <div class="alert alert-info">
                            <strong>¿Autoriza el pedido a producción?</strong>
                        </div>
                        <div class="row">
                            <?php
                            if ($autorizacion === "0000-00-00" && $respuesta_autorizacion  == "") {
                                echo '<div class="col-sm-6">
                            <label for=""><strong>Sí</strong></label>
                            <input type="radio" class="form-control" name="respuesta_autorizacion" value="SI" style="width:60px" required>
                        </div>
                        <div class="col-sm-6">
                            <label for=""><strong>No</strong></label>
                            <input type="radio" class="form-control" name="respuesta_autorizacion" value="NO" style="width:60px" required>
                        </div>

                        <div class="col-sm-12">
                            <br>
                            <label for=""><strong>Comentarios</strong></label>
<textarea name="obs_autorizacion" id="obs_autorizacion"  rows="5" class="form-control">' . $comentario_autorizacion . '</textarea>
                        </div>
                        </div>
                        
                        <div class="col-sm-12">
                            <br><br>
                            <p class="text-right"><button class="btn btn-primary" type="submit">Guardar</button></p>
                        </div>
';
                            } elseif ($autorizacion === "0000-00-00" && $respuesta_autorizacion  == "NO") {
                                echo '
                            
                            <div class="col-sm-6">
                            <label for=""><strong>Sí</strong></label>
                            <input type="radio" class="form-control" name="respuesta_autorizacion" value="SI" style="width:60px" disabled>
                        </div>
                        <div class="col-sm-6">
                            <label for=""><strong>No</strong></label>
                            <input type="radio" class="form-control" name="respuesta_autorizacion" value="NO" style="width:60px" checked>

                            <br>
                            <div class="alert alert-warning">
                                <strong>¡No se autorizo el pedido!</strong></a>.
                              </div>
                        </div>

                        <div class="col-sm-12">
                            <br>
                            <label for=""><strong>Comentarios</strong></label>
<textarea name="obs_autorizacion" id="obs_autorizacion"  rows="5" class="form-control">' . $comentario_autorizacion . '</textarea>
                        </div>
                        </div>
                        
                        


   ';
                            } elseif ($autorizacion != "0000-00-00" && $respuesta_autorizacion  == "SI") {
                                echo '<div class="col-sm-6">
                            <label for=""><strong>Sí</strong></label>
                            <input type="radio" class="form-control" name="respuesta_autorizacion" value="SI" style="width:60px" checked required>

                            <br>
                        <div class="alert alert-success">
                            <strong>¡Se autorizo correctamete!</strong></a>.
                          </div>
                        </div>
                        <div class="col-sm-6">
                            <label for=""><strong>No</strong></label>
                            <input type="radio" class="form-control" name="respuesta_autorizacion" value="NO" style="width:60px" disabled>
                        </div>
                        <div class="col-sm-12">
                            <br>
                            <label for=""><strong>Comentarios</strong></label>
<textarea name="obs_autorizacion" id="obs_autorizacion"  rows="5" class="form-control">' . $comentario_autorizacion . '</textarea>
                        </div>
                        </div>
                        
                      
                        
';
                            }

                            ?>



                        </div>
                        <div class="col-sm-3"></div>

                </diw>








            </form>
        </div>
    </div>

    </div>





    </div>
    </div>



</body>

</html>