<?php
require 'conexion.php';

function calcularEdad($fecha_nacimiento) {
    $hoy = new DateTime();
    $fecha_nacimiento = new DateTime($fecha_nacimiento);
    $edad = $hoy->diff($fecha_nacimiento)->y;
    return $edad;
}

$documento = $_POST['documento'];
$primer_nombre = $_POST['primer_nombre'];
$segundo_nombre = $_POST['segundo_nombre'];
$primer_apellido = $_POST['primer_apellido'];
$segundo_apellido = $_POST['segundo_apellido'];
$correo = $_POST['correo'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$celular = $_POST['celular'];
$genero = $_POST['genero'];
$contrasena = $_POST['contrasena'];
$saldo = $_POST['saldo'];

try {
    if (calcularEdad($fecha_nacimiento) < 18) {
        throw new Exception("Debes ser mayor de 18 años para registrarte.");
    }

    $sql = "INSERT INTO admi (documento, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, correo, fecha_nacimiento, celular, genero, contrasena, saldo) 
            VALUES ('$documento', '$primer_nombre', '$segundo_nombre', '$primer_apellido', '$segundo_apellido', '$correo', '$fecha_nacimiento', '$celular', '$genero', '$contrasena', '$saldo')";
    
    $resultado = $mysqli->query($sql);

    if (!$resultado) {
        throw new Exception($mysqli->error);
    }
    echo '<h3 class="text-center mt-3">Usuario creado correctamente</h3>';
    $mensaje = "REGISTRO GUARDADO";
} catch (Exception $e) {
    $mensaje = "ERROR AL GUARDAR: " . $e->getMessage();
}
?>

<html lang="es">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="row" style="text-align:center">
                    <a href="index.php" class="btn btn-primary" id="btnRegresar" <?php echo (isset($resultado) && $resultado) ? '' : 'style="display: none;"'; ?>>Regresar</a>

                    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger">
                                        <strong>Error:</strong> <?php echo $e->getMessage(); ?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="mostrarRegresar()">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if (isset($e)) { ?>
                        <script>
                            $(document).ready(function(){
                                $('#errorModal').modal('show');
                            });

                            function mostrarRegresar() {
                                $('#btnRegresar').show();
                            }
                        </script>
                    <?php } 
                    else { ?>
                        <h3><?php echo $mensaje; ?></h3>
                    <?php } ?>
                </div>
            </div>
        </div>
    </body>
</html>
