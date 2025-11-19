
<?php
session_start();
include 'conexion.php';

// Procesar registro si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST["usuario"]);
    $password = trim($_POST["password"]);

    // Verificar si el usuario ya existe
    $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo '<script>alert("El nombre de usuario ya está en uso");</script>';
    } else {
        // Insertar usuario nuevo con contraseña cifrada
        $id_tipo_usuario = 1; // Rol 'registrado'
        $stmt_insert = $conexion->prepare("INSERT INTO usuarios (usuario, password, id_tipo_usuario) VALUES (?, SHA2(?, 256), ?)");
        $stmt_insert->bind_param("ssi", $usuario, $password, $id_tipo_usuario);
        $stmt_insert->execute();

        if ($stmt_insert->affected_rows > 0) {
            echo '<script>alert("Usuario registrado correctamente"); window.location = "../index.php";</script>';
            exit();
        } else {
            echo '<script>alert("Error al registrar el usuario");</script>';
        }
        $stmt_insert->close();
    }
    $stmt->close();
}
?>


