<?php
require 'conexion.php';
require 'fpdf/fpdf.php'; 

function limpiarEntrada($entrada) {
    global $mysqli;
    return mysqli_real_escape_string($mysqli, $entrada);
}

function obtenerDatosCliente($idCliente) {
    global $mysqli;

    $sql = "SELECT documento, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, celular, saldo FROM admi WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $idCliente);
    $stmt->execute();
    $stmt->bind_result($documento, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $celular, $saldo);
    $stmt->fetch();
    $stmt->close();

    return [
        'documento' => $documento,
        'primerNombre' => $primerNombre,
        'segundoNombre' => $segundoNombre,
        'primerApellido' => $primerApellido,
        'segundoApellido' => $segundoApellido,
        'celular' => $celular,
        'saldo' => $saldo,
    ];
}

function retirarSaldo($idCuenta, $monto) {
    global $mysqli;

    $saldoSuficiente = verificarSaldoSuficiente($idCuenta, $monto);

    if ($saldoSuficiente) {
        $sql = "UPDATE admi SET saldo = saldo - ? WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("di", $monto, $idCuenta);

        if ($stmt->execute()) {
            $stmt->close();
            return true; 
        } else {
            return false; 
        }
    } else {
        return false; 
    }
}

function verificarSaldoSuficiente($idCuenta, $monto) {
    global $mysqli;

    $sql = "SELECT saldo FROM admi WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $idCuenta);
    $stmt->execute();
    $stmt->bind_result($saldo);
    $stmt->fetch();
    $stmt->close();

    return ($saldo >= $monto);
}

function generarFacturaPDF($idCliente, $montoOperacion, $tipoOperacion) {
    $datosCliente = obtenerDatosCliente($idCliente);
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Factura', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Documento: ' . $datosCliente['documento'], 0, 1);
    $pdf->Cell(0, 10, 'Nombre: ' . $datosCliente['primerNombre'] . ' ' . $datosCliente['segundoNombre'], 0, 1);
    $pdf->Cell(0, 10, 'Apellido: ' . $datosCliente['primerApellido'] . ' ' . $datosCliente['segundoApellido'], 0, 1);
    $pdf->Cell(0, 10, 'Celular: ' . $datosCliente['celular'], 0, 1);

    $pdf->Ln(10);
    $operacion = ($tipoOperacion == 'retiro') ? 'Monto Retirado' : 'Monto Consignado';
    $pdf->Cell(0, 10, "$operacion: $". number_format($montoOperacion, 2), 0, 1);
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(0, 10, 'Firma: ________________________', 0, 1, 'R');
    $pdf->Cell(0, 10, '¡Gracias por su preferencia!', 0, 1, 'C');
    $pdf->Output('factura.pdf', 'D');
}


session_start();

if (!isset($_SESSION["usuario"]) || !isset($_SESSION["id_usuario"])) {
    header("Location: ../logueo.php");
    exit;
}

$idCliente = $_SESSION["id_usuario"];
$datosCliente = obtenerDatosCliente($idCliente);  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $montoOperacion = limpiarEntrada($_POST["monto"]);
    
    if (!empty($montoOperacion) && is_numeric($montoOperacion) && $montoOperacion > 0) {
        if (isset($_POST["retirar"])) {
            if (retirarSaldo($idCliente, $montoOperacion)) {
                $nuevoSaldo = verificarSaldoSuficiente($idCliente, 0);  
                $mensaje = "Retiro exitoso. Nuevo saldo: $nuevoSaldo";
                $claseMensaje = "alert-success";
                generarFacturaPDF($idCliente, $montoOperacion, 'retiro');
            } else {
                $mensaje = "Error al retirar saldo. No hay suficentes fondos.";
                $claseMensaje = "alert-danger";
            }
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
    <title>Retirar Saldo</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Retirar Saldo</h4>
                <?php if (isset($mensaje)) : ?>
                    <div class="alert <?php echo $claseMensaje; ?>" role="alert">
                        <?php echo $mensaje; ?>
                    </div>
                <?php endif; ?>
                
                <div class="mt-3">
                    <h5>Saldo Actual: $<?php echo $datosCliente['saldo']; ?></h5>
                </div>

                <form method="post" action="" class="mt-3">
                    <div class="form-group">
                        <label for="monto">Monto a retirar:</label>
                        <input type="number" name="monto" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" name="retirar" class="btn btn-primary">Retirar</button>
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
