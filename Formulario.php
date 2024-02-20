<?php
require 'cliente/conexion.php';

function limpiarEntrada($entrada) {
    global $mysqli;
    return mysqli_real_escape_string($mysqli, $entrada);
}

$mensajeError = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $usuario = limpiarEntrada($_POST["usuario"]);
    $password = limpiarEntrada($_POST["password"]);
    $rol = limpiarEntrada($_POST["role"]);

    if ($rol === 'administrador' && $usuario === 'admi' && $password === 'admi') {
        
        session_start();
        $_SESSION["usuario"] = $usuario;
        header("Location: admi/index.php");
        exit;
    } elseif ($rol === 'cliente') {
    
        $sql = "SELECT * FROM admi WHERE documento = ? AND contrasena = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss", $usuario, $password);
        $stmt->execute();
        $resultado = $stmt->get_result();
    
        if ($resultado->num_rows === 1) {
            $row = $resultado->fetch_assoc();
            session_start();
            $_SESSION["usuario"] = $usuario;
            $_SESSION["id_usuario"] = $row['id']; 
            header("Location: cliente/Cliente.php");
            exit;
        } else {
            $mensajeError = "El usuario, la contraseña o el rol son incorrectos";
        }
        $stmt->close();
    } else {
        $mensajeError = "Rol no válido";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="cliente/css/Formulario.css">
    <style>
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <form action="" method="post" class="form">
            <h1 class="title">Inicio</h1>
            
            <?php if (!empty($mensajeError)) : ?>
                <div class="error-message"><?php echo $mensajeError; ?></div>
            <?php endif; ?>

            <div class="inp">
                <input type="text" name="usuario" class="input" placeholder="Usuario">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="inp">
                <input type="password" name="password" class="input" placeholder="Contraseña">
                <i class="fa-solid fa-lock"></i>
            </div>
            <div class="input-contenedor1">
                <label for="role">Rol:</label>
                <select id="role" name="role">
                    <option value="administrador">Administrador</option>
                    <option value="cliente">Cliente</option>
                </select>
            </div>
            <button class="shadow__btn" name="Login">Iniciar Sesión</button>
        </form>
        <div class="banner">
            <h1 class="wel_text">Banco AJM</h1>
            <p class="para"></p>
        </div>
    </div>
</body>
</html>
