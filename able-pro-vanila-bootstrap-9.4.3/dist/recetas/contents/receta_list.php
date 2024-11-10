<!-- <div class="card">
    <div class="card-header">
        <h5>Listado de recetas</h5>
        <span class="d-block m-t-5">use class <code>table-hover</code> inside table element</span>
    </div>
    <div class="card-body table-border-style">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div> -->


<div class="">
    <!-- Panel de Filtros -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Filtros de Búsqueda</h5>
        </div>
        <div class="card-body">
            <form id="filtrosForm">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título de la receta">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="dificultad" class="form-label">Dificultad</label>
                        <select class="form-select" id="dificultad" name="dificultad">
                            <option value="">Todas</option>
                            <option value="fácil">Fácil</option>
                            <option value="media">Media</option>
                            <option value="difícil">Difícil</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="tiempo_preparacion" class="form-label">Tiempo Preparación (min)</label>
                        <input type="number" class="form-control" id="tiempo_preparacion" name="tiempo_preparacion">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="ingrediente" class="form-label">Ingrediente</label>
                        <input type="text" class="form-control" id="ingrediente" name="ingrediente" placeholder="Nombre del ingrediente">
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="" style="position: relative; top: 40%;">
                            <button type="button" class="btn btn-primary" onclick="fetchRecetas(1)">Aplicar Filtros</button>
                            <a href="./nueva-receta.php" type="button" class="btn btn-secondary"> + Nuevo</a>
                        </div> 
                    </div>
                </div>
                
                
            </form>
        </div>
    </div>

    <!-- Listado de Recetas -->
    <div id="recetasListado" class="row"></div>

    <!-- Paginación -->
    <nav>
        <ul id="pagination" class="pagination justify-content-center"></ul>
    </nav>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function fetchRecetas(page = 1) {
        const filtros = $('#filtrosForm').serialize() + `&page=${page}`; 
        $.ajax({
            url: 'api/recetas_paginacion.php',
            type: 'GET',
            data: filtros,
            success: function (response) { 
                const data = JSON.parse(response);
                renderRecetas(data.recetas);
                renderPagination(data.totalPages, page);
            }
        });
    }

    function renderRecetas(recetas) {
        const recetasListado = $('#recetasListado');
        recetasListado.empty();
        if (recetas.length === 0) {
            recetasListado.append('<p class="text-center">No se encontraron recetas.</p>');
        } else {
            recetas.forEach(receta => {
                recetasListado.append(`
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <img height="120" src="http://localhost/ori-fit/able-pro-vanila-bootstrap-9.4.3/dist/files/${receta.foto}" class="card-img-top" alt="${receta.titulo}">
                            <div class="card-body">
                                <h5 class="card-title">${receta.titulo}</h5>
                                <p class="card-text">${receta.descripcion}</p>
                                <p><strong>Tiempo:</strong> ${receta.tiempo_preparacion} mins</p>
                                <p><strong>Dificultad:</strong> ${receta.dificultad}</p>
                                <a href="./editar-receta.php?id=${receta.id}" class="btn btn-primary">Editar</a>
                            </div>
                        </div>
                    </div>
                `);
            });
        }
    }

    function renderPagination(totalPages, currentPage) {
        const pagination = $('#pagination');
        pagination.empty();

        for (let i = 1; i <= totalPages; i++) {
            pagination.append(`
                <li class="page-item ${i === currentPage ? 'active' : ''}">
                    <button class="page-link" onclick="fetchRecetas(${i})">${i}</button>
                </li>
            `);
        }
    }

    $(document).ready(function() {
        fetchRecetas(1); // Cargar recetas por defecto
    });
</script>