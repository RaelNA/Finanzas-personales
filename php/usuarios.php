<?php
session_start();
include 'conexion.php';

// Proteger acceso solo para administradores
if (!isset($_SESSION['usuario']) || $_SESSION['id_tipo_usuario'] != 2) {
    header("Location: ../index.php");
    exit();
}

// Obtener lista de usuarios
$stmt = $conexion->prepare("SELECT id, usuario, id_tipo_usuario FROM usuarios");
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
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
                        <?php 
                        if(!empty($_SESSION['usuario'])) {
                            echo htmlspecialchars($_SESSION['usuario']);
                        }
                        ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
<?php if (isset($_SESSION['id_tipo_usuario']) && $_SESSION['id_tipo_usuario'] == 2): ?>
    <li><a class="dropdown-item" href="admin_panel.php">
        <i class="bi bi-speedometer2"></i> Panel de Administrador
    </a></li>
    <li><hr class="dropdown-divider"></li>
<?php endif; ?>

                        <li><a class="dropdown-item" href="perfil.php">
                            <i class="bi bi-person-lines-fill"></i> Editar Perfil
                        </a></li>
                        <li><a class="dropdown-item" href="../php/cerrar_sesion.php">
                            <i class="bi bi-arrow-repeat"></i> Cambiar Usuario
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="../php/cerrar_sesion.php">
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
<body class="bg-light text-dark">
<div class="container my-5">
    <h2 class="mb-4"><i class="bi bi-people"></i> Gestión de Usuarios</h2>

    <table class="table table-light table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['usuario']) ?></td>
                    <td><?= $row['id_tipo_usuario'] == 2 ? 'Administrador' : 'Registrado' ?></td>
                    <td>
                        <div class="d-flex gap-2">
                            <?php if ($_SESSION['id_usuario'] != $row['id']): ?>
                                <form action="editar_usuario.php" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button class="btn btn-sm btn-warning" title="Cambiar rol">
                                        <i class="bi bi-shield-lock"></i>
                                    </button>
                                </form>
                                <form action="eliminar_usuario.php" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button class="btn btn-sm btn-danger" title="Eliminar usuario">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            <?php else: ?>
                                <span class="text-muted">Tú</span>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="admin_panel.php" class="btn btn-outline-secondary mt-4">
        <i class="bi bi-arrow-left"></i> Volver al panel
    </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
