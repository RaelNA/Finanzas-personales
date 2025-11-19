<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    echo '<script>
        alert("Debes iniciar sesión.");
        window.location = "index.php";
    </script>';
    die();
}

include 'php/conexion.php'; // asegúrate de que aquí está definida $conexion

$usuario_sesion = $_SESSION['usuario'];

// Obtener ID del usuario
$stmt = $conexion->prepare("SELECT id FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $usuario_sesion);
$stmt->execute();
$stmt->bind_result($id_usuario);
$stmt->fetch();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $nombre = trim($_POST["nombre"]);
    $apellidos = trim($_POST["apellidos"]);
    $pais = trim($_POST["pais"]);
    $ciudad = trim($_POST["ciudad"]);
    $cp = trim($_POST["cp"]);

    // Verificar si ya existen datos personales
    $check = $conexion->prepare("SELECT id FROM datos_personales WHERE id_usuario = ?");
    $check->bind_param("i", $id_usuario);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        // Actualizar
        $stmt2 = $conexion->prepare("UPDATE datos_personales SET email=?, nombre=?, apellidos=?, pais=?, ciudad=?, cp=? WHERE id_usuario=?");
        $stmt2->bind_param("ssssssi", $email, $nombre, $apellidos, $pais, $ciudad, $cp, $id_usuario);
        $stmt2->execute();
        $stmt2->close();
        echo '<script>alert("Perfil actualizado correctamente."); window.location="perfil.php";</script>';
    } else {
        // Insertar
        $stmt2 = $conexion->prepare("INSERT INTO datos_personales (id_usuario, email, nombre, apellidos, pais, ciudad, cp) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt2->bind_param("issssss", $id_usuario, $email, $nombre, $apellidos, $pais, $ciudad, $cp);
        $stmt2->execute();
        $stmt2->close();
        echo '<script>alert("Datos personales guardados correctamente."); window.location="perfil.php";</script>';
    }
    $check->close();
}
?>