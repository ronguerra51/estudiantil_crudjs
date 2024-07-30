<?php
require_once 'Conexion.php';

class Profesores extends Conexion
{
    public function obtenerProfesores()
    {
        $sql = "SELECT profesor_id, profesor_nombre, profesor_apellido FROM profesor";
        $resultado = self::servir($sql);
        return $resultado;
    }
}

class Profesor extends Conexion
{
    public $profesor_id;
    public $profesor_nombre;
    public $profesor_apellido;
    public $profesor_email;
    public $profesor_telefono;
    public $profesor_situacion;


    public function __construct($args = [])
    {
        $this->profesor_id = $args['profesor_id'] ?? null;
        $this->profesor_nombre = $args['profesor_nombre'] ?? '';
        $this->profesor_apellido = $args['profesor_apellido'] ?? '';
        $this->profesor_email = $args['profesor_email'] ?? '';
        $this->profesor_telefono = $args['profesor_telefono'] ?? '';
        $this->profesor_situacion = $args['profesor_situacion'] ?? 1;
    }

    // METODO PARA INSERTAR
    public function guardar()
    {
        $sql = "INSERT into profesor(profesor_nombre, profesor_apellido, profesor_email, profesor_telefono) values ('$this->profesor_nombre','$this->profesor_apellido','$this->profesor_email','$this->profesor_telefono')";
        $resultado = $this->ejecutar($sql);
        return $resultado;
    }

    // METODO PARA CONSULTAR


    public function buscar(...$columnas)
    {
        $cols = count($columnas) > 0 ? implode(',', $columnas) : '*';
        $sql = "SELECT $cols FROM profesor where profesor_situacion = 1 ";

        if ($this->profesor_nombre != '') {
            $sql .= " AND profesor_nombre like '%$this->profesor_nombre%' ";
        }
        if ($this->profesor_apellido != '') {
            $sql .= " AND profesor_apellido like'%$this->profesor_apellido%' ";
        }
        if ($this->profesor_email != '') {
            $sql .= " AND profesor_email like'%$this->profesor_email%' ";
        }
        if ($this->profesor_telefono != '') {
            $sql .= " AND profesor_telefono like'%$this->profesor_telefono%' ";
        }

        $resultado = self::servir($sql);
        return $resultado;
    }

    public function buscarPorId($id){
     
        $sql = "SELECT * FROM profesor where profesor_situacion = 1 and profesor_id = $id ";
        $resultado = array_shift( self::servir($sql));
        // $resultado = self::servir($sql)[0];
        return $resultado;
    }

    // METODO PARA MODIFICAR
    public function modificar()
    {
        $sql = "UPDATE profesor SET profesor_nombre = '$this->profesor_nombre', profesor_apellido = '$this->profesor_apellido', profesor_email = '$this->profesor_email', profesor_telefono = '$this->profesor_telefono' WHERE profesor_id = $this->profesor_id ";
        $resultado = $this->ejecutar($sql);
        return $resultado;
    }

    public function eliminar(){
        // $sql = "DELETE FROM productos WHERE prod_id = $this->prod_id ";

        // echo $sql;
        $sql = "UPDATE profesor SET profesor_situacion = 0 WHERE profesor_id = $this->profesor_id ";
        $resultado = $this->ejecutar($sql);
        return $resultado; 
    }
}