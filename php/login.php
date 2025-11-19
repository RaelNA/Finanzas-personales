<?php
session_start();
include 'conexion.php';

$usuario = trim($_POST['username']);
$password = trim($_POST['password']);

// Usar consulta con SHA2 para verificar contraseña cifrada
$stmt = $conexion->prepare("SELECT id, id_tipo_usuario FROM usuarios WHERE usuario = ? AND password = SHA2(?, 256)");
$stmt->bind_param("ss", $usuario, $password);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    $stmt->bind_result($id_usuario, $id_tipo_usuario);
    $stmt->fetch();

    $_SESSION['usuario'] = $usuario;
    $_SESSION['id_usuario'] = $id_usuario;
    $_SESSION['id_tipo_usuario'] = $id_tipo_usuario;

    // Registrar log de inicio de sesión
    $accion = "Inicio de sesión";
    $stmt_log = $conexion->prepare("INSERT INTO logs (usuario, accion) VALUES (?, ?)");
    $stmt_log->bind_param("ss", $usuario, $accion);
    $stmt_log->execute();
    $stmt_log->close();

    if ($id_tipo_usuario == 2) {
        header("Location: ../principal.php");
    } else {
        header("Location: ../principal.php");
    }
    exit();
} else {
    echo '<script>
        alert("Usuario o contraseña incorrectos");
        window.location = "../index.php";
    </script>';
}
$stmt->close();
$conexion->close();
?>
