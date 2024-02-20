<?php
    require 'conexion.php';

    $id = $_POST['id'];
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

    $sql = "UPDATE admi SET 
                documento='$documento',
                primer_nombre='$primer_nombre', 
                segundo_nombre='$segundo_nombre', 
                primer_apellido='$primer_apellido', 
                segundo_apellido='$segundo_apellido', 
                correo='$correo', 
                fecha_nacimiento='$fecha_nacimiento', 
                celular='$celular', 
                genero='$genero', 
                contrasena='$contrasena', 
                saldo='$saldo' 
            WHERE id = '$id'";

    $resultado = $mysqli->query($sql);
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
                    <?php if($resultado) { ?>
                        <h3>REGISTRO MODIFICADO</h3>
                    <?php } else { ?>
                        <h3>ERROR AL MODIFICAR</h3>
                    <?php } ?>
                    
                    <a href="index.php" class="btn btn-primary">Regresar</a>
                </div>
            </div>
        </div>
    </body>
</html>
