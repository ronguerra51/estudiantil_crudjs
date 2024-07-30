<?php
require_once 'Conexion.php';

class Inscripcion extends Conexion
{
    public $inscripcion_id;
    public $estudiante_id;
    public $curso_id;
    public $inscripcion_situacion;


    public function __construct($args = [])
    {
        $this->inscripcion_id = $args['inscripcion_id'] ?? null;
        $this->estudiante_id = $args['estudiante_id'] ?? null;
        $this->curso_id = $args['profesor_id'] ?? null;
        $this->inscripcion_situacion = $args['inscripcion_situacion'] ?? null;
    }

    // METODO PARA INSERTAR
    public function guardar()
    {
        $sql = "INSERT into inscripcion(estudiante_id, curso_id) values ('$this->estudiante_id','$this->curso_id')";
        $resultado = $this->ejecutar($sql);
        return $resultado;
    }

    // METODO PARA CONSULTAR


    public function buscar(...$columnas)
    {
        $cols = count($columnas) > 0 ? implode(',', $columnas) : '*';
        $sql = "SELECT e.estudiante_nombre, e.estudiante_apellido, c.curso_nombre, p.profesor_nombre, p.profesor_apellido
        FROM inscripcion i
        JOIN estudiante e ON i.estudiante_id = e.estudiante_id
        JOIN curso c ON i.curso_id = c.curso_id
        JOIN profesor p ON c.profesor_id = p.profesor_id
        WHERE i.curso_situacion = 1;";

        $resultado = self::servir($sql);
        return $resultado;
    }

    public function buscarPorId($id){
     
        $sql = "SELECT * FROM inscripcion where inscripcion_situacion = 1 and inscripcion_id = inscripcion_id ";
        $resultado = array_shift( self::servir($sql));
        return $resultado;
    }

    public function eliminar(){
        $sql = "UPDATE inscripcion SET inscripcion_situacion = 0 WHERE inscripcion_id = $this->inscripcion_id ";
        $resultado = $this->ejecutar($sql);
        return $resultado; 
    }
}