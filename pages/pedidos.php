<?php
include "../app/categoryController.php";
$categoryController = new categoryController();
$pedidos = $categoryController->getPedidos();

if (!isset($_SESSION) || $_SESSION['id'] == false) {
    header("Location:../");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../app/jquery-3.5.1.min.js"></script>
    <script>
        $(function(){
            $("#header").load("menu.php");
        });
    </script>
</head>
<body class="bg-light">
<header id="header"></header>

<main class="container mt-4">
    <div class="card shadow-sm rounded">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
            <h4 class="mb-0">Pedidos</h4>
            <div>
                <a href="main.php" class="btn btn-outline-light btn-sm me-2">Regresar</a>
                <button class="btn btn-light btn-sm text-primary fw-bold" data-bs-toggle="modal" data-bs-target="#modalAgregarPedido">
                    + Agregar Pedido
                </button>
            </div>
        </div>

        <div class="card-body bg-white">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>Número Guía</th>
                            <th>Detalle</th>
                            <th>Proveedor</th>
                            <th>Estado</th>
                            <th>Fecha Pedido</th>
                            <th>Fecha Entrega</th>
                            <th>Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pedidos as $pedido): ?>
                            <tr>
                                <td><?= $pedido['num_guia'] ?></td>
                                <td><?= $pedido['detalle'] ?></td>
                                <td><?= $pedido['proveedor'] ?></td>
                                <td>
                                    <span class="badge <?= $pedido['estado'] == 'Entregado' ? 'bg-success' : 'bg-warning text-dark' ?>">
                                        <?= $pedido['estado'] ?>
                                    </span>
                                    <!-- Ícono de lápiz para editar -->
                                    <button 
                                        class="btn btn-sm btn-outline-primary ms-1"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalEditarEstado"
                                        data-id="<?= $pedido['id_pedidos'] ?>"
                                        data-estado="<?= $pedido['estado'] ?>"
                                        data-fecha="<?= $pedido['fecha_entrga'] ?>"
                                    >
                                        ✏️
                                    </button>
                                </td>
                                <td><?= $pedido['fecha_pedido'] ?></td>
                                <td><?= $pedido['fecha_entrga'] ?? '-' ?></td>
                                <td>$<?= number_format($pedido['monto'], 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Modal Agregar Pedido -->
<div class="modal fade" id="modalAgregarPedido" tabindex="-1" aria-labelledby="modalAgregarPedidoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="../app/categoryController.php" class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalAgregarPedidoLabel">Agregar Pedido</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
          <div class="mb-3">
              <label class="form-label">Detalle</label>
              <textarea class="form-control" name="detalle" required></textarea>
          </div>
          <div class="mb-3">
              <label class="form-label">Proveedor</label>
              <input type="text" class="form-control" name="proveedor" required>
          </div>
          <div class="mb-3">
              <label class="form-label">Número de Guía</label>
              <input type="text" class="form-control" name="num_guia" required>
          </div>
          <div class="mb-3">
              <label class="form-label">Estado</label>
              <select class="form-control" name="estado" required>
                  <option value="Pendiente">Pendiente</option>
                  <option value="Entregado">Entregado</option>
              </select>
          </div>
          <div class="mb-3">
              <label class="form-label">Fecha Pedido</label>
              <input type="date" class="form-control" name="fecha_pedido" required>
          </div>
          <div class="mb-3">
              <label class="form-label">Fecha Entrega</label>
              <input type="date" class="form-control" name="fecha_entrga" required>
          </div>
          <div class="mb-3">
              <label class="form-label">Monto</label>
              <input type="number" step="0.01" class="form-control" name="monto" required>
              <input type="hidden" name="action" value="uploadPedido">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Editar Estado -->
<div class="modal fade" id="modalEditarEstado" tabindex="-1" aria-labelledby="modalEditarEstadoLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <form method="POST" action="../app/categoryController.php" class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="modalEditarEstadoLabel">Actualizar Estado</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
          <input type="hidden" name="id_pedido" id="edit_id_pedido">
          <input type="hidden" name="action" value="updatePedidoEstado">

          <div class="mb-3">
              <label class="form-label">Estado</label>
              <select class="form-control" name="estado" id="edit_estado" required>
                  <option value="Pendiente">Pendiente</option>
                  <option value="Entregado">Entregado</option>
              </select>
          </div>
          <div class="mb-3">
              <label class="form-label">Fecha Entrega</label>
              <input type="date" class="form-control" name="fecha_entrga" id="edit_fecha_entrga">
          </div>
          <input type="hidden" name="action" value="updatePedidoEstado">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success btn-sm">Guardar</button>
      </div>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modalEditar = document.getElementById('modalEditarEstado');
    modalEditar.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const estado = button.getAttribute('data-estado');
        const fecha = button.getAttribute('data-fecha');

        modalEditar.querySelector('#edit_id_pedido').value = id;
        modalEditar.querySelector('#edit_estado').value = estado;
        modalEditar.querySelector('#edit_fecha_entrga').value = fecha;
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
