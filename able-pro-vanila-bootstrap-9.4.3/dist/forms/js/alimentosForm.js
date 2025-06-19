document.getElementById('helpForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = e.target;
    const submitBtn = form.querySelector('button[type="submit"]');
    const alertContainer = document.querySelector('#helpModal .modal-body');
    
    // Resetear alertas anteriores
    alertContainer.querySelectorAll('.alert').forEach(alert => alert.remove());

    // Estado de carga
    submitBtn.disabled = true;
    submitBtn.innerHTML = `
        <span class="spinner-border spinner-border-sm" role="status"></span>
        Enviando...
    `;

    fetch('../foro/envioPreguntasForo.php', {
        method: 'POST',
        body: new FormData(form)
    })
    .then(async response => {
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
        
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            throw new TypeError('Respuesta no es JSON');
        }
        
        return response.json();
    })
    .then(data => {
        const alertType = data.success ? 'success' : 'danger';
        const message = data.message || (data.success 
            ? '¡Consulta enviada! Te responderemos a la brevedad.'
            : 'Error al enviar la consulta');

        const alertHTML = `
            <div class="alert alert-${alertType} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        alertContainer.insertAdjacentHTML('afterbegin', alertHTML);
        if (data.success) form.reset();
    })
    .catch(error => {
        console.error('Fetch Error:', error);
        const alertHTML = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Error de conexión: ${error.message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        alertContainer.insertAdjacentHTML('afterbegin', alertHTML);
    })
    .finally(() => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = 'Enviar consulta';
    });
});
  document.getElementById("ejercicio").addEventListener("change", function() {
    const extraFields = document.getElementById("extraFields");
    const diasEntrenamiento = document.getElementById("diasEntrenamiento");
    const intensidad = document.getElementById("intensidad");

    if (this.value === "si") {
      extraFields.style.display = "flex"; 
      diasEntrenamiento.required = true; // Establece los campos como obligatorios
      intensidad.required = true;
    } else {
      extraFields.style.display = "none";
      diasEntrenamiento.required = false; // Desactiva el requisito de campos obligatorios
      intensidad.required = false;
      diasEntrenamiento.value = ""; // Limpia el campo
      intensidad.value = ""; // Limpia el campo
    }
  });
  document.addEventListener("DOMContentLoaded", function () {
    const btnSiguiente = document.getElementById("btnSiguiente");
    const btnAnterior = document.getElementById("btnAnterior");
    const btnTerminar = document.getElementById("btnTerminar");
    const barraProgreso = document.querySelector("#bar .bar");
    const progreso = barraProgreso;

    function validarCampos(seccion) {
      const campos = seccion.querySelectorAll("input[required], select[required]");
      for (let campo of campos) {
        if (campo.value === "" || campo.value === "default") {
          return false;
        }
      }
      return true;
    }

    function actualizarProgreso() {
      const secciones = document.querySelectorAll(".tab-pane");
      const seccionActual = document.querySelector(".tab-pane.show");
      const indexActual = Array.from(secciones).indexOf(seccionActual);
      const porcentaje = ((indexActual + 1) / secciones.length) * 100;
      progreso.style.width = porcentaje + "%";
      progreso.setAttribute("aria-valuenow", porcentaje);
    }

    btnSiguiente.addEventListener("click", function () {
      const seccionActual = document.querySelector(".tab-pane.show");
      if (validarCampos(seccionActual)) {
        const siguienteTab = seccionActual.nextElementSibling;
        if (siguienteTab) {
          const idSiguienteTab = siguienteTab.id;
          const navLink = document.querySelector(`a[href="#${idSiguienteTab}"]`);
          if (navLink) {
            const bootstrapTab = new bootstrap.Tab(navLink);
            bootstrapTab.show();
          }
        }
        actualizarProgreso();
        actualizarBotones();
      } else {
        alert("Por favor, rellene todos los campos antes de continuar.");
      }
    });

    btnAnterior.addEventListener("click", function () {
      const seccionActual = document.querySelector(".tab-pane.show");
      const tabAnterior = seccionActual.previousElementSibling;
      if (tabAnterior) {
        const idTabAnterior = tabAnterior.id;
        const navLink = document.querySelector(`a[href="#${idTabAnterior}"]`);
        if (navLink) {
          const bootstrapTab = new bootstrap.Tab(navLink);
          bootstrapTab.show();
        }
      }
      actualizarProgreso();
      actualizarBotones();
    });

    function actualizarBotones() {
      const seccionActual = document.querySelector(".tab-pane.show");

      if (seccionActual.id === "finish") {
        btnSiguiente.style.display = "none";
        btnTerminar.style.display = "none";
      } else {
        btnSiguiente.style.display = "inline-block";
        btnTerminar.style.display = "none";
      }

      if (seccionActual.id === "contactDetail") {
        btnAnterior.style.display = "none";
        btnSiguiente.style.marginLeft = "auto"; // Mueve el botón a la derecha
        btnSiguiente.style.marginRight = "0";
        btnSiguiente.style.display = "inline-block";
      } else {
        btnAnterior.style.display = "inline-block";
        btnSiguiente.style.marginLeft = ""; // Restablece el margen para otras secciones
        btnSiguiente.style.marginRight = "";
      }

      if (seccionActual.id === "educationDetail") {
        btnSiguiente.style.display = "inline-block";
        btnSiguiente.style.display = "none";
        btnTerminar.style.display = "inline-block";
      }
    }

    function terminarFormulario() {
      const seccionActual = document.querySelector(".tab-pane.show");
      const tabFinal = document.querySelector("#finish");
      if (tabFinal) {
        const navLink = document.querySelector(`a[href="#${tabFinal.id}"]`);
        if (navLink) {
          const bootstrapTab = new bootstrap.Tab(navLink);
          bootstrapTab.show();
        }
      }
      actualizarProgreso();
      actualizarBotones();
    }

    actualizarProgreso();
    actualizarBotones();
  });
  layout_change('light');
  change_box_container('false');
  layout_caption_change('true');
  layout_rtl_change('false');
  preset_change('preset-1');
  main_layout_change('vertical');
      new Wizard('#basicwizard', {
        validate: true,
        progress: true
      });
$(document).ready(function() {
    $('.select2-multiple').select2({
        theme: 'bootstrap-5',
        placeholder: 'Selecciona tus opciones',
        closeOnSelect: false,
        width: '100%'
    });
});
/*
$(document).ready(function() {
    $('.select2-multiple').select2({
        theme: 'bootstrap-5',
        placeholder: function() {
            return $(this).data('placeholder');
        },
        closeOnSelect: false,
        width: '100%'
    });
});*/
