
CREATE TABLE estudiante (
    estudiante_id SERIAL PRIMARY KEY,
    estudiante_nombre VARCHAR(100),
    estudiante_apellido VARCHAR(100),
    estudiante_email VARCHAR(255),
    estudiante_telefono VARCHAR(15),
    estudiante_situacion SMALLINT DEFAULT 1
);


CREATE TABLE profesor (
    profesor_id SERIAL PRIMARY KEY,
    profesor_nombre VARCHAR(100),
    profesor_apellido VARCHAR(100),
    profesor_email VARCHAR(255),
    profesor_telefono VARCHAR(15),
    profesor_situacion SMALLINT DEFAULT 1
);

CREATE TABLE curso (
    curso_id SERIAL PRIMARY KEY,
    curso_nombre VARCHAR(100),
    profesor_id INT,
    curso_situacion SMALLINT DEFAULT 1,
    FOREIGN KEY (profesor_id) REFERENCES profesor(profesor_id)
);

CREATE TABLE inscripcion (
    inscripcion_id SERIAL PRIMARY KEY,
    estudiante_id INT,
    curso_id INT,
    curso_situacion SMALLINT DEFAULT 1,
    FOREIGN KEY (estudiante_id) REFERENCES estudiante(estudiante_id),
    FOREIGN KEY (curso_id) REFERENCES curso(curso_id),
    UNIQUE (estudiante_id, curso_id)
);

select * from inscripcion;

SELECT 
    e.estudiante_nombre,
    e.estudiante_apellido,
    c.curso_nombre
FROM 
    inscripcion i
JOIN 
    estudiante e ON i.estudiante_id = e.estudiante_id
JOIN 
    curso c ON i.curso_id = c.curso_id
WHERE 
    i.curso_situacion = 1;


