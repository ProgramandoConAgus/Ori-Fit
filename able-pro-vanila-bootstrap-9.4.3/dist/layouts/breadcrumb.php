<?php
function renderBreadcrumb() {
    // Obtener la URL actual sin parámetros (puede usar $_SERVER['REQUEST_URI'] si es necesario)
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
    // Dividir la URL en partes
    $path_parts = array_filter(explode('/', $url)); // Filtra elementos vacíos
    
    // Configura la ruta inicial (Inicio/Home)
    echo '<ul class="breadcrumb">';
    echo '<li class="breadcrumb-item"><a href="/ori-fit/able-pro-vanila-bootstrap-9.4.3/dist">Home</a></li>';

    // Acumular ruta mientras se recorren las partes del path
    $link = '';
    foreach ($path_parts as $index => $part) {
        // Crear un enlace acumulando cada parte de la ruta
        $link .= "/$part";
        
        // Si es el último elemento, se muestra sin enlace (actual)
        if ($index === array_key_last($path_parts)) {
            echo "<li class=\"breadcrumb-item active\" aria-current=\"page\">" . ucfirst($part) . "</li>";
        } else {
            // Mostrar como enlace
            echo "<li class=\"breadcrumb-item\"><a href=\"$link\">" . ucfirst($part) . "</a></li>";
        }
    }
    echo '</ul>';
}
