<?php
require_once 'Conexion.php';

class Producto extends Conexion{
    public $prod_id;
    public $prod_nombre;
    public $prod_precio;
    public $prod_situacion;


    public function __construct($args = [])
    {
        $this->prod_id = $args['prod_id'] ?? null;
        $this->prod_nombre = $args['prod_nombre'] ?? '';
        $this->prod_precio = $args['prod_precio'] ?? 0.00;
        $this->prod_situacion = $args['prod_situacion'] ?? 1;
    }

    // METODO PARA INSERTAR
    public function guardar(){
        $sql = "INSERT into productos (prod_nombre, prod_precio) values ('$this->prod_nombre','$this->prod_precio')";
        $resultado = $this->ejecutar($sql);
        return $resultado; 
    }
    
    // METODO PARA CONSULTAR

    public static function buscarTodos(...$columnas){
        // $cols = '';
        // if(count($columnas) > 0){
        //     $cols = implode(',', $columnas) ;
        // }else{
        //     $cols = '*';
        // }
        $cols = count($columnas) > 0 ? implode(',', $columnas) : '*';
        $sql = "SELECT $cols FROM productos where prod_situacion = 1 ";
        $resultado = self::servir($sql);
        return $resultado;
    }

    public function buscar(...$columnas){
        $cols = count($columnas) > 0 ? implode(',', $columnas) : '*';
     
        $sql = "SELECT $cols FROM productos where prod_situacion = 1 ";

        if($this->prod_nombre != ''){
            $sql .= " AND prod_nombre like '%$this->prod_nombre%' ";
        }
        if($this->prod_precio != ''){
            $sql .= " AND prod_precio = $this->prod_precio ";
        }

        $resultado = self::servir($sql);
        return $resultado;
    }

    public function buscarPorId($id){
     
        $sql = "SELECT * FROM productos where prod_situacion = 1 and prod_id = $id ";
        $resultado = array_shift( self::servir($sql));
        // $resultado = self::servir($sql)[0];
        return $resultado;
    }

        // METODO PARA MODIFICAR
    public function modificar(){
        $sql = "UPDATE productos SET prod_nombre = '$this->prod_nombre', prod_precio = '$this->prod_precio' WHERE prod_id = $this->prod_id ";
        $resultado = $this->ejecutar($sql);
        return $resultado; 
    }


    public function eliminar(){
        // $sql = "DELETE FROM productos WHERE prod_id = $this->prod_id ";

        // echo $sql;
        $sql = "UPDATE productos SET prod_situacion = 0 WHERE prod_id = $this->prod_id ";
        $resultado = $this->ejecutar($sql);
        return $resultado; 
    }
}