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
$telefono = $_POST['telefono'];
$genero = $_POST['genero'];
$contraseña = $_POST['contraseña'];

$sql = "UPDATE admi SET 
            documento = ?,
            primer_nombre = ?, 
            segundo_nombre = ?, 
            primer_apellido = ?, 
            segundo_apellido = ?, 
            correo = ?, 
            fecha_nacimiento = ?, 
            celular = ?, 
            genero = ?, 
            contrasena = ? 
        WHERE id = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("sssssssssss", 
    $documento, 
    $primer_nombre, 
    $segundo_nombre, 
    $primer_apellido, 
    $segundo_apellido, 
    $correo, 
    $fecha_nacimiento, 
    $telefono, 
    $genero, 
    $contraseña, 
    $id
);


$resultado = $stmt->execute();
if ($resultado) {
    $mensaje = "REGISTRO MODIFICADO";
} else {
    $mensaje = "ERROR AL MODIFICAR";
}

$stmt->close();
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
                    <h3><?php echo $mensaje; ?></h3>
                    <a href="Cliente.php" class="btn btn-primary">Regresar</a>
                </div>
            </div>
        </div>
    </body>
</html>
