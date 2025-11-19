
<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario']) || !isset($_GET['id'])) {
    header("Location: ../principal.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$id_transaccion = intval($_GET['id']);

// Verificamos que la transacción le pertenece al usuario
$stmt = $conexion->prepare("SELECT u.id FROM usuarios u JOIN transacciones t ON t.id_usuario = u.id WHERE t.id = ? AND u.usuario = ?");
$stmt->bind_param("is", $id_transaccion, $usuario);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    $stmt->close();
    header("Location: ../principal.php");
    exit();
}
$stmt->close();

// Obtener datos de la transacción
$stmt = $conexion->prepare("SELECT cantidad, type, method, descripcion, categoria FROM transacciones WHERE id = ?");
$stmt->bind_param("i", $id_transaccion);
$stmt->execute();
$stmt->bind_result($cantidad, $type, $method, $descripcion, $categoria);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Transacción</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/custom_styles.css">
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
    <li><a class="dropdown-item" href="php/admin_panel.php">
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
<body class="custom-bg">
<div class="container my-5">
    <h2 class="mb-4">Editar Transacción</h2>
    <form action="guardar_edicion.php" method="POST" class="row g-3">
        <input type="hidden" name="id" value="<?= $id_transaccion ?>">

        <div class="col-md-6">
            <label>Descripción</label>
            <input type="text" name="descripcion" class="form-control" value="<?= htmlspecialchars($descripcion) ?>" required>
        </div>

        <div class="col-md-6">
            <label>Categoría</label>
            <select name="categoria" class="form-select" required>
                <?php
                $opciones = ["Salario", "Comida", "Transporte", "Ocio", "Servicios", "Otros"];
                foreach ($opciones as $opcion) {
                    $selected = $categoria === $opcion ? "selected" : "";
                    echo "<option value='$opcion' $selected>$opcion</option>";
                }
                ?>
            </select>
        </div>

        <div class="col-md-4">
            <label>Cantidad</label>
            <input type="number" step="0.01" name="cantidad" class="form-control" value="<?= $cantidad ?>" required>
        </div>

        <div class="col-md-4">
            <label>Tipo</label>
            <select name="type" class="form-select" required>
                <option value="ingreso" <?= $type === 'ingreso' ? 'selected' : '' ?>>Ingreso</option>
                <option value="gasto" <?= $type === 'gasto' ? 'selected' : '' ?>>Gasto</option>
            </select>
        </div>

        <div class="col-md-4">
            <label>Método</label>
            <select name="method" class="form-select" required>
                <option value="efectivo" <?= $method === 'efectivo' ? 'selected' : '' ?>>Efectivo</option>
                <option value="tarjeta" <?= $method === 'tarjeta' ? 'selected' : '' ?>>Tarjeta</option>
                <option value="transferencia" <?= $method === 'transferencia' ? 'selected' : '' ?>>Transferencia</option>
            </select>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="../principal.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
