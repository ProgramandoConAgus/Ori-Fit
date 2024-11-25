const seleccionadosDiv = document.getElementById("seleccionados");
const alergiasInput = document.getElementById("alergias-input");
const sugerenciasDiv = document.getElementById("sugerencias");
const seleccionados = new Set();

// Añadimos estilos en línea para los elementos
sugerenciasDiv.style.position = "absolute";
sugerenciasDiv.style.width = "50%";
sugerenciasDiv.style.backgroundColor = "#fff";
sugerenciasDiv.style.border = "1px solid #ccc";
sugerenciasDiv.style.borderRadius = "4px";
sugerenciasDiv.style.maxHeight = "150px";
sugerenciasDiv.style.overflowY = "auto";
sugerenciasDiv.style.boxShadow = "0px 4px 6px rgba(0, 0, 0, 0.1)";
sugerenciasDiv.style.zIndex = "1000";
sugerenciasDiv.style.display = "none";

// Manejador de eventos para el campo de entrada de alergias
alergiasInput.addEventListener("input", function() {
    const query = this.value;

    if (query.length >= 3) {
        fetch(`buscar_ingredientes.php?query=${query}`)
            .then(response => response.json())
            .then(data => {
                sugerenciasDiv.innerHTML = "";
                sugerenciasDiv.style.display = "block";

                data.forEach(nombre => {
                    const opcion = document.createElement("div");
                    opcion.textContent = nombre;
                    opcion.style.padding = "8px";
                    opcion.style.cursor = "pointer";
                    opcion.style.borderBottom = "1px solid #f1f1f1";

                    opcion.addEventListener("mouseover", function() {
                        opcion.style.backgroundColor = "#f0f0f0";
                    });
                    opcion.addEventListener("mouseout", function() {
                        opcion.style.backgroundColor = "#fff";
                    });

                    opcion.addEventListener("click", function() {
                        if (!seleccionados.has(nombre)) {
                            seleccionados.add(nombre);
                            agregarChip(nombre);
                        }
                        alergiasInput.value = "";
                        sugerenciasDiv.style.display = "none";
                    });

                    sugerenciasDiv.appendChild(opcion);
                });
            });
    } else {
        sugerenciasDiv.style.display = "none";
    }
});

function agregarChip(nombre) {
    const chip = document.createElement("div");
    chip.textContent = nombre;
    chip.style.display = "inline-flex";
    chip.style.alignItems = "center";
    chip.style.padding = "5px 10px";
    chip.style.margin = "5px";
    chip.style.backgroundColor = "#e0e0e0";
    chip.style.borderRadius = "12px";
    chip.style.fontSize = "14px";
    chip.style.color = "#333";

    const close = document.createElement("span");
    close.textContent = "x";
    close.style.marginLeft = "8px";
    close.style.cursor = "pointer";
    close.style.color = "#555";

    close.addEventListener("click", function() {
        seleccionados.delete(nombre);
        seleccionadosDiv.removeChild(chip);
    });

    chip.appendChild(close);
    seleccionadosDiv.appendChild(chip);
}
