<?php

require 'conexion.php';

function limpiarEntrada($entrada) {
    global $mysqli;
    return mysqli_real_escape_string($mysqli, $entrada);
}

function obtenerSaldo($idCuenta) {
    global $mysqli;

    $sql = "SELECT saldo FROM admi WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $idCuenta);
    $stmt->execute();
    $stmt->bind_result($saldo);
    $stmt->fetch();
    $stmt->close();

    return $saldo;
}

function consignarSaldo($idCuenta, $monto) {
    global $mysqli;

    $sql = "UPDATE admi SET saldo = saldo + ? WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("di", $monto, $idCuenta);
    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        return false;
    }
}

session_start();

if (!isset($_SESSION["usuario"]) || !isset($_SESSION["id_usuario"])) {
    header("Location: ../logueo.php");
    exit;
}

$idCliente = $_SESSION["id_usuario"];
$nuevoSaldo = obtenerSaldo($idCliente); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $montoConsignacion = limpiarEntrada($_POST["monto"]);

    if (!empty($montoConsignacion) && is_numeric($montoConsignacion) && $montoConsignacion > 0) {
        if (consignarSaldo($idCliente, $montoConsignacion)) {
            $nuevoSaldo = obtenerSaldo($idCliente); 
            $mensaje = "Consignación exitosa.";
            $claseMensaje = "alert-success";
        } else {
            $mensaje = "Error al consignar saldo.";
            $claseMensaje = "alert-danger";
        }
    } else {
        $mensaje = "El monto ingresado no es válido.";
        $claseMensaje = "alert-warning";
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Consignar Saldo</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Consignar Saldo</h4>
                <div class="mt-3">
                    <h5>Saldo Actual: $<?php echo $nuevoSaldo; ?></h5>
                </div>
                <?php if (isset($mensaje)) : ?>
                    <div class="alert <?php echo $claseMensaje; ?>" role="alert">
                        <?php echo $mensaje; ?>
                    </div>
                <?php endif; ?>
                <form method="post" action="" class="mt-3">
                    <div class="form-group">
                        <label for="monto">Monto a consignar:</label>
                        <input type="number" name="monto" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Consignar</button>
                        <a href="Cliente.php" class="btn btn-danger">Regresar</a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
