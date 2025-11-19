
<?php
session_start();
include 'php/conexion.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$stmt = $conexion->prepare("SELECT id FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->bind_result($id_usuario);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Transacciones</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/custom_styles.css">
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
  <h1 class="mb-4">Gestión de Finanzas</h1>

<?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
  <div class="mb-3">
    <a href="admin_panel.php" class="btn btn-outline-primary">Ir al Panel de Administración</a>
  </div>
<?php endif; ?>


  <form action="php/transacciones.php" method="POST" class="row g-3 mb-5">
    <div class="col-md-3">
      <input type="text" name="descripcion" class="form-control" placeholder="Descripción" required>
    </div>
    <div class="col-md-2">
      <select name="categoria" class="form-select" required>
        <option value="" selected disabled hidden>Tipo categoria</option>
        <option value="Salario">Salario</option>
        <option value="Comida">Alimentación</option>
        <option value="Transporte">Transporte</option>
        <option value="Ocio">Entretenimiento</option>
        <option value="Servicios">Servicios</option>
        <option value="Otros">Otros</option>
      </select>
    </div>
    <div class="col-md-2">
      <input type="number" name="cantidad" step="0.01" class="form-control" placeholder="Cantidad" required>
    </div>
    <div class="col-md-2">
      <select name="type" class="form-select" required>
        <option value="" selected disabled hidden>Tipo operacion</option>
        <option value="ingreso">Ingreso</option>
        <option value="gasto">Gasto</option>
      </select>
    </div>
    <div class="col-md-2">
      <select name="method" class="form-select" required>
        <option value="" selected disabled hidden>Modo ingreso/gasto</option>
        <option value="efectivo">Efectivo</option>
        <option value="tarjeta">Tarjeta</option>
        <option value="transferencia">Transferencia</option>
      </select>
    </div>
    <div class="col-md-1">
      <button type="submit" class="btn btn-primary w-100">+</button>
    </div>
  </form>

  
<?php
$ingresos = 0;
$gastos = 0;

$stmt_balance = $conexion->prepare("SELECT type, SUM(cantidad) as total FROM transacciones WHERE id_usuario = ? GROUP BY type");
$stmt_balance->bind_param("i", $id_usuario);
$stmt_balance->execute();
$resultado_balance = $stmt_balance->get_result();

while ($fila = $resultado_balance->fetch_assoc()) {
    if ($fila['type'] === 'ingreso') {
        $ingresos = $fila['total'];
    } elseif ($fila['type'] === 'gasto') {
        $gastos = $fila['total'];
    }
}
$stmt_balance->close();
?>

<div class="row text-center mb-4">
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5>Ingresos</h5>
                <p class="fs-4"><?= number_format($ingresos ?? 0, 2) ?> €</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h5>Gastos</h5>
                <p class="fs-4"><?= number_format($gastos ?? 0, 2) ?> €</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5>Balance</h5>
                <p class="fs-4"><?= number_format(($ingresos ?? 0) - ($gastos ?? 0), 2) ?> €</p>
            </div>
        </div>
    </div>
</div>

<table class="table table-hover">
    <thead>
      <tr>
        <th>Fecha</th>
        <th>Descripción</th>
        <th>Categoría</th>
        <th>Método</th>
        <th>Cantidad</th>
        <th>Acción</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $stmt = $conexion->prepare("SELECT id, cantidad, type, method, descripcion, categoria, DATE_FORMAT(NOW(), '%d/%m/%Y') AS fecha FROM transacciones WHERE id_usuario = ?");
      $stmt->bind_param("i", $id_usuario);
      $stmt->execute();
      $resultado = $stmt->get_result();

      while ($row = $resultado->fetch_assoc()) {
          $signo = $row['type'] === 'gasto' ? '-' : '+';
          $row_class = $row['type'] === 'gasto' ? 'transaction-expense' : 'transaction-income';
          $amount_class = $row['type'] === 'gasto' ? 'amount-expense' : 'amount-income';
          echo "<tr class='{$row_class}'>
                  <td>{$row['fecha']}</td>
                  <td>{$row['descripcion']}</td>
                  <td>{$row['categoria']}</td>
                  <td>{$row['method']}</td>
                  <td class='{$amount_class}'>{$signo}" . number_format($row['cantidad'], 2) . "€</td>
                  <td>
                    <div class='d-flex gap-1'>
                      <a href='php/editar_transaccion.php?id={$row['id']}' class='btn btn-sm btn-warning'>Editar</a>
                      <form method='POST' action='php/eliminar_transaccion.php'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button type='submit' class='btn btn-sm btn-danger'>Eliminar</button>
                      </form>
                    </div>
                  </td>
                </tr>";
      }
      ?>
    </tbody>
  </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>