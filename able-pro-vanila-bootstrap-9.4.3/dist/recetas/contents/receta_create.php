
    <style>

    .ingrediente-clonable{
        display: none;
    }
    </style>
    <div class=""> 
        <form id="formReceta" action="api/recetas_save.php" method="POST" enctype="multipart/form-data">
            <!-- Información de la Receta -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="dificultad" class="form-label">Dificultad</label>
                <select class="form-select" id="dificultad" name="dificultad">
                    <option value="fácil">Fácil</option>
                    <option value="media">Media</option>
                    <option value="difícil">Difícil</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Foto</label>
                <input type="file" name="foto_receta">
            </div>

            <!-- Ingredientes -->
            <h5>Ingredientes</h5>
            <div id="ingredientesList">
               
            </div>
            <button type="button" class="btn btn-primary mb-3" id="btnAddIngrediente">Agregar Ingrediente</button>

            <!-- Botón de Enviar -->
            <button type="submit" class="btn btn-success">Guardar Receta</button>
        </form>
        <div class="row g-3 mb-2 ingrediente-item ingrediente-clonable">
            <div class="col-md-5">
                <select class="form-control select-ingrediente" name="ingredientes[0][ingrediente_id]" required>
                    <option value="">Seleccione un ingrediente</option> 
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" step="0.01" class="form-control" name="ingredientes[0][cantidad]" placeholder="Cantidad" required>
            </div>
            <div class="col-md-3">
            <select class="form-control select-ingrediente-unidad"  name="ingredientes[0][unidad]"  required>
                    <option value="">Seleccione una Unidad de meida</option> 
                    <option value="G">Gramos</option> 
                    <option value="ml">Miligramos</option> 
                    <option value="Pieza">Pieza(Unidad)</option> 
                </select> 
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger btn-remove-ingrediente">&times;</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script>
        var ingredientes = [
            {id:1,nombre:'Arroz'},
            {id:2,nombre:'Aguacate'},
            {id:3,nombre:'Pollo'}
        ];

        $(document).ready(function () {
           fetchIngredientes(); 
            $('#btnAddIngrediente').on('click', function () {
                addIngrediente();
            }); 
            $('#ingredientesList').on('click', '.btn-remove-ingrediente', function () {
                if ($('.ingrediente-item').length > 1) {
                    $(this).closest('.ingrediente-item').remove();
                }
            });

            $('form').on('submit', function(event) { 
                renameIngredientes(); 
            });
        });

        function addIngrediente (){
                const ingredienteItem = $('.ingrediente-clonable:first').clone();
                ingredienteItem.removeClass('ingrediente-clonable');
                ingredienteItem.find('input').val(''); // Limpiar los valores
                ingredienteItem.find('.select-ingrediente').val(''); 
                for(var i=0; i< ingredientes.length; i ++){
                    var opt = document.createElement('option'); 
                    $(opt).val(ingredientes[i].id);
                    var text = ingredientes[i].nombre + ' (Pro.:'+ingredientes[i].proteinas + ', Cal.:'+ingredientes[i].calorias + ', Gra.:'+ingredientes[i].grasas+')';
                    $(opt).text(text); 
                    ingredienteItem.find('.select-ingrediente').append(opt);
                } 
                //ingredienteItem.find('.select-ingrediente').select2(); // Inicializar Select2 en el nuevo ingrediente
                $('#ingredientesList').append(ingredienteItem);
        }

    function fetchIngredientes() {
        //const filtros = $('#filtrosForm').serialize() + `&page=${page}`;
        $.ajax({
            url: 'api/ingredientes.php',
            type: 'GET',
            data: null,
            success: function (response) { 
                ingredientes = JSON.parse(response); 
            }
        });
    }

    function renameIngredientes(){
        var children = $('#ingredientesList').children();
        for(var i = 0; i<children.length; i++){
            let ingredienteItem = $(children[i]);

            let cantiadName = "ingredientes[0][cantidad]";
            let unidadName = "ingredientes[0][unidad]"
            let ingredienteName = "ingredientes[0][ingrediente_id]";
            
            ingredienteItem.find('input').attr('name', cantiadName.replace("0",i));
            ingredienteItem.find('.select-ingrediente-unidad').attr('name', unidadName.replace("0",i));
            ingredienteItem.find('.select-ingrediente').attr('name', ingredienteName.replace("0",i));

        } 

    }
    </script>
 
