<?php
function get_notifications(mysqli $conexion): array {
    if (!isset($_SESSION['IdUsuario'])) return [];
    $sql = "SELECT n.Titulo, n.descripcion, pu.pregunta
            FROM notificaciones n
            JOIN preguntasusuarios pu ON n.idpregunta = pu.idpregunta
            WHERE n.IdUsuario = ?";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) return [];
    $stmt->bind_param("i", $_SESSION['IdUsuario']);
    $stmt->execute();
    $res = $stmt->get_result();
    $data = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    $stmt->close();
    return $data;
}

function render_notifications_dropdown(array $notificaciones): void {?>
    <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
      <div class="dropdown-header d-flex align-items-center justify-content-between">
        <h5 class="m-0">Notificaciones</h5>
        <a href="#!" class="btn btn-link btn-sm">Marcar como leidas</a>
      </div>
      <div class="dropdown-body text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 215px)">
        <?php if (!empty($notificaciones)): ?>
          <?php foreach ($notificaciones as $n): ?>
            <div class="card mb-2">
              <div class="card-body">
                <div class="d-flex">
                  <div class="flex-shrink-0">
                    <svg class="pc-icon text-primary"><use xlink:href="#custom-layer"></use></svg>
                  </div>
                  <div class="flex-grow-1 ms-3">
                    <h4 class="text-body mb-2"><?= htmlspecialchars($n['Titulo']) ?></h4>
                    <p>Pregunta:<?= $n['pregunta'] ?></p>
                    <h5 class="mb-0"><?= htmlspecialchars($n['descripcion']) ?></h5>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p class="text-center">No hay notificaciones</p>
        <?php endif; ?>
      </div>
      <div class="text-center py-2">
        <a href="#!" class="link-danger">Borrar todas las Notificaciones</a>
      </div>
    </div>
<?php }
?>
