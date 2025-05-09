<?php
include 'db.php';

session_start();

$query = "SELECT * FROM videos";
$result = $conexion->query($query);

// Verificamos si la consulta fue exitosa
if ($result && $result->num_rows > 0) {
    // Convertimos los resultados a un array asociativo
    $videos = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $videoss = []; // Si no hay usuarios
}


?>

</div>
    <hr>
     <!-- Contenido de la página -->
     <div class="container mt-4">
    <!-- Pestañas -->
    <div class="tab-content">
        <div class="tab-pane fade show active" id="usuarios" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th colspan="9" style="background-color: #f8f9fa; font-size: 1.5rem; border: none;">
                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                                    <!-- Buscador -->
                                    <div class="mb-2 mb-md-0">
                                        <label for="userSearch" class="form-label" style="font-size: 1rem;">Buscador</label>
                                        <input type="text" class="form-control form-control-sm" id="userSearch" placeholder="Buscar por nombre, correo..." style="width: 200px;">
                                    </div>

                                    <!-- Título -->
                                    <div class="text-center mb-2 mb-md-0">Gestión de Usuarios</div>

                                    <!-- Botón Agregar Usuario -->
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                        <img src="../assets/images/icons-tab/añadir.png" alt="añadir" style="height: 20px; width: 20px; margin-right: 5px;">
                                        Agregar usuario
                                    </button>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th class="d-none d-md-table-cell">Descripcion</th>
                            <th>Enfoque</th>
                            <th class="d-none d-md-table-cell">Grupo Muscular</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($videoss as $videos): ?>
                            <tr>
                                <td><?php echo $videos['IdVideo']; ?></td>
                                <td><?php echo $videos['Nombre']; ?></td>
                                <td class="d-none d-md-table-cell"><?php echo $videos['Descripcion']; ?></td>
                                <td><?php echo $videos['IdGrupoEnfoque']; ?></td>
                                <td class="d-none d-md-table-cell"><?php echo $videos['IdGrupoMuscular']; ?></td>
                                <td>
                                    <div class="d-flex flex-column flex-md-row justify-content-center gap-1">
                                    <button class="btn btn-sm btn-warning" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal"
                                        data-id="<?= $videos['IdVideo'] ?>"
                                        data-nombre="<?= $videos['Nombre'] ?>"
                                        data-apellido="<?= $videos['Descripcion'] ?>"
                                        data-telefono="<?= $videos['IdGrupoEnfoque'] ?>"
                                        data-correo="<?= $videos['IdGrupoMuscular'] ?>">
                                          <img src="../assets/images/icons-tab/editar.png" alt="Editar" style="width: 16px; height: 16px;">
                                      </button>

                                        <form method="POST" action="borrar_usuario.php" style="display: inline;">
                                            <input type="hidden" name="id" value="<?php echo $videos['id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm w-100 w-md-auto" title="Eliminar Usuario">
                                                <img src="../assets/images/icons-tab/papelera.png" alt="Eliminar" style="width: 16px; height: 16px;">
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>