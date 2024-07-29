<?php
require_once 'Conexion.php';

class Estudiante extends Conexion
{
    public $estudiante_id;
    public $estudiante_nombre;
    public $estudiante_apellido;
    public $estudiante_email;
    public $estudiante_telefono;
    public $estudiante_situacion;


    public function __construct($args = [])
    {
        $this->estudiante_id = $args['estudiante_id'] ?? null;
        $this->estudiante_nombre = $args['estudiante_nombre'] ?? '';
        $this->estudiante_apellido = $args['estudiante_apellido'] ?? '';
        $this->estudiante_email = $args['estudiante_email'] ?? '';
        $this->estudiante_telefono = $args['estudiante_telefono'] ?? '';
        $this->estudiante_situacion = $args['estudiante_situacion'] ?? 1;
    }

    // METODO PARA INSERTAR
    public function guardar()
    {
        $sql = "INSERT into estudiante (estudiante_nombre, estudiante_apellido, estudiante_email, estudiante_telefono) values ('$this->estudiante_nombre','$this->estudiante_apellido','$this->estudiante_email','$this->estudiante_telefono')";
        $resultado = $this->ejecutar($sql);
        return $resultado;
    }

    // METODO PARA CONSULTAR


    public function buscar(...$columnas)
    {
        $cols = count($columnas) > 0 ? implode(',', $columnas) : '*';
        $sql = "SELECT $cols FROM estudiante where estudiante_situacion = 1 ";

        if ($this->estudiante_nombre != '') {
            $sql .= " AND estudiante_nombre like '%$this->estudiante_nombre%' ";
        }
        if ($this->estudiante_apellido != '') {
            $sql .= " AND estudiante_apellido like'%$this->estudiante_apellido%' ";
        }
        if ($this->estudiante_email != '') {
            $sql .= " AND estudiante_email like'%$this->estudiante_email%' ";
        }
        if ($this->estudiante_telefono != '') {
            $sql .= " AND estudiante_telefono like'%$this->estudiante_telefono%' ";
        }

        $resultado = self::servir($sql);
        return $resultado;
    }

    public function buscarPorId($id){
     
        $sql = "SELECT * FROM estudiante where estudiante_situacion = 1 and estudiante_id = $id ";
        $resultado = array_shift( self::servir($sql));
        // $resultado = self::servir($sql)[0];
        return $resultado;
    }

    // METODO PARA MODIFICAR
    public function modificar()
    {
        $sql = "UPDATE estudiante SET estudiante_nombre = '$this->estudiante_nombre', estudiante_apellido = '$this->estudiante_apellido', estudiante_email = '$this->estudiante_email', estudiante_telefono = '$this->estudiante_telefono' WHERE estudiante_id = $this->estudiante_id ";
        $resultado = $this->ejecutar($sql);
        return $resultado;
    }

    public function eliminar(){
        // $sql = "DELETE FROM productos WHERE prod_id = $this->prod_id ";

        // echo $sql;
        $sql = "UPDATE estudiante SET estudiante_situacion = 0 WHERE estudiante_id = $this->estudiante_id ";
        $resultado = $this->ejecutar($sql);
        return $resultado; 
    }
}