<style>

.ingrediente-clonable{
    display: none;
}
</style>
<div class=""> 
    <form id="formReceta" action="api/recetas_update.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" value="<?php echo $_GET['id'] ?>" name="id" />
        <!-- Información de la Receta -->
        <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="dificultad" class="form-label">Dificultad</label>
                    <select class="form-select" id="dificultad" name="dificultad">
                        <option value="fácil">Fácil</option>
                        <option value="media">Media</option>
                        <option value="difícil">Difícil</option>
                    </select>
                </div> 
                <div class="col-md-12 mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="tiempo_preparacion" class="form-label">Tiempo de preparación(Min)</label>
                    <input type="number" class="form-control" id="tiempo_preparacion" name="tiempo_preparacion">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="porciones" class="form-label">Porciones</label>
                    <input type="number" class="form-control" id="porciones" name="porciones">
                </div> 
                
            </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Foto</label>
            <input type="file" name="foto_receta">
        </div>
        <button type="button" class="btn btn-primary mb-3" id="btnAddIngrediente">Agregar Ingrediente</button>
        <!-- Ingredientes -->
        <h5>Ingredientes</h5>
        <div id="ingredientesList">
           
        </div> 

        <!-- Botón de Enviar -->
        <button type="submit" class="btn btn-success">Guardar Receta</button>
        <a href="./" type="button" class="btn btn-secondary">Volver al listado</a>
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
                <option value="g">Gramos</option> 
                <option value="ml">Miligramos</option> 
                <option value="pieza">Pieza(Unidad)</option> 
            </select> 
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-danger btn-remove-ingrediente">&times;</button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script>
    var ingredientes = [];
    var receta ={};

    $(document).ready(function () {
       fetchIngredientes(); 
       fetchOneReceta();

        // Agregar un nuevo ingrediente
        $('#btnAddIngrediente').on('click', function () {
            addIngrediente();
        });

        // Remover un ingrediente
        $('#ingredientesList').on('click', '.btn-remove-ingrediente', function () {
            if ($('.ingrediente-item').length > 1) {
                $(this).closest('.ingrediente-item').remove();
            }
        });

        $('form').on('submit', function(event) { 
            renameIngredientes(); 
        });
    });
 
    function addIngrediente(ingre = null) {
        console.log(ingredientes)
        const ingredienteItem = $('.ingrediente-clonable:first').clone();
        const index = $('#ingredientesList').children().length;

        ingredienteItem.removeClass('ingrediente-clonable');
        ingredienteItem.show(); // Asegurar que el elemento clonado sea visible

        // Obtener valores del ingrediente (si existe)
        let ingrediente_id = ingre != null ? ingre.ingrediente_id : '';
        let cantidad = ingre != null ? ingre.cantidad : '';
        let unidad = ingre != null ? ingre.unidad_medida : ''; // Asegurar que la propiedad coincida (unidad_medida -> unidad)

        // Llenar los valores del select y campos
        ingredienteItem.find('input').val(cantidad);
        ingredienteItem.find('.select-ingrediente-unidad').val(unidad);

        // Llenar opciones del select de ingredientes
        ingredienteItem.find('.select-ingrediente').empty().append('<option value="">Seleccione un ingrediente</option>');
        ingredientes.forEach(ing => {
            let opt = `<option value="${ing.IdIngrediente}">${ing.Nombre} (Pro: ${ing.Gramos_Proteina}, Cal: ${ing.Calorias}, Gra: ${ing.Gramos_Grasas})</option>`;
            ingredienteItem.find('.select-ingrediente').append(opt);
        });
        
        // Seleccionar el ingrediente correcto
        console.log(ingrediente_id)
        ingredienteItem.find('.select-ingrediente').val(ingrediente_id);
        // Actualizar los nombres de los campos con el índice correcto
        ingredienteItem.find('[name="ingredientes[0][ingrediente_id]"]').attr('name', `ingredientes[${index}][ingrediente_id]`);
        ingredienteItem.find('[name="ingredientes[0][cantidad]"]').attr('name', `ingredientes[${index}][cantidad]`);
        ingredienteItem.find('[name="ingredientes[0][unidad]"]').attr('name', `ingredientes[${index}][unidad]`);

        $('#ingredientesList').append(ingredienteItem);
    }

    function fetchIngredientes() { 
        $.ajax({
            url: '../api/ingredientes.php',
            type: 'GET',
            data: null,
            success: function (response) { 
                ingredientes = JSON.parse(response); 
            }
        });
    }

    function fetchOneReceta() { 
    $.ajax({
        url: '../api/recetas_one.php?id=<?php echo $_GET['id'] ?>',
        type: 'GET',
        data: null,
        success: function (response) { 
            receta = JSON.parse(response); 
            fillFormFields();
            console.log(receta)
        }
    });
}


    function fillFormFields(){
        if(receta!=null && receta!={}){

            $("#titulo").val(receta.titulo);
            $("#descripcion").val(receta.descripcion);
            $("#dificultad").val(receta.dificultad);
            $("#tiempo_preparacion").val(receta.tiempo_preparacion);
            $("#porciones").val(receta.porciones);

            if(receta.ingredientes!=null && receta.ingredientes.length > 0 ){
                for(var i =0; i< receta.ingredientes.length; i++){
                    const ingre = receta.ingredientes[i];
                    addIngrediente(ingre); 
                }

            }

        } 
    }

    function renameIngredientes() {
    $('#ingredientesList .ingrediente-item').each(function(index) {
        $(this).find('[name*="ingredientes[0][ingrediente_id]"]').attr('name', `ingredientes[${index}][ingrediente_id]`);
        $(this).find('[name*="ingredientes[0][cantidad]"]').attr('name', `ingredientes[${index}][cantidad]`);
        $(this).find('[name*="ingredientes[0][unidad]"]').attr('name', `ingredientes[${index}][unidad]`);
    });
    }
</script>
