<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    echo '<script>
        alert("Debes iniciar sesión para acceder a esta página");
        window.location = "index.php";
    </script>';
    session_destroy();
    die();
}

include 'php/conexion.php';

$usuario_sesion = $_SESSION['usuario'];

// Obtener ID del usuario
$stmt = $conexion->prepare("SELECT id FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $usuario_sesion);
$stmt->execute();
$stmt->bind_result($id_usuario);
$stmt->fetch();
$stmt->close();

// Valores por defecto
$email = $nombre = $apellidos = $pais = $ciudad = $cp = "";

// Obtener datos si existen
$consulta = $conexion->prepare("SELECT email, nombre, apellidos, pais, ciudad, cp FROM datos_personales WHERE id_usuario = ?");
$consulta->bind_param("i", $id_usuario);
$consulta->execute();
$consulta->store_result();
if ($consulta->num_rows > 0) {
    $consulta->bind_result($email, $nombre, $apellidos, $pais, $ciudad, $cp);
    $consulta->fetch();
}
$consulta->close();

// Guardar cambios
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $nombre = trim($_POST["nombre"]);
    $apellidos = trim($_POST["apellidos"]);
    $pais = trim($_POST["pais"]);
    $ciudad = trim($_POST["ciudad"]);
    $cp = trim($_POST["cp"]);

    $check = $conexion->prepare("SELECT id FROM datos_personales WHERE id_usuario = ?");
    $check->bind_param("i", $id_usuario);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $stmt2 = $conexion->prepare("UPDATE datos_personales SET email=?, nombre=?, apellidos=?, pais=?, ciudad=?, cp=? WHERE id_usuario=?");
        $stmt2->bind_param("ssssssi", $email, $nombre, $apellidos, $pais, $ciudad, $cp, $id_usuario);
    } else {
        $stmt2 = $conexion->prepare("INSERT INTO datos_personales (email, nombre, apellidos, pais, ciudad, cp, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt2->bind_param("ssssssi", $email, $nombre, $apellidos, $pais, $ciudad, $cp, $id_usuario);
    }
    $stmt2->execute();
    $stmt2->close();
    echo "<script>alert('Datos actualizados correctamente'); window.location='perfil.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <title>Perfil de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="bi bi-wallet2"></i> Finanzas Personales
        </a>
        <div class="ms-auto d-flex align-items-center">
            <?php if(isset($_SESSION['usuario'])): ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="bi bi-person-fill"></i>
                        <?= htmlspecialchars($_SESSION['usuario']) ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <?php if (isset($_SESSION['id_tipo_usuario']) && $_SESSION['id_tipo_usuario'] == 2): ?>
                            <li><a class="dropdown-item" href="php/admin_panel.php">
                                <i class="bi bi-speedometer2"></i> Panel de Administrador
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                        <?php endif; ?>
                        <li><a class="dropdown-item" href="perfil.php">
                            <i class="bi bi-person-lines-fill"></i> Editar Perfil
                        </a></li>
                        <li><a class="dropdown-item" href="login.php">
                            <i class="bi bi-arrow-repeat"></i> Cambiar Usuario
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="php/cerrar_sesion.php">
                            <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                        </a></li>
                    </ul>
                </div>
            <?php else: ?>
                <a href="login.php" class="btn btn-outline-light">Iniciar Sesión</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-person-lines-fill"></i> Editar Perfil</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($email) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($nombre) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Apellidos</label>
                            <input type="text" name="apellidos" class="form-control" value="<?= htmlspecialchars($apellidos) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">País</label>
                            <input type="text" name="pais" class="form-control" value="<?= htmlspecialchars($pais) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ciudad</label>
                            <input type="text" name="ciudad" class="form-control" value="<?= htmlspecialchars($ciudad) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Código Postal</label>
                            <input type="text" name="cp" class="form-control" value="<?= htmlspecialchars($cp) ?>" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Guardar Cambios</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="principal.php" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
