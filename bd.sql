CREATE TABLE estudiante (
    estudiante_id INT PRIMARY KEY,
    estudiante_nombre VARCHAR(100),
    estudiante_apellido VARCHAR(100),
    estudiante_fecha_nacimiento DATE,
    estudiante_email VARCHAR(255),
    estudiante_telefono VARCHAR(15),
    estudiante_direccion VARCHAR (80),
    estudiante_situacion SMALLINT DEFAULT 1,
    estudiante_fecha_registro DATE
);

CREATE TABLE profesor (
    profesor_id INT PRIMARY KEY,
    profesor_nombre VARCHAR(100),
    profesor_apellido VARCHAR(100),
    profesor_telefono VARCHAR(15),
    profesor_departamento VARCHAR(100),
    profesor_fecha_registro DATE,
    profesor_situacion SMALLINT DEFAULT 1
);

CREATE TABLE curso (
    curso_id INT PRIMARY KEY,
    curso_nombre VARCHAR(100),
    fecha_inicio DATE,
    fecha_fin DATE,
    profesor_id INT,
    curso_situacion SMALLINT DEFAULT 1,
    FOREIGN KEY (profesor_id) REFERENCES profesor(profesor_id)
);

CREATE TABLE inscripcion (
    inscripcion_id INT PRIMARY KEY,
    estudiante_id INT,
    curso_id INT,
    inscripcion_fecha DATE,
    FOREIGN KEY (estudiante_id) REFERENCES estudiante(estudiante_id),
    FOREIGN KEY (curso_id) REFERENCES curso(curso_id),
    UNIQUE (estudiante_id, curso_id)
);

CREATE TABLE calificacion (
    calificacion_id INT PRIMARY KEY,
    estudiante_id INT,
    curso_id INT,
    calificacion_calificacion DECIMAL(5, 2) NOT NULL,
    calificacion_fecha DATE,
    FOREIGN KEY (estudiante_id) REFERENCES estudiante(estudiante_id),
    FOREIGN KEY (curso_id) REFERENCES curso(curso_id)
);
