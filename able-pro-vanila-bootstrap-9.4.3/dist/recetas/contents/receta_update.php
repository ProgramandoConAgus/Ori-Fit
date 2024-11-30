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
    var ingredientes = [ 
    ];
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

    function addIngrediente (ingre=null){
                const ingredienteItem = $('.ingrediente-clonable:first').clone(); 
                const index = $('#ingredientesList').children().length;

                ingredienteItem.removeClass('ingrediente-clonable');
               
                let ingrediente_id = ingre!=null?ingre.ingrediente_id:'';
                let cantidad = ingre!=null?ingre.cantidad:'';
                let unidad = ingre!=null?ingre.unidad_medida:'';  
                ingredienteItem.find('input').val(cantidad);  
                ingredienteItem.find('.select-ingrediente-unidad').val(unidad);  
                
                for(var i=0; i< ingredientes.length; i ++){
                    var opt = document.createElement('option'); 
                    $(opt).val(ingredientes[i].id);
                    var text = ingredientes[i].nombre + ' (Pro.:'+ingredientes[i].proteinas + ', Cal.:'+ingredientes[i].calorias + ', Gra.:'+ingredientes[i].grasas+')';
                    $(opt).text(text); 
                    ingredienteItem.find('.select-ingrediente').append(opt);
                } 

                ingredienteItem.find('.select-ingrediente').val(ingrediente_id);  
                let cantiadName = ingredienteItem.find('input').attr('name');
                let unidadName = ingredienteItem.find('.select-ingrediente-unidad').attr('name');
                let ingredienteName = ingredienteItem.find('.select-ingrediente-unidad').attr('name');
               
                ingredienteItem.find('input').attr('name', cantiadName.replace("0",index));
                ingredienteItem.find('.select-ingrediente-unidad').attr('name', unidadName.replace("0",index));
                ingredienteItem.find('.select-ingrediente').attr('name', ingredienteName.replace("0",index));

                $('#ingredientesList').append(ingredienteItem);
        }

    function fetchIngredientes() { 
        $.ajax({
            url: 'api/ingredientes.php',
            type: 'GET',
            data: null,
            success: function (response) { 
                ingredientes = JSON.parse(response); 
            }
        });
    }

    function fetchOneReceta() { 
    $.ajax({
        url: 'api/recetas_one.php?id=<?php echo $_GET['id'] ?>',
        type: 'GET',
        data: null,
        success: function (response) { 
            receta = JSON.parse(response); 
            fillFormFields();
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

