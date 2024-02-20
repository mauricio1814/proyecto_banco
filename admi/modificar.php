<?php
    require 'conexion.php';

    $id = $_GET['id'];

    $sql = "SELECT * FROM admi WHERE id = '$id'";
    $resultado = $mysqli->query($sql);
    $row = $resultado->fetch_array(MYSQLI_ASSOC);

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
                <h3 style="text-align:center">MODIFICAR REGISTRO</h3>
            </div>

            <form class="form-horizontal" method="POST" action="update.php" autocomplete="off">
            <div class="form-group">
                    <label for="documento" class="col-sm-2 control-label">Documento</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="documento" name="documento" oninput="this.value = this.value.replace(/[^0-9]/g, '');" placeholder="Documento" value="<?php echo $row['documento']; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="primer_nombre" class="col-sm-2 control-label">Primer Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '');" placeholder="Primer Nombre" value="<?php echo $row['primer_nombre']; ?>" required>
                    </div>
                </div>

                <input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>" />

                <div class="form-group">
                    <label for="segundo_nombre" class="col-sm-2 control-label">Segundo Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '');" placeholder="Segundo Nombre" value="<?php echo $row['segundo_nombre']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="primer_apellido" class="col-sm-2 control-label">Primer Apellido</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '');" placeholder="Primer Apellido" value="<?php echo $row['primer_apellido']; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="segundo_apellido" class="col-sm-2 control-label">Segundo Apellido</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '');" placeholder="Segundo Apellido" value="<?php echo $row['segundo_apellido']; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="correo" class="col-sm-2 control-label">Correo</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" value="<?php echo $row['correo']; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="fecha_nacimiento" class="col-sm-2 control-label">Fecha de Nacimiento</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $row['fecha_nacimiento']; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="celular" class="col-sm-2 control-label">Celular</label>
                    <div class="col-sm-10">
                        <input type="tel" class="form-control" id="celular" name="celular" oninput="this.value = this.value.replace(/[^0-9]/g, '');" placeholder="Celular" value="<?php echo $row['celular']; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="genero" class="col-sm-2 control-label">Género</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="genero" name="genero" required>
                            <option value="Masculino" <?php echo ($row['genero'] == 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                            <option value="Femenino" <?php echo ($row['genero'] == 'Femenino') ? 'selected' : ''; ?>>Femenino</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="contrasena" class="col-sm-2 control-label">Contraseña</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña" value="<?php echo $row['contrasena']; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="saldo" class="col-sm-2 control-label">Saldo</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="saldo" name="saldo" placeholder="Saldo" oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="<?php echo $row['saldo']; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="index.php" class="btn btn-default">Regresar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
