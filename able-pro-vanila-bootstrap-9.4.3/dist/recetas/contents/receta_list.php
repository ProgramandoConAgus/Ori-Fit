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

<style>
  /* 1) Que la imagen no se deforme y mantenga la altura actual */
  #recetasListado .card .card-img-top{
    width: 100%;
    height: 120px !important;   /* misma altura que usás */
    object-fit: cover;           /* recorta sin estirar */
    object-position: center;     /* centra el recorte */
    display: block;
    background: #f3f5f7;         /* color de fondo si tarda en cargar */
    border-top-left-radius: .5rem;
    border-top-right-radius: .5rem;
  }

  /* 2) Si viene “sin foto”, ocultá el <img> para que no quede roto */
  #recetasListado img.card-img-top[src=""],
  #recetasListado img.card-img-top:not([src]),
  #recetasListado img.card-img-top[src$="/"],
  #recetasListado img.card-img-top[src$="null"],
  #recetasListado img.card-img-top[src$="undefined"]{
    display:none !important;
  }
</style>
<style>
  /* ya lo tenés: 120px y cover */
  #recetasListado .card .card-img-top{
    width:100%;
    height:120px!important;
    object-fit:cover;
    object-position:center;
    display:block;
    background:#f3f5f7;
    border-top-left-radius:.5rem;
    border-top-right-radius:.5rem;
  }
  /* si es placeholder, que entre completa y no se deforme */
  #recetasListado .card .card-img-top.is-placeholder{
    object-fit:contain;
    padding:10px;
  }
</style>
<style>
  /* todas las imágenes de la card: NO deformar y altura fija */
  #recetasListado .card .card-img-top{
    width: 100%;
    height: 120px !important;
    object-fit: cover;
    object-position: center;
    display: block;
  }

  /* placeholder: que también rellene y recorte si hace falta */
  #recetasListado .card .card-img-top.is-placeholder{
    object-fit: cover !important;
    object-position: center;      /* probá 50% 40% si querés subir el encuadre */
    padding: 0 !important;
    background: none;
  }
</style>


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
                            <?php if(isset($_SESSION['IdRol']) && $_SESSION['IdRol'] == 2): ?>
                                <a href="./nueva-receta.php" type="button" class="btn btn-secondary"> + Nuevo</a>
                            <?php endif; ?>
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
    var isAdmin = <?php echo (isset($_SESSION['IdRol']) && $_SESSION['IdRol'] == 2) ? 'true' : 'false'; ?>;
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
  const DEFAULT_IMG = '../files/recipe-placeholder.webp'; // ajustá la ruta si es otra

  const recetasListado = $('#recetasListado');
  recetasListado.empty();

  if (!recetas || recetas.length === 0) {
    recetasListado.append('<p class="text-center">No se encontraron recetas.</p>');
    return;
  }

  recetas.forEach(r => {
    const descripcion = r.descripcion || '';
    const max = 150;
    const corta = descripcion.length > max ? descripcion.substring(0, max) + '...' : descripcion;

    const tieneFoto = r.foto && r.foto !== 'null' && r.foto !== 'undefined' && r.foto.trim() !== '';
    const src = tieneFoto ? `../files/${encodeURIComponent(r.foto)}` : DEFAULT_IMG;
    const extraClass = tieneFoto ? '' : ' is-placeholder';

    recetasListado.append(`
      <div class="col-md-3 mb-3">
        <div class="card h-100">
          <img loading="lazy"
               src="${src}"
               class="card-img-top${extraClass}"
               alt="${r.titulo || 'Receta'}"
               onerror="this.onerror=null; this.src='${DEFAULT_IMG}'; this.classList.add('is-placeholder');">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">${r.titulo || ''}</h5>
            <p class="card-text descripcion-corta">${corta}</p>
            ${descripcion.length > max ? `
              <p class="card-text descripcion-completa" style="display:none;">${descripcion}</p>
              <a href="#" class="link-ver-mas mt-auto">Ver más</a>` : ''}
            <p class="mt-2 mb-0"><strong>Tiempo:</strong> ${r.tiempo_preparacion} mins</p>
            <p class="mb-3"><strong>Dificultad:</strong> ${r.dificultad}</p>
            ${isAdmin ? `<a href="./editar-receta.php?id=${r.id}" class="btn btn-primary mt-auto">Editar</a>` : ''}
          </div>
        </div>
      </div>
    `);
  });
}


// Manejar clic en "Ver más/menos"
$(document).on('click', '.link-ver-mas', function(e) {
    e.preventDefault();
    const $this = $(this);
    const $cardBody = $this.closest('.card-body');
    const $descCorta = $cardBody.find('.descripcion-corta');
    const $descCompleta = $cardBody.find('.descripcion-completa');

    if ($descCompleta.is(':visible')) {
        $descCompleta.hide();
        $descCorta.show();
        $this.text('Ver más');
    } else {
        $descCorta.hide();
        $descCompleta.show();
        $this.text('Ver menos');
    }
});

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