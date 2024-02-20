<?php
session_start();

require 'conexion.php';


if (!isset($_SESSION["usuario"])) {
    header("Location: ../logueo.php");
    exit;
}

$usuario = $_SESSION["usuario"];

$sql = "SELECT * FROM admi WHERE correo = '$usuario'";
$resultado = $mysqli->query($sql);

$where = "";

if (!empty($_POST)) {
    $valor = $_POST['campo'];
    if (!empty($valor)) {
        $where = "WHERE documento LIKE '%$valor%' OR primer_nombre LIKE '%$valor%' OR segundo_nombre LIKE '%$valor%' OR primer_apellido LIKE '%$valor%' OR segundo_apellido LIKE '%$valor%' OR correo LIKE '%$valor%' OR celular LIKE '%$valor%' OR genero LIKE '%$valor%' OR saldo = 0";
    }
}

$sql = "SELECT * FROM admi $where";
$resultado = $mysqli->query($sql);
?>
    
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
        <title>Admi</title>

        <script>
            $(document).ready(function () {
                $('#mitabla').DataTable({
                    "order": [[1, "desc"]],
                    "language": {
                        "lengthMenu": "Mostrar _MENU_ registros por pagina",
                        "info": "Mostrando pagina _PAGE_ de _PAGES_",
                        "infoEmpty": "No hay registros disponibles",
                        "infoFiltered": "(filtrada de _MAX_ registros)",
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "search": "Buscar:",
                        "zeroRecords": "No se encontraron registros coincidentes",
                        "paginate": {
                            "next": "Siguiente",
                            "previous": "Anterior"
                        },
                    }
                });
            });
        </script>

    </head>

    <body>
        
    <header class="header">
        <div class="logo">
            <img src="img/telefono-movil.png" alt="Logo de la marca">
        </div>
        <nav>
           <ul class="nav-links">
                <li><a href="nuevo.php">Nuevo Registro</a></li>
                <li><a href="saldo.php">Usuarios con 0</a></li>
                <li><a href="../Formulario.php">Cerrar Sesion</a></li>
           </ul>            
        </nav>
        <a class="btn" href="#"><button>Contact</button></a>
    </header>
    <div class="container">
        <h2 class="text-center">Bienvenido Admi</h2>
        <br>
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
                            <th>Eliminar</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
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
                                <td><a href="modificar.php?id=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                                <td><a href="#" data-href="eliminar.php?id=<?php echo $row['id']; ?>" data-toggle="modal" data-target="#confirm-delete"><span class="glyphicon glyphicon-trash"></span></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
                    </div>

                    <div class="modal-body">
                        ¿Desea eliminar este registro?
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger btn-ok">Delete</a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $('#confirm-delete').on('show.bs.modal', function (e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

                $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
            });
        </script>
    <br><br><br>
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
                        <a href="#" id="icon-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" id="icon-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" id="icon-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" id="icon-link"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    </body>
</html>
