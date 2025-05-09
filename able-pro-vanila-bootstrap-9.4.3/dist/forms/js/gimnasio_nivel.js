document.getElementById('lugar_entrenamiento').addEventListener('change', function(){
    var campo = document.getElementById('nivel');
    if(this.value === 'gimnasio'){
        campo.style.display = 'block';
    }else{
        campo.style.display = 'none';
    }
})