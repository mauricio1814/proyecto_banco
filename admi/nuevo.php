<html lang="es">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
        function calcularEdad() {
            var fechaNacimiento = document.getElementById("fecha_nacimiento").value;
            
            var fechaNacimientoDate = new Date(fechaNacimiento);

            var fechaActual = new Date();

            var diferenciaAnios = fechaActual.getFullYear() - fechaNacimientoDate.getFullYear();

            if (diferenciaAnios < 18) {
                alert("Debes ser mayor de 18 años para registrarte.");
                return false; 
            }

            return true; 
        }
    </script>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <h3 style="text-align:center">NUEVO REGISTRO</h3>
            </div>

            <form class="form-horizontal" method="POST" action="guardar.php" autocomplete="off">
                <div class="form-group">
                    <label for="documento" class="col-sm-2 control-label">Documento</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="documento" name="documento" placeholder="Documento" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="primer_nombre" class="col-sm-2 control-label">Primer Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" placeholder="Primer Nombre" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '');" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="segundo_nombre" class="col-sm-2 control-label">Segundo Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre" placeholder="Segundo Nombre (Opcional)" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '');">
                    </div>
                </div>

                <div class="form-group">
                    <label for="primer_apellido" class="col-sm-2 control-label">Primer Apellido</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" placeholder="Primer Apellido" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '');" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="segundo_apellido" class="col-sm-2 control-label">Segundo Apellido</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" placeholder="Segundo Apellido" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '');">
                    </div>
                </div>

                <div class="form-group">
                    <label for="correo" class="col-sm-2 control-label">Correo</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo"  required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="fecha_nacimiento" class="col-sm-2 control-label">Fecha de Nacimiento</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="celular" class="col-sm-2 control-label">Celular</label>
                    <div class="col-sm-10">
                        <input type="tel" class="form-control" id="celular" name="celular" placeholder="Celular" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required >
                    </div>
                </div>

                <div class="form-group">
                    <label for="genero" class="col-sm-2 control-label">Género</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="genero" name="genero">
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="contrasena" class="col-sm-2 control-label">Contraseña</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="saldo" class="col-sm-2 control-label">Saldo</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="saldo" name="saldo" placeholder="Saldo" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
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
