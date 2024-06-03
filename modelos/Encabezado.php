<?php

require_once 'Conexion.php';

class Encabezado extends Conexion {
    public $fact_id;
    public $fact_cliente;
    public $fact_fecha;
    public $fact_correlativo;
    public $fact_situacion;

    public function __construct($args = [])
    {
        $this->fact_id = $args['fact_id'] ?? null;
        $this->fact_cliente = $args['fact_cliente'] ?? null;
        $this->fact_fecha = $args['fact_fecha'] ?? null;
        $this->fact_correlativo = $args['fact_correlativo'] ?? null;
        $this->fact_situacion = $args['fact_situacion'] ?? null;
    }

}