CREATE TABLE recetas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    foto VARCHAR(255), -- URL o ruta de la imagen de la receta
    titulo VARCHAR(200) NOT NULL, -- Nombre de la receta
    descripcion TEXT, -- Descripción de la receta, preparación y otros detalles
    tiempo_preparacion INT, -- Tiempo en minutos para preparar la receta
    porciones INT, -- Cantidad de porciones que produce la receta
    calorias INT, -- Calorías totales de la receta
    proteinas FLOAT, -- Cantidad total de proteínas en gramos
    carbohidratos FLOAT, -- Cantidad total de carbohidratos en gramos
    grasas FLOAT, -- Cantidad total de grasas en gramos
    dificultad ENUM('fácil', 'media', 'difícil'), -- Nivel de dificultad de la receta
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha en que se añadió la receta
    fecha_actualizacion TIMESTAMP -- Fecha en que se añadió la receta
);

CREATE TABLE ingredientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL, -- Nombre del ingrediente
    tipo VARCHAR(50), -- Tipo, ej. vegetal, proteína, grano, etc.
    clasificacion VARCHAR(50), -- Clasificación específica (ej. carbohidrato, proteína)
    calorias FLOAT NOT NULL, -- Calorías por 100g
    proteinas FLOAT NOT NULL, -- Proteínas por 100g
    carbohidratos FLOAT NOT NULL, -- Carbohidratos por 100g
    grasas FLOAT NOT NULL, -- Grasas por 100g
    unidad_medida ENUM('g', 'ml', 'pieza'), -- Unidad de medida
    alergenos SET('gluten', 'lactosa', 'frutos secos', 'mariscos', 'soja', 'huevo'), -- Posibles alérgenos
    fecha_agregado TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Fecha en que se añadió el ingrediente
);

CREATE TABLE recetas_ingredientes (
    receta_id INT,
    ingrediente_id INT,
    cantidad FLOAT NOT NULL, -- Cantidad del ingrediente en la receta
    unidad_medida ENUM('g', 'ml', 'pieza'), -- Unidad de medida específica para cada cantidad
    PRIMARY KEY (receta_id, ingrediente_id),
    FOREIGN KEY (receta_id) REFERENCES recetas(id) ON DELETE CASCADE,
    FOREIGN KEY (ingrediente_id) REFERENCES ingredientes(id) ON DELETE CASCADE
);