<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuario con saldo 0</title>
    <link rel="stylesheet" href="css/saldo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<header class="header">
        <div class="logo">
            <img src="img/telefono-movil.png" alt="Logo de la marca">
        </div>
        <nav>
           <ul class="nav-links">
                <li><a href="index.php">Volver</a></li>
                <li><a href="../Formulario.php">Cerrar Sesion</a></li>
           </ul>            
        </nav>
        <a class="btn" href="#"><button>Contact</button></a>
    </header>

        <br><br>

    <h1>Usuarios con Saldo Igual a 0</h1>

    <br><br>

    <?php
    include("conexion.php");

    $sql = "SELECT * FROM admi WHERE saldo = 0";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        echo "<table class='table table-bordered'>";
        echo "<tr>";
        echo "<th>id</th>";
        echo "<th>Documento</th>";
        echo "<th>Primer Nombre</th>";
        echo "<th>Segundo Nombre</th>";
        echo "<th>Primer Apellido</th>";
        echo "<th>Segundo Apellido</th>";
        echo "<th>Correo</th>";
        echo "<th>Fecha de Nacimiento</th>";
        echo "<th>Celular</th>";
        echo "<th>Género</th>";
        echo "<th>contrasena</th>";
        echo "<th>Saldo</th>";
        echo "</tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["documento"] . "</td>";
            echo "<td>" . $row["primer_nombre"] . "</td>";
            echo "<td>" . $row["segundo_nombre"] . "</td>";
            echo "<td>" . $row["primer_apellido"] . "</td>";
            echo "<td>" . $row["segundo_apellido"] . "</td>";
            echo "<td>" . $row["correo"] . "</td>";
            echo "<td>" . $row["fecha_nacimiento"] . "</td>";
            echo "<td>" . $row["celular"] . "</td>";
            echo "<td>" . $row["genero"] . "</td>";
            echo "<td>" . $row["contrasena"] . "</td>";
            echo "<td>" . $row["saldo"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No se encontraron usuarios con saldo mayor o igual a 0.";
    }

    $mysqli->close();
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

     
</body>
</html>
