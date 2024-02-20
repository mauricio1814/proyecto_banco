<?php
session_start();

require 'conexion.php';

if (!isset($_SESSION["usuario"]) || !isset($_SESSION["id_usuario"])) {
    header("Location: ../Formulario.php");
    exit;
}

$usuario = $_SESSION["usuario"];
$id_cliente = $_SESSION["id_usuario"];

$sql = "SELECT * FROM admi WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$resultado = $stmt->get_result();
$stmt->close();

$rows = $resultado->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href="css/cdn.datatables.net_1.13.7_css_jquery.dataTables.min.css" rel="stylesheet">
    <script src="js/cdn.datatables.net_1.13.7_js_jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>Cliente</title>
    
</head>

<body >
    <header class="header">
        <div class="logo">
            <img src="img/telefono-movil.png" alt="Logo de la marca">
        </div>
        <nav>
           <ul class="nav-links">
                <li><a href="Consignar.php">Consignar</a></li>
                <li><a href="Retirar.php">Retirar</a></li>
                <li><a href="../Formulario.php">Cerrar Sesion</a></li>
           </ul>            
        </nav>
        <a class="btn" href="#"><button>Contact</button></a>
    </header>
    
    <div class="container">
        <?php
        foreach ($rows as $row) {
            $nombreCliente = $row['primer_nombre'] . ' ' . $row['primer_apellido'];
        ?>
            <h2 style="text-align:center">Bienvenido <?php echo $nombreCliente; ?></h2>
        <?php } ?>
        <br>
        <br>

        <div class="row">
            <div class="col-md-12 table-responsive">
                <table class="table table-bordered" id="mitabla">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Documento</th>
                            <th>Primer Nombre</th>
                            <th>Segundo Nombre</th>
                            <th>Primer Apellido</th>
                            <th>Segundo Apellido</th>
                            <th>Correo</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Celular</th>
                            <th>Género</th>
                            <th>Contraseña</th>
                            <th>Saldo</th>
                            <th>Editar</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($rows as $row) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['documento']; ?></td>
                                <td><?php echo $row['primer_nombre']; ?></td>
                                <td><?php echo $row['segundo_nombre']; ?></td>
                                <td><?php echo $row['primer_apellido']; ?></td>
                                <td><?php echo $row['segundo_apellido']; ?></td>
                                <td><?php echo $row['correo']; ?></td>
                                <td><?php echo $row['fecha_nacimiento']; ?></td>
                                <td><?php echo $row['celular']; ?></td>
                                <td><?php echo $row['genero']; ?></td>
                                <td><?php echo $row['contrasena']; ?></td>
                                <td><?php echo $row['saldo']; ?></td>
                                <td><a href="ModificarC.php?id=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

        <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <h4>company</h4>
                    <ul>
                        <li><a href="#">about us</a></li>
                        <li><a href="#">our services</a></li>
                        <li><a href="#">privacy policy</a></li>
                        <li><a href="#">affiliate program</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>get help</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">shipping</a></li>
                        <li><a href="#">returns</a></li>
                        <li><a href="#">order status</a></li>
                        <li><a href="#">payment options</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>online shop</h4>
                    <ul>
                        <li><a href="#">watch</a></li>
                        <li><a href="#">bag</a></li>
                        <li><a href="#">shoes</a></li>
                        <li><a href="#">dress</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>follow us</h4>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
