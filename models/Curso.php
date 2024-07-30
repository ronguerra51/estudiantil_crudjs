<?php
require_once 'Conexion.php';

class Curso extends Conexion
{
    public $curso_id;
    public $curso_nombre;
    public $profesor_id;
    public $curso_situacion;


    public function __construct($args = [])
    {
        $this->curso_id = $args['curso_id'] ?? null;
        $this->curso_nombre = $args['curso_nombre'] ?? '';
        $this->profesor_id = $args['profesor_id'] ?? null;
        $this->curso_situacion = $args['curso_situacion'] ?? '';
    }

    // METODO PARA INSERTAR
    public function guardar()
    {
        $sql = "INSERT into curso(curso_nombre, profesor_id) values ('$this->curso_nombre','$this->profesor_id')";
        $resultado = $this->ejecutar($sql);
        return $resultado;
    }

    // METODO PARA CONSULTAR


    public function buscar(...$columnas)
    {
        $cols = count($columnas) > 0 ? implode(',', $columnas) : '*';
        $sql = "SELECT
    c.curso_id,
    c.curso_nombre,
    p.profesor_nombre,
    p.profesor_apellido,
    c.curso_situacion
FROM
    curso c
JOIN
    profesor p ON c.profesor_id = p.profesor_id
WHERE
    c.curso_situacion = 1";

        $resultado = self::servir($sql);
        return $resultado;
    }

    public function buscarPorId($id){
     
        $sql = "SELECT * FROM curso where curso_situacion = 1 and curso_id = curso_id ";
        $resultado = array_shift( self::servir($sql));
        // $resultado = self::servir($sql)[0];
        return $resultado;
    }

    public function eliminar(){
        // $sql = "DELETE FROM productos WHERE prod_id = $this->prod_id ";

        // echo $sql;
        $sql = "UPDATE curso SET curso_situacion = 0 WHERE curso_id = $this->curso_id ";
        $resultado = $this->ejecutar($sql);
        return $resultado; 
    }
}